# LibreBooking with Camera Capture Feature

This is a customized version of LibreBooking with enhanced reservation management features.

## New Features

### 📸 Camera Capture & File Attachment
- **Capture photos** directly from device camera during reservation editing
- **Upload multiple files** (images, documents, PDFs, etc.)
- **WebP image compression** for optimal storage (85% quality)
- **File type validation** based on configuration
- **Real-time preview** for images and file icons for documents
- **Vietnamese & English translations** fully supported

### 💬 Zalo Messaging Integration
- **Send check-in/check-out photos** directly to Zalo from camera modal
- **Real-time notifications** with reservation details (title, resource, owner)
- **Three-button workflow**: Check-in, Check-out, Save Only
- **Server-side proxy** to handle HTTPS→HTTP API calls and bypass CORS
- **Toast notifications** for user feedback
- **Configurable recipients** (UIDs and Group IDs)

### Key Enhancements
- Modular JavaScript architecture (`reservation-camera.js`)
- Bootstrap 5 UI with responsive design
- Support for multiple file formats (jpg, png, pdf, doc, docx, xls, xlsx, ppt, pptx, csv, txt)
- Timestamp-based filename format (YYYYMMDD_HHMMSS.jpg)
- Data attributes for flexible button placement

## Technical Stack
- **Backend**: PHP 8.2+, MySQL
- **Frontend**: Bootstrap 5, HTML5 Camera API, Canvas API, FileReader API
- **Template Engine**: Smarty 5.5
- **Architecture**: MVP Pattern (Model-View-Presenter)

## Camera Feature Files
- `app/Web/scripts/reservation-camera.js` - Main JavaScript module with Zalo integration
- `app/Web/scripts/zalo-config.js` - Zalo API configuration
- `app/Web/zalo-proxy.php` - Server-side proxy for Zalo API calls
- `app/tpl/Reservation/edit.tpl` - Reservation edit template
- `app/Pages/Reservation/ReservationPage.php` - Page controller
- `app/Domain/ReservationAttachmentView.php` - Domain model
- `app/lib/Server/CapturedImageFile.php` - Image file handler
- `app/lang/vn_vn.php` - Vietnamese translations
- `app/lang/en_us.php` - English translations

## Configuration

### File Attachments
File attachment extensions can be configured in `config/config.php`:
```php
'reservation.attachment.extensions' => 'txt,jpg,gif,png,doc,docx,pdf,xls,xlsx,ppt,pptx,csv',
```

### Zalo Integration
Configure Zalo messaging in `app/Web/scripts/zalo-config.js`:
```javascript
window.ZaloConfig = {
    apiUrl: '/Web/zalo-proxy.php',  // Uses server-side proxy
    apiKey: 'your-api-key-here',
    recipientUID: 'uid1,uid2',      // Comma-separated user IDs
    recipientGroupID: 'groupid',    // Group ID for group messages
    messages: {
        checkIn: '✅ Khách vào - ',
        checkOut: '🚪 Khách ra - '
    }
};
```

Update proxy endpoint in `app/Web/zalo-proxy.php`:
```php
$zaloApiUrl = 'https://your-zalo-api-server.com/v1/messages/send';
$validApiKey = 'your-api-key-here';
```

## Documentation
- `.github/copilot-instructions.md` - AI coding agent guide
- `CAMERA_MODULE_README.md` - Camera module API documentation

## Installation
See original LibreBooking documentation for base installation.

For camera feature:
1. Ensure HTTPS is enabled (required for camera API)
2. Configure allowed file extensions in config
3. Set upload path permissions

For Zalo integration:
1. Set up Zalo API server (Node.js/Express recommended)
2. Configure API endpoint and credentials in `zalo-config.js`
3. Update proxy settings in `zalo-proxy.php`
4. Test connectivity: proxy can reach Zalo API server

## Recent Updates (January 2026)

### v20.0 - Zalo Messaging Integration
- ✅ Added Zalo check-in/check-out photo messaging
- ✅ Three-button workflow in camera modal
- ✅ Server-side proxy for HTTPS/CORS handling
- ✅ Bootstrap toast notifications
- ✅ Reservation details in messages (title, resource, owner)
- ✅ WebP image compression for storage optimization
- 🔧 Known issue: Zalo API adds blank lines between message lines (server-side behavior)

## License
Same as LibreBooking (GPL)

## Credits
Based on LibreBooking - https://github.com/LibreBooking/app
Camera feature developed January 2026
