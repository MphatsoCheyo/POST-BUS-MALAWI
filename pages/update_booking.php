<?php
// payment_api.php - Dedicated endpoint for Stripe payment intent creation
require_once('../vendor/autoload.php');

// Set content type header immediately
header('Content-Type: application/json');

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=bus', 'root', 'secure');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug information
    error_log("Payment API request received");
    
    try {
        // Get and validate input data
        $rawInput = file_get_contents('php://input');
        error_log("Raw input: " . $rawInput);
        
        $input = json_decode($rawInput, true);
        
        if (!$input) {
            throw new Exception('Invalid JSON: ' . json_last_error_msg());
        }
        
        if (!isset($input['amount'])) {
            throw new Exception('Missing required field: amount');
        }
        
        if (!isset($input['booking_id'])) {
            throw new Exception('Missing required field: booking_id');
        }
        
        // Validate booking exists and is in pending state
        $stmt = $db->prepare("SELECT status FROM bookingsumma WHERE booking_id = ?");
        $stmt->execute([$input['booking_id']]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$booking) {
            throw new Exception('Booking not found');
        }
        
        if ($booking['status'] !== 'pending') {
            throw new Exception('Booking is not in pending state');
        }

        // Set up Stripe
        \Stripe\Stripe::setApiKey('sk_test_51R2TeJJ727hNgr1W4ZdgotMwKko1R7Rl4LBPlXKUhSs01mtDWTzcIZkXt4RaUQL6FM5QiS6OtXkHLb5c8eYRAGrr00Qm4Imgpo');
        
        // Convert amount to GBP pennies (ensure it's numeric first)
        $amount = floatval($input['amount']);
        $amount_gbp = max(round($amount * 0.00044 * 100), 50); // Minimum 50 pence for testing
        
        error_log("Creating payment intent for amount: " . $amount . " MWK, converted to: " . $amount_gbp . " GBP pennies");
        
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount_gbp,
            'currency' => 'gbp',
            'payment_method_types' => ['card'],
            'description' => 'Bus Ticket Payment for Booking #' . $input['booking_id'],
            'metadata' => [
                'booking_id' => $input['booking_id'],
                'original_amount_mwk' => $amount
            ]
        ]);
        
        error_log("Payment intent created successfully: " . $paymentIntent->id);
        echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
        
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Stripe API errors
        error_log("Stripe API error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode(['error' => 'Stripe error: ' . $e->getMessage()]);
    } catch (Exception $e) {
        // General errors
        error_log("Payment API error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    // Only allow POST requests
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
}
?>