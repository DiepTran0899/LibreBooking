<?php

define('ROOT_DIR', '../');

header('Content-Type: application/json; charset=utf-8');

$configPath = ROOT_DIR . 'config/zalo.config.php';

$defaults = [
    'apiUrl' => '',
    'apiKey' => '',
    'recipientUID' => '',
    'recipientGroupID' => '',
    'perResourceRecipients' => [],
    'proxyAuthToken' => '',
];

$config = $defaults;

if (file_exists($configPath)) {
    $loaded = include $configPath;
    if (is_array($loaded)) {
        $config = array_merge($defaults, $loaded);
    }
}

// URL mà trình duyệt gọi (cùng origin → tránh CORS). Proxy sẽ forward tới apiUrl thật.
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? '';
$base = dirname($_SERVER['SCRIPT_NAME'] ?? '/Web');
$config['browserApiUrl'] = rtrim($scheme . '://' . $host . $base, '/') . '/zalo-proxy.php';

// Bảo mật: Không trả apiKey ra client. Proxy dùng apiKey từ config khi gửi tới Zalo API.
unset($config['apiKey']);
// apiUrl chỉ cần ở server (proxy); client không cần biết URL backend thật.
unset($config['apiUrl']);
// proxyAuthToken: client gửi header X-Proxy-Token để proxy xác thực; token này khác với API key Zalo.

echo json_encode($config, JSON_UNESCAPED_UNICODE);

