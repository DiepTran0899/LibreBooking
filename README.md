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
- **Admin configuration page** (Cấu hình Zalo): URL API, API Key, UID/GroupID mặc định, **cấu hình per-resource theo ResourceId** (JSON)
- **Server-side proxy** (cùng origin) để tránh CORS; API key Zalo **không** gửi ra client; bảo vệ proxy bằng token
- **Toast notifications** cho phản hồi người dùng

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

## Camera & Zalo Feature Files
- `app/Web/scripts/reservation-camera.js` - Camera module + gửi Zalo (đọc config từ `window.ZaloConfig`)
- `app/Web/scripts/zalo-config.js` - Load cấu hình từ `/Web/zalo-settings.php` → `window.ZaloConfig`
- `app/Web/zalo-settings.php` - Trả JSON cấu hình cho frontend (không trả apiKey/apiUrl)
- `app/Web/zalo-proxy.php` - Proxy cùng origin: nhận POST từ trình duyệt, forward tới Zalo API server (dùng apiKey từ config)
- `app/config/zalo.config.php` - Cấu hình Zalo (apiUrl, apiKey, perResourceRecipients, proxyAuthToken) — **không commit**
- `app/Pages/Admin/ManageZaloPage.php` - Trang admin Cấu hình Zalo
- `app/Web/admin/manage_zalo.php` - Entry point trang Cấu hình Zalo
- `app/tpl/Admin/Zalo/manage_zalo.tpl` - Form cấu hình Zalo
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
Cấu hình Zalo qua **trang Admin** (Cấu hình → Cấu hình Zalo), không chỉnh trực tiếp file JS:

- **URL API Zalo**: URL đầy đủ của Zalo API server (Node.js), ví dụ `https://ntzl.kimthanh.co/v1/messages/send`
- **API Key**: Key xác thực với Zalo API server (chỉ lưu trên server, không gửi ra trình duyệt)
- **UID / GROUPID mặc định**: Người nhận khi resource không có cấu hình riêng
- **Cấu hình theo ResourceId (JSON)**: Object `{ "resourceId": { "recipientUID": "...", "recipientGroupID": "..." } }`

Trình duyệt luôn gọi proxy cùng origin (`/Web/zalo-proxy.php`); proxy dùng apiKey từ config để gọi Zalo API. Chi tiết: **[README_ZALO_INTEGRATION.md](README_ZALO_INTEGRATION.md)**.

## Documentation
- **[README_ZALO_INTEGRATION.md](README_ZALO_INTEGRATION.md)** - Tích hợp Zalo trong app (cấu hình admin, proxy, bảo mật, per-resource)
- **[README_ZALO_API.md](README_ZALO_API.md)** - Zalo API server (Node.js): endpoint, đăng nhập, gửi tin nhắn
- `.github/copilot-instructions.md` - AI coding agent guide
- `CAMERA_MODULE_README.md` - Camera module API documentation

## Installation
See original LibreBooking documentation for base installation.

For camera feature:
1. Ensure HTTPS is enabled (required for camera API)
2. Configure allowed file extensions in config
3. Set upload path permissions

For Zalo integration:
1. Set up Zalo API server (Node.js); see `README_ZALO_API.md`
2. In Admin → Cấu hình Zalo: set URL API, API Key, (optional) default UID/GroupID and per-resource JSON
3. Save configuration (creates/updates `config/zalo.config.php` and proxy token)
4. Test: open a reservation with a configured resource, capture photo, send Check-in/Check-out

## Recent Updates (January 2026)

### Zalo integration (admin config + proxy + security)
- ✅ Admin page **Cấu hình Zalo**: URL API, API Key, UID/GroupID mặc định, **per-resource (ResourceId)** JSON
- ✅ Config stored in `config/zalo.config.php` (not committed); API key never sent to browser
- ✅ Proxy (`zalo-proxy.php`) reads config and forwards to Zalo API; protected by **proxy token** (header or POST `proxy_token`)
- ✅ Frontend loads config from `zalo-settings.php` (no apiKey/apiUrl in response); sends requests to same-origin proxy
- ✅ Per-resource recipients: each ResourceId can have its own `recipientUID` / `recipientGroupID`
- ✅ Zalo check-in/check-out photo messaging, three-button workflow, toast notifications, WebP compression
- 📄 **README_ZALO_INTEGRATION.md** – full doc for in-app Zalo integration

## License
Same as LibreBooking (GPL)

## Credits
Based on LibreBooking - https://github.com/LibreBooking/app
Camera feature developed January 2026
