<?php
require_once('../vendor/autoload.php');
header('Content-Type: application/json');

$db = new PDO('mysql:host=localhost;dbname=bus', 'root', 'secure');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$input = json_decode(file_get_contents('php://input'), true);

try {
    if ($input['action'] === 'process_payment') {
        $db->beginTransaction();
        
        // Update booking status
        $stmt = $db->prepare("UPDATE bookingsumma SET status = 'confirmed', payment_method = ?, payment_reference = ? WHERE booking_id = ?");
        $stmt->execute([
            $input['payment_method'],
            $input['payment_intent_id'],
            $input['booking_id']
        ]);
        
        // Insert payment details
        $stmt = $db->prepare("
            INSERT INTO payment_detail 
            (booking_id, payment_status, amount, card_name) 
            VALUES (?, 'succeeded', ?, ?)
        ");
        $stmt->execute([
            $input['booking_id'],
            $input['amount'],
            $input['card_name'] ?? null
        ]);
        
        $db->commit();
        
        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}