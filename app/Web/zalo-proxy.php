<?php
/**
 * Zalo API Proxy
 * Forwards requests from browser to Zalo API server (bypasses HTTPS → HTTP mixed content restriction)
 */

// Security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// CORS headers (if needed for same-origin)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-API-Key');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Validate API Key from request header
$requestApiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';
$validApiKey = 'zalo-api-secret-key-2026'; // Should match zalo-config.js

if ($requestApiKey !== $validApiKey) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Invalid API key']);
    exit;
}

// Zalo API configuration
$zaloApiUrl = 'https://ntzl.kimthanh.co/v1/messages/send';

// Prepare data to forward
$postData = [];
$files = [];

// Get POST parameters
if (isset($_POST['text'])) {
    $postData['text'] = $_POST['text'];
}
if (isset($_POST['toUID'])) {
    $postData['toUID'] = $_POST['toUID'];
}
if (isset($_POST['toGROUPID'])) {
    $postData['toGROUPID'] = $_POST['toGROUPID'];
}

// Get uploaded file
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $files['file'] = new CURLFile(
        $_FILES['file']['tmp_name'],
        $_FILES['file']['type'],
        $_FILES['file']['name']
    );
}

// Merge files into postData
$postData = array_merge($postData, $files);

// Initialize cURL
$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $zaloApiUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => [
        'X-API-Key: ' . $validApiKey
    ],
    // SSL verification (set to false for self-signed certs in dev)
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
]);

// Execute request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);

curl_close($ch);

// Handle cURL errors
if ($response === false) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to connect to Zalo API: ' . $curlError
    ]);
    exit;
}

// Forward response from Zalo API
http_response_code($httpCode);

// Try to decode as JSON, if fails return raw response
$jsonResponse = json_decode($response, true);
if (json_last_error() === JSON_ERROR_NONE) {
    echo json_encode($jsonResponse);
} else {
    // If Zalo API returns non-JSON, wrap it
    echo json_encode([
        'success' => $httpCode >= 200 && $httpCode < 300,
        'httpCode' => $httpCode,
        'response' => $response
    ]);
}
