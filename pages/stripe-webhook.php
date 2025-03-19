<?php
require_once 'stripe-config.php';
require_once 'db.php';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$endpoint_secret = 'YOUR_WEBHOOK_SECRET';

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch(\UnexpectedValueException $e) {
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    exit();
}

switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object;
        // Update booking status in database
        $bookingId = $paymentIntent->metadata->booking_id;
        // Add your database update logic here
        break;
    case 'payment_intent.payment_failed':
        $paymentIntent = $event->data->object;
        // Handle failed payment
        break;
}

http_response_code(200);