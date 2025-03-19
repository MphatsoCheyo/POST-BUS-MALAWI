<?php
require_once 'db.php';
require_once 'stripe-config.php';

// Get POST data
$jsonData = json_decode(file_get_contents('php://input'), true);

try {
    // Create payment intent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => (int)$jsonData['amount'],
        'currency' => 'mwk',
        'payment_method_types' => ['card'],
        'description' => 'Bus Ticket Payment',
        'metadata' => [
            'booking_ref' => $jsonData['booking_ref'],
            'seats' => implode(',', $jsonData['seats'])
        ]
    ]);

    // Return the client secret
    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}