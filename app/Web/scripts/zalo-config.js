/**
 * Zalo API Configuration
 * Configure your Zalo API endpoint and authentication here
 */
(function(window) {
    'use strict';

    // Default (empty) config. Giá trị thực sẽ được load từ server (zalo-settings.php)
    window.ZaloConfig = {
        apiUrl: '',
        apiKey: '',
        recipientUID: '',
        recipientGroupID: '',
        perResourceRecipients: {},
        // Message templates
        messages: {
            checkIn: '✅ Khách vào - ',
            checkOut: '🚪 Khách ra - '
        }
    };

    // Load cấu hình thực từ server (an toàn hơn so với hard-code trong JS)
    try {
        fetch('/Web/zalo-settings.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            cache: 'no-cache'
        })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('HTTP ' + response.status);
            }
            return response.json();
        })
        .then(function(serverConfig) {
            if (!serverConfig || typeof serverConfig !== 'object') {
                return;
            }

            // Trình duyệt luôn gọi browserApiUrl (proxy cùng origin) để tránh CORS
            window.ZaloConfig.apiUrl = serverConfig.browserApiUrl || serverConfig.apiUrl || '';
            window.ZaloConfig.apiKey = serverConfig.apiKey || '';
            window.ZaloConfig.recipientUID = serverConfig.recipientUID || '';
            window.ZaloConfig.recipientGroupID = serverConfig.recipientGroupID || '';
            window.ZaloConfig.perResourceRecipients = serverConfig.perResourceRecipients || {};
            window.ZaloConfig.proxyAuthToken = serverConfig.proxyAuthToken || '';

            if (typeof console !== 'undefined') {
                console.info('[Zalo Config] Loaded configuration from server.');
            }
        })
        .catch(function(err) {
            if (typeof console !== 'undefined') {
                console.warn('[Zalo Config] Không thể load cấu hình từ server:', err);
            }
        });
    } catch (e) {
        if (typeof console !== 'undefined') {
            console.warn('[Zalo Config] Lỗi khởi tạo cấu hình Zalo:', e);
        }
    }

})(window);
