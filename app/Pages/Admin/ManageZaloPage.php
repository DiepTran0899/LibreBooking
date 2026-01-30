<?php

require_once(ROOT_DIR . 'Pages/Admin/AdminPage.php');

class ManageZaloPage extends ActionPage
{
    private const CONFIG_FILE = 'config/zalo.config.php';

    public function __construct()
    {
        // Use ZaloConfiguration translation key for page title
        parent::__construct('ZaloConfiguration', 1);
    }

    public function ProcessAction()
    {
        $action = $this->GetAction();

        if ($action === 'save') {
            $apiUrl = trim($this->GetForm('api_url'));
            $apiKey = trim($this->GetForm('api_key'));
            $recipientUID = trim($this->GetForm('recipient_uid'));
            $recipientGroupID = trim($this->GetForm('recipient_group_id'));
            $perResourceJson = trim($this->GetForm('per_resource_json'));

            $perResourceRecipients = [];

            if ($perResourceJson !== '') {
                // Thử decode trực tiếp
                $decoded = json_decode($perResourceJson, true);

                // Nếu lỗi, thử decode sau khi bỏ encode HTML (trường hợp trình duyệt gửi &quot; ...)
                if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
                    $htmlDecoded = html_entity_decode($perResourceJson, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $decoded = json_decode($htmlDecoded, true);
                }

                if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
                    $this->Set('ErrorMessage', 'Cấu hình per-resource (JSON) không hợp lệ: ' . json_last_error_msg());
                    // Redisplay with posted values
                    $this->Set('ZaloConfig', [
                        'apiUrl' => $apiUrl,
                        'apiKey' => $apiKey,
                        'recipientUID' => $recipientUID,
                        'recipientGroupID' => $recipientGroupID,
                        'perResourceRecipients' => [],
                        'perResourceJson' => $perResourceJson,
                    ]);
                    $this->Display('Admin/Zalo/manage_zalo.tpl');
                    return;
                }

                if (!is_array($decoded)) {
                    $this->Set('ErrorMessage', 'Cấu hình per-resource (JSON) phải là một object (ví dụ: {"5": {...}}).');
                    $this->Set('ZaloConfig', [
                        'apiUrl' => $apiUrl,
                        'apiKey' => $apiKey,
                        'recipientUID' => $recipientUID,
                        'recipientGroupID' => $recipientGroupID,
                        'perResourceRecipients' => [],
                        'perResourceJson' => $perResourceJson,
                    ]);
                    $this->Display('Admin/Zalo/manage_zalo.tpl');
                    return;
                }

                $perResourceRecipients = $decoded;
            }

            $configToSave = [
                'apiUrl' => $apiUrl,
                'apiKey' => $apiKey,
                'recipientUID' => $recipientUID,
                'recipientGroupID' => $recipientGroupID,
                'perResourceRecipients' => $perResourceRecipients,
            ];
            $existing = $this->LoadConfig();
            if (empty($existing['proxyAuthToken'])) {
                $configToSave['proxyAuthToken'] = bin2hex(random_bytes(16));
            } else {
                $configToSave['proxyAuthToken'] = $existing['proxyAuthToken'];
            }
            $this->SaveConfig($configToSave);

            $this->Set('SuccessMessage', Resources::GetInstance()->GetString('ConfigurationSavedSuccessfully'));
        }

        // After handling action, load latest config and display page
        $this->ProcessPageLoad();
    }

    public function ProcessDataRequest($dataRequest)
    {
        // no-op
    }

    public function ProcessPageLoad()
    {
        $config = $this->LoadConfig();

        // Provide JSON string for textarea editor
        $config['perResourceJson'] = json_encode(
            $config['perResourceRecipients'],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

        $this->Set('ZaloConfig', $config);
        $this->Display('Admin/Zalo/manage_zalo.tpl');
    }

    private function LoadConfig(): array
    {
        $path = ROOT_DIR . self::CONFIG_FILE;

        if (file_exists($path)) {
            $loaded = include $path;
            if (is_array($loaded)) {
                // Merge with defaults to ensure all keys exist
                $defaults = [
                    'apiUrl' => '',
                    'apiKey' => '',
                    'recipientUID' => '',
                    'recipientGroupID' => '',
                    'perResourceRecipients' => [],
                    'proxyAuthToken' => '',
                ];

                return array_merge($defaults, $loaded);
            }
        }

        return [
            'apiUrl' => '',
            'apiKey' => '',
            'recipientUID' => '',
            'recipientGroupID' => '',
            'perResourceRecipients' => [],
            'proxyAuthToken' => '',
        ];
    }

    private function SaveConfig(array $config): void
    {
        $path = ROOT_DIR . self::CONFIG_FILE;

        // Ensure directory exists
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        $export = var_export($config, true);
        $php = "<?php\n\n// Auto-generated Zalo configuration. Do not edit manually.\n\nreturn {$export};\n";

        file_put_contents($path, $php);
    }
}

