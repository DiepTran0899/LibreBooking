# Reservation Camera Module

Module JavaScript độc lập để xử lý chức năng chụp ảnh từ camera và upload ảnh cho LibreBooking.

## Tính năng

- ✅ Chụp ảnh từ camera (sử dụng HTML5 Camera API)
- ✅ Upload ảnh từ file system
- ✅ Preview ảnh trước khi lưu
- ✅ Tên file theo timestamp (YYYYMMDD_HHMMSS.jpg)
- ✅ Xóa ảnh trước khi submit
- ✅ Tự động thêm vào form khi submit
- ✅ Sử dụng data attributes - dễ dàng tích hợp nhiều nút

## Cách sử dụng

### 1. Include module trong template

```smarty
{block name=header}
    {include file='globalheader.tpl' ...}
    <script src="{$Path}scripts/reservation-camera.js?v=1.0"></script>
{/block}
```

### 2. Tạo nút chụp ảnh/upload

Sử dụng `data-action` attribute để kích hoạt:

```html
<!-- Nút chụp ảnh - có thể đặt ở bất cứ đâu -->
<button type="button" data-action="capture-photo">
    <i class="bi bi-camera-fill"></i> Chụp ảnh
</button>

<!-- Nút upload ảnh - có thể đặt ở bất cứ đâu -->
<button type="button" data-action="upload-photo">
    <i class="bi bi-upload"></i> Tải ảnh
</button>

<!-- File input (hidden) -->
<input type="file" id="photoFileInput" accept="image/*" style="display:none;" multiple />
```

### 3. Tạo Camera Modal

```html
<div class="modal fade" id="cameraModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chụp ảnh từ Camera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <video id="cameraVideo" autoplay playsinline></video>
                <canvas id="cameraCanvas" style="display:none;"></canvas>
                <div id="capturedImageContainer" style="display:none;">
                    <img id="capturedImage" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnRetakePhoto">Chụp lại</button>
                <button type="button" class="btn btn-primary" id="btnTakePhoto">Chụp</button>
                <button type="button" class="btn btn-success" id="btnSaveCapturedPhoto">Lưu ảnh</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
```

### 4. Tạo Preview Container

```html
<div id="newImagesPreview" style="display:none;">
    <h6>Ảnh mới chụp/tải lên</h6>
    <div id="newImagesGrid" class="row g-2"></div>
</div>
```

## API

Module expose object `window.ReservationCamera` với các methods:

### Methods

#### `init()`
Khởi tạo module và setup event listeners.

#### `openCameraModal()`
Mở modal camera.

#### `initCamera()`
Khởi động camera stream.

#### `stopCamera()`
Dừng camera stream.

#### `capturePhoto()`
Chụp ảnh từ camera.

#### `saveCapturedPhoto()`
Lưu ảnh đã chụp vào preview.

#### `addImageToPreview(imageDataUrl, fileName)`
Thêm ảnh vào preview grid.

#### `handleFileUpload(files)`
Xử lý upload file từ input.

#### `addCapturedImagesToForm()`
Thêm tất cả captured images vào form dưới dạng hidden inputs.

### Properties

#### `capturedImages`
Array chứa các ảnh đã chụp/upload:
```javascript
[
    { dataUrl: 'data:image/jpeg;base64,...', fileName: '20260124_130245.jpg' },
    { dataUrl: 'data:image/jpeg;base64,...', fileName: '20260124_130312.jpg' }
]
```

## Events

Module tự động hook vào các events:

- `click` trên `[data-action="capture-photo"]` → Mở camera modal
- `click` trên `[data-action="upload-photo"]` → Mở file picker
- `click` trên `.btnEdit.update, .save.update` → Thêm images vào form
- `click` trên `.remove-new-image` → Xóa ảnh từ preview
- `shown.bs.modal` trên `#cameraModal` → Khởi động camera
- `hidden.bs.modal` trên `#cameraModal` → Dừng camera

## Format tên file

Tên file được tạo tự động theo format:
```
YYYYMMDD_HHMMSS.jpg
```

Ví dụ: `20260124_130245.jpg` = 24/01/2026 lúc 13:02:45

## Form Data

Khi submit form, module tự động thêm hidden inputs:

```html
<input type="hidden" name="captured_images[0][data]" value="data:image/jpeg;base64,..." />
<input type="hidden" name="captured_images[0][filename]" value="20260124_130245.jpg" />
<input type="hidden" name="captured_images[1][data]" value="data:image/jpeg;base64,..." />
<input type="hidden" name="captured_images[1][filename]" value="20260124_130312.jpg" />
```

## Backend Processing

Server-side xử lý trong `ReservationSavePage.php`:

```php
$capturedImages = $this->server->GetRawForm('captured_images');
if (!empty($capturedImages) && is_array($capturedImages)) {
    foreach ($capturedImages as $imageData) {
        $base64Data = explode(',', $imageData['data'])[1];
        $imageContent = base64_decode($base64Data);
        $fileName = $imageData['filename'];
        
        $uploadedFile = new CapturedImageFile(
            $fileName, 
            'image/jpeg', 
            strlen($imageContent), 
            $imageContent, 
            'jpg'
        );
        $attachments[] = $uploadedFile;
    }
}
```

## Styling

Module sử dụng Bootstrap 5 classes:
- `btn`, `btn-sm`, `btn-primary`, `btn-success`, `btn-secondary`
- `modal`, `modal-dialog`, `modal-content`
- `card`, `card-img-top`, `card-body`
- `row`, `g-2`, `col-md-4`, `col-sm-6`, `col-12`

## Dependencies

- jQuery (cho event delegation và DOM manipulation)
- Bootstrap 5 (cho modal và styling)
- HTML5 Camera API (getUserMedia)
- Canvas API (để capture ảnh)
- FileReader API (để đọc uploaded files)

## Browser Support

- Chrome/Edge: ✅ Full support
- Firefox: ✅ Full support
- Safari: ✅ Requires HTTPS
- Mobile browsers: ✅ Requires camera permission

## Ví dụ tích hợp nhiều nút

Bạn có thể tạo nhiều nút ở nhiều vị trí khác nhau, tất cả đều sử dụng chung module:

```html
<!-- Nút trong header -->
<button data-action="capture-photo" class="btn btn-success">
    <i class="bi bi-camera"></i> Chụp
</button>

<!-- Nút trong form -->
<button data-action="capture-photo" class="btn btn-link">
    <i class="bi bi-camera"></i> Thêm ảnh
</button>

<!-- Nút trong dropdown -->
<a href="#" data-action="capture-photo" class="dropdown-item">
    <i class="bi bi-camera"></i> Chụp ảnh
</a>
```

Tất cả đều hoạt động giống nhau!

## Troubleshooting

### Camera không hoạt động
- Kiểm tra HTTPS (camera requires secure context)
- Kiểm tra camera permissions trong browser
- Xem console logs

### Ảnh không được submit
- Kiểm tra console log "Adding captured images to form"
- Verify form có id `form-reservation`
- Verify nút submit có class `btnEdit.update` hoặc `save.update`

### Module không load
- Kiểm tra đường dẫn script `{$Path}scripts/reservation-camera.js`
- Kiểm tra console errors
- Verify jQuery đã load trước module

## License

Part of LibreBooking - GPLv3
