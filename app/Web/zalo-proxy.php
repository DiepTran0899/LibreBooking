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

// Load Zalo config (backend URL + API key)
$configPath = dirname(__DIR__) . '/config/zalo.config.php';
$zaloApiUrl = '';
$validApiKey = '';

$proxyAuthToken = '';
if (file_exists($configPath)) {
    $loaded = include $configPath;
    if (is_array($loaded)) {
        $zaloApiUrl = isset($loaded['apiUrl']) ? trim($loaded['apiUrl']) : '';
        $validApiKey = isset($loaded['apiKey']) ? trim($loaded['apiKey']) : '';
        $proxyAuthToken = isset($loaded['proxyAuthToken']) ? trim($loaded['proxyAuthToken']) : '';
    }
}

if (empty($zaloApiUrl) || empty($validApiKey)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Zalo proxy: chưa cấu hình apiUrl/apiKey trong Cấu hình Zalo']);
    exit;
}

// Bảo mật: API key Zalo không gửi ra client. Proxy dùng $validApiKey khi gọi Zalo API.
// Chấp nhận token từ header X-Proxy-Token hoặc POST proxy_token (một số server chặn header tùy chỉnh).
if ($proxyAuthToken !== '') {
    $requestToken = trim((string) ($_SERVER['HTTP_X_PROXY_TOKEN'] ?? $_POST['proxy_token'] ?? ''));
    if ($requestToken !== $proxyAuthToken) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Invalid proxy token']);
        exit;
    }
}

// Prepare data to forward
$postData = [];
$files = [];

// Get POST parameters (không forward proxy_token sang Zalo API)
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
