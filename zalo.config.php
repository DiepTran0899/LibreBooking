<?php

// Zalo configuration file
// This file is ignored by git (see **/*.config.php in .gitignore)
// and is intended to store sensitive Zalo settings such as API key.

return [
    // URL of your Zalo API server (Node.js service)
    // Example: 'http://localhost:3000/v1/messages/send-proxy'
    'apiUrl' => '',

    // API key for authenticating from browser to Zalo API server
    'apiKey' => '',

    // Global default recipients (used when a resource does not have its own mapping)
    'recipientUID' => '',
    'recipientGroupID' => '',

    // Per-resource recipient configuration
    // Key is ResourceId (string), value is an array:
    // [
    //     'recipientUID' => 'uid1,uid2',
    //     'recipientGroupID' => 'gid1,gid2'
    // ]
    'perResourceRecipients' => [],
];

