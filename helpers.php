<?php
// onit-rest/helpers.php

require_once __DIR__ . '/config.php';

/**
 * Sends an HTTP request.
 *
 * @param string $method The HTTP method (e.g., 'GET', 'POST').
 * @param string $url The URL to send the request to.
 * @param array $data Optional. Data to send with the request (e.g., for POST).
 * @param array $headers Optional. HTTP headers to send with the request.
 * @return string|false The response body on success, or false on failure.
 */
function sendHttpRequest($method, $url, $data = [], $headers = []) {
    // TODO: Implement HTTP request logic using cURL or file_get_contents with stream context.
    // Consider aspects like setting appropriate headers (e.g., Content-Type, Authorization),
    // handling different HTTP methods, and error checking.
    // Example using cURL:
    /*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

    if (!empty($data) && (strtoupper($method) === 'POST' || strtoupper($method) === 'PUT')) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Or json_encode($data) if API expects JSON
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        logMessage('HTTP Request Error: ' . $curlError . ' for URL: ' . $url);
        return false;
    }

    if ($httpCode >= 400) {
        logMessage('HTTP Error ' . $httpCode . ': ' . $response . ' for URL: ' . $url);
        return false;
    }

    return $response;
    */
    logMessage("TODO: Implement sendHttpRequest for {$method} {$url}");
    return false;
}

/**
 * Logs a message to a configured log file.
 *
 * @param string $message The message to log.
 * @param string $level Optional. The log level (e.g., 'INFO', 'ERROR', 'DEBUG').
 * @return void
 */
function logMessage($message, $level = 'INFO') {
    $logFilePath = LOG_FILE_PATH;
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;

    // Use error_log for simplicity if file writing becomes complex,
    // or implement more robust logging (e.g., Monolog) if needed.
    // Ensure the log file is writable by the web server/PHP process.
    if (is_writable(dirname($logFilePath))) {
        file_put_contents($logFilePath, $logEntry, FILE_APPEND);
    } else {
        // Fallback or error handling if log file is not writable
        error_log("Logging to file failed. Log directory not writable: " . dirname($logFilePath));
        error_log($logEntry); // Fallback to system logger
    }
}
?>
