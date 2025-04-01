<?php
require_once('../vendor/autoload.php');

// Only include header for non-JSON requests
if (!isset($_SERVER['CONTENT_TYPE']) || strpos($_SERVER['CONTENT_TYPE'], 'application/json') === false) {
    include('../pages/header.php');
}

// Database connection
$db = new PDO('mysql:host=localhost;dbname=bus', 'root', 'secure');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$page_name = 'payment';
$booking_id = $_GET['booking_id'] ?? null;

// Fetch booking details from database
function getBookingDetails($db, $booking_id)
{
    if (!$booking_id) return null;

    try {
        // Get booking summary
        $stmt = $db->prepare("
            SELECT bs.booking_id, bs.total_amount, bs.status, 
                   GROUP_CONCAT(s.seat_number) as seats
            FROM bookingsumma bs
            LEFT JOIN seat s ON bs.booking_id = s.booking_id
            WHERE bs.booking_id = ?
            GROUP BY bs.booking_id
        ");
        $stmt->execute([$booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$booking) return null;

        // Calculate breakdown (example values - adjust based on your business logic)
        $base_fare = $booking['total_amount'] * 0.85; // 85% of total
        $booking_fee = $booking['total_amount'] * 0.10; // 10%
        $tax = $booking['total_amount'] * 0.05; // 5%

        return [
            'booking_id' => $booking['booking_id'],
            'selected_seats' => $booking['seats'] ? explode(',', $booking['seats']) : [],
            'total_amount' => 'MWK ' . number_format($booking['total_amount'], 2),
            'base_fare' => 'MWK ' . number_format($base_fare, 2),
            'booking_fee' => 'MWK ' . number_format($booking_fee, 2),
            'tax' => 'MWK ' . number_format($tax, 2),
            'status' => $booking['status']
        ];
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return null;
    }
}

$booking_details = $booking_id ? getBookingDetails($db, $booking_id) : null;

// Handle JSON requests first
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SERVER['CONTENT_TYPE']) &&
    strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false
) {

    // Always set JSON content type for API requests
    header('Content-Type: application/json');

    try {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['amount']) || !isset($input['booking_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid request data']);
            exit; // Make sure to exit here
        }

        // Process based on payment method
        $payment_method = $input['payment_method'] ?? 'card';

        if ($payment_method === 'card') {
            \Stripe\Stripe::setApiKey('sk_test_51R2TeJJ727hNgr1W4ZdgotMwKko1R7Rl4LBPlXKUhSs01mtDWTzcIZkXt4RaUQL6FM5QiS6OtXkHLb5c8eYRAGrr00Qm4Imgpo');

            $amount_gbp = round($input['amount'] * 0.00044 * 100); // MWK to GBP pennies

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount_gbp,
                'currency' => 'gbp',
                'payment_method_types' => ['card'],
                'description' => 'Bus Ticket Payment',
                'metadata' => [
                    'booking_id' => $input['booking_id'],
                    'original_amount_mwk' => $input['amount']
                ]
            ]);

            // Update booking status in database
            $stmt = $db->prepare("UPDATE bookingsumma SET status = 'confirmed' WHERE booking_id = ?");
            $stmt->execute([$input['booking_id']]);

            // Generate ticket number
            $ticket_number = 'TKT' . strtoupper(substr(md5($input['booking_id'] . time()), 0, 8));

            // Insert into payment_details
            $insertPayment = $db->prepare("
                INSERT INTO payment_details 
                (booking_id, payment_intent_id, payment_status, amount, card_name, ticket_number)
                VALUES (?, ?, 'succeeded', ?, ?, ?)
            ");
            $insertPayment->execute([
                $input['booking_id'],
                $paymentIntent->id,
                $input['amount'],
                $input['card_name'] ?? 'Card Payment', // Make sure to collect this from the form
                $ticket_number
            ]);

            echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
            exit;
        } elseif ($payment_method === 'mobile_money') {
            // For mobile money, we'll just return a reference number for now
            // In a real implementation, you would integrate with a mobile money API
            $reference = 'MM' . strtoupper(substr(md5($input['booking_id'] . time()), 0, 8));

            echo json_encode([
                'reference' => $reference,
                'phone' => $input['phone'] ?? '',
                'provider' => $input['provider'] ?? 'Unknown'
            ]);
            exit;
        } elseif ($payment_method === 'bank_transfer') {
            // For bank transfer, return account details
            $reference = 'BT' . strtoupper(substr(md5($input['booking_id'] . time()), 0, 8));
            $bank_name = $input['bank_name'] ?? 'National Bank of Malawi';

            echo json_encode([
                'reference' => $reference,
                'account_number' => '1234567890',
                'bank_name' => $bank_name,
                'account_name' => 'Bus Ticketing System'
            ]);
            exit;
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid payment method']);
            exit;
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

// Process mobile money payment verification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_mobile_money'])) {
    try {
        $transaction_id = $_POST['transaction_id'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $booking_id = $_POST['booking_id'] ?? '';

        // In a real implementation, you would verify with the mobile money provider's API
        // For demo purposes, we'll just assume it's verified if transaction_id isn't empty
        if (empty($transaction_id)) {
            $_SESSION['payment_error'] = 'Please enter a valid transaction ID';
        } else {
            // Generate ticket number
            $ticket_number = 'TKT' . strtoupper(substr(md5($booking_id . time()), 0, 8));

            // Update booking status in database
            $stmt = $db->prepare("UPDATE bookingsumma SET status = 'confirmed' WHERE booking_id = ?");
            $stmt->execute([$booking_id]);

            // Get booking amount
            $amountStmt = $db->prepare("SELECT total_amount FROM bookingsumma WHERE booking_id = ?");
            $amountStmt->execute([$booking_id]);
            $amount = $amountStmt->fetchColumn();

            // Insert into payment_details
            $insertPayment = $db->prepare("
                INSERT INTO payment_details 
                (booking_id, payment_intent_id, payment_status, amount, ticket_number)
                VALUES (?, ?, 'succeeded', ?, ?)
            ");
            $insertPayment->execute([
                $booking_id,
                $transaction_id, // Use transaction ID as payment_intent_id
                $amount,
                $ticket_number
            ]);

            // Redirect to ticket page
            header("Location: qrcode.php?booking_id=$booking_id");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['payment_error'] = 'Error processing payment: ' . $e->getMessage();
    }
}

// Process bank transfer verification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_bank_transfer'])) {
    try {
        $transaction_id = $_POST['transaction_id'] ?? '';
        $booking_id = $_POST['booking_id'] ?? '';
        $bank_name = $_POST['bank_name'] ?? '';

        // In a real implementation, you would verify with the bank's API
        // For demo purposes, we'll just assume it's verified if transaction_id isn't empty
        if (empty($transaction_id)) {
            $_SESSION['payment_error'] = 'Please enter a valid transaction ID';
        } else {
            // Generate ticket number
            $ticket_number = 'TKT' . strtoupper(substr(md5($booking_id . time()), 0, 8));

            // Update booking status in database
            $stmt = $db->prepare("UPDATE bookingsumma SET status = 'confirmed' WHERE booking_id = ?");
            $stmt->execute([$booking_id]);

            // Get booking amount
            $amountStmt = $db->prepare("SELECT total_amount FROM bookingsumma WHERE booking_id = ?");
            $amountStmt->execute([$booking_id]);
            $amount = $amountStmt->fetchColumn();

            // Insert into payment_details
            $insertPayment = $db->prepare("
                INSERT INTO payment_details 
                (booking_id, payment_intent_id, payment_status, amount, ticket_number)
                VALUES (?, ?, 'succeeded', ?, ?)
            ");
            $insertPayment->execute([
                $booking_id,
                $transaction_id, // Use transaction ID as payment_intent_id
                $amount,
                $ticket_number
            ]);

            // Redirect to ticket page
            header("Location: qrcode.php?booking_id=$booking_id");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['payment_error'] = 'Error processing payment: ' . $e->getMessage();
    }
}


// Only include HTML if not a JSON API request
if (!($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SERVER['CONTENT_TYPE']) &&
    strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false)) {
    // Render the HTML content only if it's not a JSON request
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Processing</title>
        <style>
            .payment-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }

            .summary-item {
                display: flex;
                justify-content: space-between;
                margin: 10px 0;
                padding: 10px;
                background: #f8f9fa;
                border-radius: 5px;
            }

            .summary-total {
                font-weight: bold;
                border-top: 2px solid #333;
                margin-top: 15px;
                padding-top: 10px;
            }

            #card-element {
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 4px;
                margin: 10px 0;
            }

            .payment-button {
                background: #004494;
                color: white;
                padding: 12px;
                border: none;
                border-radius: 4px;
                width: 100%;
                cursor: pointer;
                font-size: 16px;
                margin-top: 20px;
            }

            .payment-button:disabled {
                background: #cccccc;
            }

            .payment-error {
                color: #dc3545;
                margin: 10px 0;
            }

            .hidden {
                display: none;
            }

            .success-message {
                background: #d4edda;
                color: #004494;
                padding: 20px;
                border-radius: 5px;
                margin: 20px 0;
                text-align: center;
            }

            .payment-methods {
                margin: 20px 0;
            }

            .payment-method {
                margin: 10px 0;
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                cursor: pointer;
            }

            .payment-method.active {
                border-color: #004494;
                background-color: #f0f7ff;
            }

            .payment-method-title {
                font-weight: bold;
                margin-bottom: 5px;
            }

            .payment-method-description {
                color: #666;
                font-size: 14px;
            }

            .payment-details {
                margin-top: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .form-control {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .alert {
                padding: 15px;
                border-radius: 5px;
                margin: 15px 0;
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
            }

            .alert-info {
                background-color: #d1ecf1;
                color: #0c5460;
            }

            .payment-instructions {
                background: #fff3cd;
                border: 1px solid #ffeeba;
                color: #856404;
                padding: 15px;
                border-radius: 5px;
                margin: 15px 0;
            }
        </style>
    </head>

    <body>
        <div class="payment-container">
            <h1>Complete Your Payment</h1>

            <?php if (isset($_SESSION['payment_error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['payment_error']) ?>
                </div>
                <?php unset($_SESSION['payment_error']); ?>
            <?php endif; ?>

            <?php if ($booking_details && $booking_details['status'] === 'pending'): ?>
                <div class="booking-summary">
                    <h2>Booking Summary</h2>
                    <div class="summary-item">
                        <span>Booking ID:</span>
                        <span><?= htmlspecialchars($booking_details['booking_id']) ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Selected Seats:</span>
                        <span><?= htmlspecialchars(implode(', ', $booking_details['selected_seats'])) ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Base Fare:</span>
                        <span><?= htmlspecialchars($booking_details['base_fare']) ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Booking Fee:</span>
                        <span><?= htmlspecialchars($booking_details['booking_fee']) ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Tax:</span>
                        <span><?= htmlspecialchars($booking_details['tax']) ?></span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total Amount:</span>
                        <span><?= htmlspecialchars($booking_details['total_amount']) ?></span>
                    </div>
                </div>
                <h2>Select Payment Method</h2>
                <div class="payment-methods">
                    <div class="payment-method" data-method="card">
                        <div class="payment-method-title">Credit/Debit Card</div>
                        <div class="payment-method-description">Pay securely with your credit or debit card</div>
                    </div>

                    <div class="payment-method" data-method="mobile_money">
                        <div class="payment-method-title">Mobile Money</div>
                        <div class="payment-method-description">Pay using Airtel Money, TNM Mpamba or other mobile money services</div>
                    </div>

                    <div class="payment-method" data-method="bank_transfer">
                        <div class="payment-method-title">Bank Transfer</div>
                        <div class="payment-method-description">Pay directly from your bank account</div>
                    </div>
                </div>

                <!-- Credit Card Payment Form -->
                <div id="card-payment-form" class="payment-details hidden">
                    <h3>Card Payment</h3>
                    <form id="payment-form">
                        <div class="form-group">
                            <label for="card-name">Name on Card</label>
                            <input type="text" id="card-name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Card Details</label>
                            <div id="card-element"></div>
                            <div id="card-errors" class="payment-error" role="alert"></div>
                        </div>
                        <button id="payment-button" class="payment-button">Pay Now</button>
                    </form>
                </div>

                <!-- Mobile Money Payment Form -->
                <div id="mobile-money-form" class="payment-details hidden">
                    <h3>Mobile Money Payment</h3>
                    <div class="payment-instructions">
                        <p>To pay with Mobile Money:</p>
                        <ol>
                            <li>Select your mobile money provider below</li>
                            <li>Enter your phone number</li>
                            <li>Click "Get Payment Instructions"</li>
                            <li>Follow the instructions to make the payment</li>
                            <li>Enter the transaction ID to verify your payment</li>
                        </ol>
                    </div>

                    <div id="mobile-money-setup">
                        <div class="form-group">
                            <label for="mobile-provider">Select Provider</label>
                            <select id="mobile-provider" class="form-control">
                                <option value="airtel">Airtel Money</option>
                                <option value="tnm">TNM Mpamba</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mobile-phone">Your Phone Number</label>
                            <input type="tel" id="mobile-phone" class="form-control" placeholder="e.g. 0888123456" required>
                        </div>
                        <button id="mobile-money-button" class="payment-button">Get Payment Instructions</button>
                    </div>

                    <div id="mobile-money-instructions" class="hidden">
                        <div class="payment-instructions">
                            <p><strong>Payment Instructions:</strong></p>
                            <p>1. Dial <span id="ussd-code">*XXX#</span> on your phone</p>
                            <p>2. Select "Pay Merchant"</p>
                            <p>3. Enter Merchant Code: <strong id="merchant-code">BUSTICKET</strong></p>
                            <p>4. Enter Amount: <strong id="mm-amount"><?= str_replace(['MWK', ',', ' '], '', $booking_details['total_amount'] ?? '0') ?></strong></p>
                            <p>5. Enter Reference Number: <strong id="mm-reference"></strong></p>
                            <p>6. Confirm and enter your PIN</p>
                        </div>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="mm-transaction-id">Enter Transaction ID</label>
                                <input type="text" id="mm-transaction-id" name="transaction_id" class="form-control" required>
                            </div>
                            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking_details['booking_id']) ?>">
                            <input type="hidden" name="phone" id="mm-phone-submit">
                            <input type="hidden" name="verify_mobile_money" value="1">
                            <button type="submit" class="payment-button">Verify Payment</button>
                        </form>
                    </div>
                </div>

                <!-- Bank Transfer Payment Form -->
                <div id="bank-transfer-form" class="payment-details hidden">
                    <h3>Bank Transfer Payment</h3>
                    <div class="payment-instructions">
                        <p>To pay with Bank Transfer:</p>
                        <ol>
                            <li>Select your bank from the dropdown below</li>
                            <li>Use the account details below to make a transfer</li>
                            <li>Use the reference number as your payment reference</li>
                            <li>After making the transfer, enter the transaction ID to verify your payment</li>
                        </ol>
                    </div>

                    <div id="bank-transfer-details">
                        <div class="form-group">
                            <label for="bank-name">Select Your Bank</label>
                            <select id="bank-name" class="form-control" name="bank_name">
                                <option value="National Bank of Malawi">National Bank of Malawi</option>
                                <option value="Standard Bank Malawi">Standard Bank Malawi</option>
                                <option value="First Capital Bank Malawi">First Capital Bank Malawi</option>
                                <option value="NBS Bank">NBS Bank</option>
                                <option value="FDH Bank">FDH Bank</option>
                                <option value="CDH Investment Bank">CDH Investment Bank</option>
                                <option value="Ecobank Malawi">Ecobank Malawi</option>
                                <option value="MyBucks Banking Corporation">MyBucks Banking Corporation</option>
                                <option value="First Discount House">First Discount House</option>
                                <option value="Continental Discount House">Continental Discount House</option>
                                <option value="Reserve Bank of Malawi">Reserve Bank of Malawi</option>
                            </select>
                        </div>
                        <div class="summary-item">
                            <span>Bank Name:</span>
                            <span id="display-bank-name">National Bank of Malawi</span>
                        </div>
                        <div class="summary-item">
                            <span>Account Name:</span>
                            <span>Bus Ticketing System</span>
                        </div>
                        <div class="summary-item">
                            <span>Account Number:</span>
                            <span>1234567890</span>
                        </div>
                        <div class="summary-item">
                            <span>Reference:</span>
                            <span id="bt-reference"></span>
                        </div>
                        <div class="summary-item summary-total">
                            <span>Amount to Transfer:</span>
                            <span><?= htmlspecialchars($booking_details['total_amount']) ?></span>
                        </div>
                    </div>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="bt-transaction-id">Enter Transaction ID/Reference</label>
                            <input type="text" id="bt-transaction-id" name="transaction_id" class="form-control" required>
                        </div>
                        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking_details['booking_id']) ?>">
                        <input type="hidden" name="bank_name" id="selected-bank-name" value="National Bank of Malawi">
                        <input type="hidden" name="verify_bank_transfer" value="1">
                        <button type="submit" class="payment-button">Verify Payment</button>
                    </form>
                </div>

                <div id="success-message" class="hidden success-message">
                    <h2>Payment Successful!</h2>
                    <p>Your booking has been confirmed. Redirecting to your ticket...</p>
                </div>
            <?php elseif ($booking_details && $booking_details['status'] !== 'pending'): ?>
                <div class="alert alert-info">
                    <p>This booking has already been <?= $booking_details['status'] ?>.</p>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    <p>Invalid booking reference. Please try again.</p>
                </div>
            <?php endif; ?>
        </div>
        <?php
        include('../pages/footer.php');  // Include footer.php
        ?>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            // Initialize variables
            const stripe = Stripe('pk_test_51R2TeJJ727hNgr1Wc6m5LetGNjLsnpPAxURczlqrslcn5iaFaOItEnZmUlLvnWugmN7fit3jXJaExSOUB6D6dVcr00NQXyCWXD');
            const elements = stripe.elements();
            const cardElement = elements.create('card');

            // Get DOM elements
            const paymentMethods = document.querySelectorAll('.payment-method');
            const cardPaymentForm = document.getElementById('card-payment-form');
            const mobileMoneyForm = document.getElementById('mobile-money-form');
            const bankTransferForm = document.getElementById('bank-transfer-form');
            const successMessage = document.getElementById('success-message');

            // Set up card payment form
            if (cardPaymentForm) {
                cardElement.mount('#card-element');

                const form = document.getElementById('payment-form');
                const paymentButton = document.getElementById('payment-button');

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    paymentButton.disabled = true;
                    document.getElementById('card-errors').textContent = '';

                    try {
                        // Get numeric amount (remove MWK and commas)
                        const amount = <?= str_replace(['MWK', ',', ' '], '', $booking_details['total_amount'] ?? '0') ?>;
                        const cardName = document.getElementById('card-name').value.trim();

                        if (!cardName) {
                            throw new Error('Please enter the name on your card.');
                        }

                        // Create payment intent
                        const response = await fetch(window.location.href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                amount: amount,
                                booking_id: '<?= $booking_details['booking_id'] ?? '' ?>',
                                payment_method: 'card',
                                card_name: cardName
                            })
                        });

                        if (!response.ok) {
                            const errorText = await response.text();
                            console.error("Server response:", errorText);
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();

                        if (result.error) {
                            throw new Error(result.error);
                        }

                        // Confirm card payment
                        const {
                            paymentIntent,
                            error
                        } = await stripe.confirmCardPayment(
                            result.clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: {
                                        name: cardName
                                    }
                                }
                            }
                        );

                        if (error) {
                            throw error;
                        }

                        if (paymentIntent.status === 'succeeded') {
                            // Show success and redirect
                            cardPaymentForm.classList.add('hidden');
                            successMessage.classList.remove('hidden');

                            setTimeout(() => {
                                window.location.href = `qrcode.php?booking_id=<?= $booking_details['booking_id'] ?? '' ?>`;
                            }, 2000);
                        }
                    } catch (error) {
                        console.error('Payment error:', error);
                        document.getElementById('card-errors').textContent = error.message;
                        paymentButton.disabled = false;
                    }
                });
            }

            // Set up mobile money payment
            if (mobileMoneyForm) {
                const mobileMoneyButton = document.getElementById('mobile-money-button');
                const mobileMoneySetup = document.getElementById('mobile-money-setup');
                const mobileMoneyInstructions = document.getElementById('mobile-money-instructions');

                mobileMoneyButton.addEventListener('click', async () => {
                    const provider = document.getElementById('mobile-provider').value;
                    const phone = document.getElementById('mobile-phone').value.trim();

                    if (!phone) {
                        alert('Please enter your phone number');
                        return;
                    }

                    try {
                        // Get numeric amount (remove MWK and commas)
                        const amount = <?= str_replace(['MWK', ',', ' '], '', $booking_details['total_amount'] ?? '0') ?>;

                        // Create mobile money payment request
                        const response = await fetch(window.location.href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                amount: amount,
                                booking_id: '<?= $booking_details['booking_id'] ?? '' ?>',
                                payment_method: 'mobile_money',
                                phone: phone,
                                provider: provider
                            })
                        });

                        if (!response.ok) {
                            const errorText = await response.text();
                            console.error("Server response:", errorText);
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();

                        if (result.error) {
                            throw new Error(result.error);
                        }

                        // Update USSD code based on provider
                        let ussdCode = '*123#';
                        if (provider === 'airtel') {
                            ussdCode = '*211#';
                        } else if (provider === 'tnm') {
                            ussdCode = '*444#';
                        }

                        // Update instructions
                        document.getElementById('ussd-code').textContent = ussdCode;
                        document.getElementById('mm-reference').textContent = result.reference;
                        document.getElementById('mm-phone-submit').value = phone;

                        // Show instructions
                        mobileMoneySetup.classList.add('hidden');
                        mobileMoneyInstructions.classList.remove('hidden');

                    } catch (error) {
                        console.error('Mobile money error:', error);
                        alert('Error: ' + error.message);
                    }
                });
            }

            // Set up bank transfer payment
            if (bankTransferForm) {
                // Handle bank selection change
                const bankNameSelect = document.getElementById('bank-name');
                const displayBankName = document.getElementById('display-bank-name');
                const selectedBankNameInput = document.getElementById('selected-bank-name');

                bankNameSelect.addEventListener('change', function() {
                    const selectedBank = this.value;
                    displayBankName.textContent = selectedBank;
                    selectedBankNameInput.value = selectedBank;
                });

                // Generate a reference number for bank transfer
                (async () => {
                    try {
                        // Get numeric amount (remove MWK and commas)
                        const amount = <?= str_replace(['MWK', ',', ' '], '', $booking_details['total_amount'] ?? '0') ?>;

                        // Create bank transfer payment request
                        const response = await fetch(window.location.href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                amount: amount,
                                booking_id: '<?= $booking_details['booking_id'] ?? '' ?>',
                                payment_method: 'bank_transfer',
                                bank_name: document.getElementById('bank-name').value
                            })
                        });

                        if (!response.ok) {
                            const errorText = await response.text();
                            console.error("Server response:", errorText);
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();

                        if (result.error) {
                            throw new Error(result.error);
                        }

                        // Update reference number
                        document.getElementById('bt-reference').textContent = result.reference;

                    } catch (error) {
                        console.error('Bank transfer error:', error);
                        alert('Error: ' + error.message);
                    }
                })();
            }

            // Payment method selection
            paymentMethods.forEach(method => {
                method.addEventListener('click', () => {
                    // Remove active class from all methods
                    paymentMethods.forEach(m => m.classList.remove('active'));
                    // Add active class to selected method
                    method.classList.add('active');

                    // Hide all payment forms
                    cardPaymentForm.classList.add('hidden');
                    mobileMoneyForm.classList.add('hidden');
                    bankTransferForm.classList.add('hidden');

                    // Show selected payment form
                    const selectedMethod = method.getAttribute('data-method');
                    if (selectedMethod === 'card') {
                        cardPaymentForm.classList.remove('hidden');
                    } else if (selectedMethod === 'mobile_money') {
                        mobileMoneyForm.classList.remove('hidden');
                    } else if (selectedMethod === 'bank_transfer') {
                        bankTransferForm.classList.remove('hidden');
                    }
                });
            });

            // Default to first payment method
            if (paymentMethods.length > 0) {
                paymentMethods[0].click();
            }
        </script>
    </body>

    </html>
<?php
}
?>