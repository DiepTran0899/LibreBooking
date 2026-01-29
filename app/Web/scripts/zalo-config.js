/**
 * Zalo API Configuration
 * Configure your Zalo API endpoint and authentication here
 */
(function(window) {
    'use strict';

    window.ZaloConfig = {
        // Zalo API endpoint (via PHP proxy to bypass CORS)
        apiUrl: '/Web/zalo-proxy.php',
        
        // API Key for authentication
        apiKey: 'zalo-api-secret-key-2026',
        
        // Recipient configuration
        // Option 1: Send to user (uncomment and set UID)
        recipientUID: '1896033675901362911,4376277746618281780', // e.g., '123456789'
        
        // Option 2: Send to group (uncomment and set Group ID)
        recipientGroupID: '3433735635368484904', // e.g., '8544007930595627863'
        
        // Message templates
        messages: {
            checkIn: '✅ Khách vào - ',
            checkOut: '🚪 Khách ra - '
        }
    };

    // Validate configuration on load
    if (typeof console !== 'undefined') {
        if (!window.ZaloConfig.recipientUID && !window.ZaloConfig.recipientGroupID) {
            console.warn('[Zalo Config] Warning: No recipient configured. Please set recipientUID or recipientGroupID in zalo-config.js');
        }
    }

})(window);
