<?php
// onit-rest/webhook.php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/services/recurrente.php'; // For processing payment data
require_once __DIR__ . '/services/amy.php'; // For sending SMS notifications
// Potentially other services if needed based on webhook actions

logMessage('Webhook endpoint hit.', 'INFO');

// TODO: Implement webhook request validation logic here.
// This is crucial for security.
// - Verify the request origin (e.g., check IP address if RECURRENTE provides a list).
// - Validate any signature provided by RECURRENTE (e.g., HMAC SHA256).
//   $recurrenteSecretKey = RECURRENTE_API_KEY; // Or a specific webhook secret
//   $expectedSignature = '...'; // Calculate based on Recurrente's documentation
//   $receivedSignature = $_SERVER['HTTP_X_RECURRENTE_SIGNATURE'] ?? '';
//   if (!hash_equals($expectedSignature, $receivedSignature)) {
//       logMessage('Webhook request validation failed: Invalid signature.', 'ERROR');
//       http_response_code(403); // Forbidden
//       echo json_encode(['status' => 'error', 'message' => 'Invalid signature.']);
//       exit;
//   }

// Get the raw POST data
$payload = file_get_contents('php://input');
if (!$payload) {
    logMessage('Webhook received empty payload.', 'WARNING');
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Empty payload.']);
    exit;
}

// Decode the JSON payload
$data = json_decode($payload, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    logMessage('Webhook received invalid JSON: ' . json_last_error_msg(), 'ERROR');
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload.']);
    exit;
}

logMessage('Webhook payload received: ' . $payload, 'DEBUG');

// TODO: Implement webhook processing logic here.
// This will typically involve:
// - Identifying the event type from the $data.
// - Calling the appropriate function from `services/recurrente.php` (e.g., processRecurrentePayment).
// - Potentially interacting with other services (e.g., updating database, sending SMS via AMY).

// Example:
// if (isset($data['event_type']) && $data['event_type'] === 'payment.succeeded') {
//     $paymentData = $data['data']['object']; // Adjust based on actual payload structure
//     $result = processRecurrentePayment($paymentData);
//     if ($result) {
//         logMessage('Webhook: Payment processed successfully for ID: ' . ($paymentData['id'] ?? 'N/A'), 'INFO');
//         // Optionally send an SMS confirmation
//         // sendSmsWithAmy('Your_Phone_Number', 'Your payment was successful!');
//         http_response_code(200);
//         echo json_encode(['status' => 'success', 'message' => 'Webhook processed.']);
//     } else {
//         logMessage('Webhook: Failed to process payment for ID: ' . ($paymentData['id'] ?? 'N/A'), 'ERROR');
//         http_response_code(500); // Internal Server Error
//         echo json_encode(['status' => 'error', 'message' => 'Failed to process payment.']);
//     }
// } else {
//     logMessage('Webhook: Received unhandled event type: ' . ($data['event_type'] ?? 'Unknown'), 'WARNING');
//     http_response_code(200); // Acknowledge receipt even if not handled, or 400 if it's an error
//     echo json_encode(['status' => 'info', 'message' => 'Event type not handled.']);
// }

// Default response if no specific logic handles the event
http_response_code(200); // Acknowledge receipt of the webhook
echo json_encode(['status' => 'success', 'message' => 'Webhook received. Processing will occur.']);

exit;
?>
