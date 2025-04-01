<?php
// Disable all error reporting to prevent unexpected output
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Ensure no output before JSON
ob_start();

try {
    // Autoload Stripe library
    require_once('../vendor/autoload.php');

    // Enhanced error logging function
    function logPaymentError($error, $context = []) {
        error_log(json_encode([
            'timestamp' => date('Y-m-d H:i:s'),
            'error' => $error,
            'context' => $context
        ]));
    }
    
    try {
        // Validate input more rigorously
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method');
        }
    
        $input = json_decode(file_get_contents('php://input'), true);
        
        // Comprehensive input validation
        if (!$input || 
            !isset($input['amount']) || 
            !isset($input['booking_id']) || 
            !is_numeric($input['amount'])
        ) {
            http_response_code(400);
            throw new Exception('Invalid or missing payment details');
        }
    
        // Set Stripe API key securely (preferably from environment variable)
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY') ?: 'your_secret_key');
    
        // Convert amount with proper error handling
        $amountInCents = intval(round($input['amount'] * 100 * 0.00044));
        
        if ($amountInCents <= 0) {
            throw new Exception('Invalid payment amount');
        }
    
        // Create Payment Intent with more comprehensive parameters
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amountInCents,
            'currency' => 'gbp',
            'payment_method_types' => ['card'],
            'description' => 'Bus Ticket Payment',
            'metadata' => [
                'booking_id' => $input['booking_id'],
                'original_amount_mwk' => $input['amount'],
                'platform' => 'Post Bus Malawi'
            ],
            'confirm' => false, // Do not confirm immediately
            'capture_method' => 'manual' // Allow manual capture for additional verification
        ]);
    
        // Return client secret securely
        header('Content-Type: application/json');
        echo json_encode([
            'clientSecret' => $paymentIntent->client_secret,
            'bookingId' => $input['booking_id']
        ]);
        exit;
    
    } catch (\Stripe\Exception\CardException $e) {
        // Handle card-specific errors
        logPaymentError('Card Error', [
            'message' => $e->getError()->message,
            'code' => $e->getError()->code
        ]);
        
        http_response_code(402);
        echo json_encode([
            'error' => 'Payment failed',
            'details' => $e->getError()->message
        ]);
    } catch (\Exception $e) {
        // Catch-all error handling
        logPaymentError('Payment Processing Error', [
            'message' => $e->getMessage()
        ]);
        
        http_response_code(500);
        echo json_encode([
            'error' => 'Internal server error',
            'details' => 'Unable to process payment'
        ]);
    }
    // Database connection parameters
    $servername = "localhost";
    $username = "root";  // Adjust as needed
    $password = "";      // Adjust as needed
    $dbname = "bus";  // Your database name

    // Stripe configuration (ensure this is correct)
    \Stripe\Stripe::setApiKey('sk_test_51R2TeJJ727hNgr1Wc6m5LetGNjLsnpPAxURczlqrslcn5iaFaOItEnZmUlLvnWugmN7fit3jXJaExSOUB6D6dVcr00NQXyCWXD');

    // Create database connection with error handling
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Get POST data
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validate input
    if (!$input) {
        throw new Exception('Invalid input data');
    }

    // Track if transaction is in progress
    $transaction_started = false;

    try {
        // Begin transaction
        $conn->autocommit(FALSE);
        $transaction_started = true;

        // Create booking summary record
        $total_amount = isset($input['amount']) ? $input['amount'] / 100 : 0; // Convert cents to dollars
        $insert_booking_sql = "INSERT INTO bookingsumma (total_amount, status) VALUES (?, 'pending')";
        $stmt = $conn->prepare($insert_booking_sql);
        $stmt->bind_param("d", $total_amount);
        $stmt->execute();
        $booking_id = $stmt->insert_id;
        $stmt->close();

        // Create payment intent with Stripe
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $input['amount'], // Amount in cents
            'currency' => 'mwk', // Malawian Kwacha
            'payment_method_types' => ['card'],
            'metadata' => ['booking_id' => $booking_id]
        ]);

        // Insert initial payment details
        $insert_payment_sql = "
            INSERT INTO payment_details 
            (booking_id, payment_intent_id, payment_status, amount) 
            VALUES (?, ?, 'pending', ?)
        ";
        $stmt = $conn->prepare($insert_payment_sql);
        $stmt->bind_param("isd", $booking_id, $paymentIntent->id, $total_amount);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $conn->commit();
        $transaction_started = false;

        // Clear any previous output
        ob_clean();

        // Return client secret for frontend to confirm payment
        echo json_encode([
            'clientSecret' => $paymentIntent->client_secret,
            'bookingId' => $booking_id
        ]);

    } catch (Exception $e) {
        // Rollback transaction if it was started
        if ($transaction_started) {
            $conn->rollback();
        }
        
        // Re-throw the exception to be caught by outer catch block
        throw $e;
    } finally {
        // Reset autocommit to default
        $conn->autocommit(TRUE);
    }

} catch (Exception $e) {
    // Clear any previous output
    ob_clean();

    // Return error response
    echo json_encode([
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}

// Close database connection if it exists
if (isset($conn)) {
    $conn->close();
}

// End output buffering
ob_end_flush();
exit;
?>