<?php
// Test Zalo API connection from server
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== Testing Zalo API Connection ===\n\n";

$zaloApiUrl = 'http://192.168.51.81:3000/v1/messages/send';
$apiKey = 'zalo-api-secret-key-2026';

echo "Target URL: $zaloApiUrl\n";
echo "API Key: $apiKey\n\n";

// Check if cURL is enabled
if (!function_exists('curl_init')) {
    die("ERROR: cURL is not enabled in PHP\n");
}
echo "✓ cURL is enabled\n\n";

// Test simple request
$postData = [
    'text' => 'Test message from PHP',
    'toGROUPID' => '3433735635368484904'
];

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $zaloApiUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_HTTPHEADER => [
        'X-API-Key: ' . $apiKey
    ],
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_VERBOSE => true
]);

echo "Sending request...\n";
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
$curlErrno = curl_errno($ch);

echo "\n=== RESULTS ===\n";
echo "HTTP Code: $httpCode\n";
echo "cURL Error No: $curlErrno\n";
echo "cURL Error: $curlError\n";
echo "Response: $response\n";

curl_close($ch);
