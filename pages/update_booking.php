<?php
header('Content-Type: application/json');
require_once('db.php');

$input = json_decode(file_get_contents('php://input'), true);

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("UPDATE seats SET status = 'paid', payment_method = :payment_method, 
                          payment_reference = :payment_reference, updated_at = NOW() 
                          WHERE booking_id = :booking_id");
    
    $stmt->bindParam(':booking_id', $input['booking_id']);
    $stmt->bindParam(':payment_method', $input['payment_method']);
    $stmt->bindParam(':payment_reference', $input['payment_reference']);
    
    $stmt->execute();
    
    echo json_encode(['success' => true]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>