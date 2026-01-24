# LibreBooking with Camera Capture Feature

This is a customized version of LibreBooking with enhanced reservation management features.

## New Features

### 📸 Camera Capture & File Attachment
- **Capture photos** directly from device camera during reservation editing
- **Upload multiple files** (images, documents, PDFs, etc.)
- **File type validation** based on configuration
- **Real-time preview** for images and file icons for documents
- **Vietnamese & English translations** fully supported

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
- `app/Web/scripts/reservation-camera.js` - Main JavaScript module
- `app/tpl/Reservation/edit.tpl` - Reservation edit template
- `app/Pages/Reservation/ReservationPage.php` - Page controller
- `app/Domain/ReservationAttachmentView.php` - Domain model
- `app/lib/Server/CapturedImageFile.php` - Image file handler
- `app/lang/vn_vn.php` - Vietnamese translations
- `app/lang/en_us.php` - English translations

## Configuration

File attachment extensions can be configured in `config/config.php`:
```php
'reservation.attachment.extensions' => 'txt,jpg,gif,png,doc,docx,pdf,xls,xlsx,ppt,pptx,csv',
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

## License
Same as LibreBooking (GPL)

## Credits
Based on LibreBooking - https://github.com/LibreBooking/app
Camera feature developed January 2026
