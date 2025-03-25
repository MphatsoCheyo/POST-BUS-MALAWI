<?php
/**
 * log-error.php - Handles client-side error logging
 * Place this file in the same directory as the booking.php file
 */
session_start();

// Define a log file location
define('CLIENT_ERROR_LOG_FILE', '../logs/client_errors.log');

// Create log directory if it doesn't exist
if (!file_exists('../logs')) {
    mkdir('../logs', 0755, true);
}

/**
 * Function to log client-side errors
 * @param array $errorData Error data from client
 * @return void
 */
function logClientError($errorData) {
    $timestamp = date('Y-m-d H:i:s');
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not logged in';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    $logMessage = "[{$timestamp}] [IP: {$ipAddress}] [User: {$userId}] [UA: {$userAgent}]";
    
    // Add error data if provided
    if (!empty($errorData)) {
        $logMessage .= " | Error Data: " . json_encode($errorData);
    }
    
    // Append to log file
    file_put_contents(CLIENT_ERROR_LOG_FILE, $logMessage . PHP_EOL, FILE_APPEND);
    
    // Also log to PHP error log for system monitoring
    error_log("Client Error: " . json_encode($errorData));
}

// Handle incoming error data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : "";
    
    // Check if the request is JSON
    if (strpos($contentType, "application/json") !== false) {
        // Get the JSON input
        $jsonInput = file_get_contents("php://input");
        $errorData = json_decode($jsonInput, true);
        
        // Check for JSON parsing errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Invalid JSON data"]);
            exit;
        }
        
        // Log the error
        logClientError($errorData);
        
        // Send success response
        echo json_encode(["success" => true, "message" => "Error logged successfully"]);
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid content type"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
}
