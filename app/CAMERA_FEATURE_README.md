# Camera Capture Feature - Installation & Usage Guide

## Tính năng mới

Đã thêm tính năng chụp ảnh từ camera và ghi chú cho hình ảnh trong giao diện chỉnh sửa Reservation.

### Các tính năng chính:

1. **Chụp ảnh từ camera thiết bị**
   - Truy cập camera trực tiếp từ trình duyệt
   - Xem trước và chụp lại nếu cần
   - Thêm ghi chú cho mỗi ảnh

2. **Tải ảnh từ thiết bị**
   - Hỗ trợ tải nhiều ảnh cùng lúc
   - Thêm ghi chú cho từng ảnh

3. **Hiển thị ảnh dạng lưới (Grid)**
   - Xem thumbnail của tất cả ảnh
   - Chỉnh sửa ghi chú trực tiếp
   - Tải về hoặc xóa ảnh

4. **Quản lý ghi chú**
   - Mỗi ảnh có ô textarea riêng để ghi chú
   - Ghi chú được lưu vào database
   - Hiển thị ghi chú khi xem reservation

## Cài đặt

### Bước 1: Chạy Database Migration

```bash
# Kết nối MySQL
mysql -u your_username -p your_database_name

# Chạy migration script
mysql -u your_username -p your_database_name < database_schema/upgrades/4.1/schema.sql
```

Hoặc thực thi SQL trực tiếp:

```sql
ALTER TABLE `reservation_files` ADD COLUMN `note` TEXT DEFAULT NULL AFTER `file_extension`;
```

### Bước 2: Kiểm tra cấu hình

Đảm bảo trong file `config/config.php` hoặc `config/config.dist.php` có:

```php
'upload' => [
    'enable_reservation_attachments' => true,
],
```

### Bước 3: Xóa cache template (nếu có)

```bash
# Xóa thư mục cache
rm -rf tpl_c/*
```

Hoặc trên Windows:

```powershell
Remove-Item -Path tpl_c\* -Recurse -Force
```

## Sử dụng

### Trong giao diện Edit Reservation:

1. **Chụp ảnh mới:**
   - Click nút "Chụp ảnh từ Camera"
   - Cho phép truy cập camera khi trình duyệt yêu cầu
   - Click "Chụp" để chụp ảnh
   - Nhập ghi chú (tùy chọn)
   - Click "Lưu ảnh"

2. **Tải ảnh từ thiết bị:**
   - Click nút "Tải lên ảnh"
   - Chọn một hoặc nhiều file ảnh
   - Nhập ghi chú cho từng ảnh

3. **Quản lý ảnh đã có:**
   - Xem ảnh trong grid layout
   - Click vào ô textarea để thêm/sửa ghi chú
   - Click "Tải về" để download ảnh
   - Click "Xóa" để xóa ảnh

4. **Lưu thay đổi:**
   - Click nút "Update" để lưu tất cả thay đổi
   - Ảnh mới và ghi chú sẽ được lưu vào database

## Cấu trúc File đã thay đổi

### Frontend (Templates):
- `tpl/Reservation/edit.tpl` - Thêm UI camera và grid hiển thị ảnh

### Backend (PHP):

#### Domain Layer:
- `Domain/ReservationAttachment.php` - Thêm property `note`
- `Domain/ReservationAttachmentView.php` - Thêm property `note`
- `Domain/ExistingReservationSeries.php` - Thêm method `UpdateAttachmentNotes()`
- `Domain/Events/ReservationEvents.php` - Thêm `AttachmentNoteUpdatedEvent`

#### Database Layer:
- `database_schema/upgrades/4.1/schema.sql` - Migration script
- `lib/Database/Commands/Queries.php` - Thêm query UPDATE_RESERVATION_ATTACHMENT_NOTE
- `lib/Database/Commands/Commands.php` - Thêm `UpdateReservationAttachmentNoteCommand`
- `lib/Database/Commands/ParameterNames.php` - Thêm `FILE_NOTE`
- `lib/Database/Commands/ColumnNames.php` - Thêm `FILE_NOTE`

#### Repository Layer:
- `Domain/Access/ReservationRepository.php` - Cập nhật save/load attachments với note
- `Domain/Access/ReservationViewRepository.php` - Load attachments với note

#### Application Layer:
- `Pages/Ajax/ReservationSavePage.php` - Xử lý captured images và attachment notes
- `Presenters/Reservation/ReservationSavePresenter.php` - Xử lý note cho attachments
- `Presenters/Reservation/ReservationUpdatePresenter.php` - Cập nhật note cho existing attachments
- `lib/Server/CapturedImageFile.php` - Class mới để xử lý ảnh từ camera

## Yêu cầu kỹ thuật

### Browser:
- Chrome/Edge 60+
- Firefox 55+
- Safari 11+
- Opera 47+

### Server:
- PHP >= 8.2
- MySQL >= 5.5
- HTTPS (bắt buộc cho camera API) hoặc localhost

### Quyền truy cập:
- Camera permission trong trình duyệt
- Write permission cho thư mục `uploads/reservation_attachments/`

## Troubleshooting

### Camera không hoạt động:
1. Kiểm tra HTTPS (camera API chỉ hoạt động trên HTTPS hoặc localhost)
2. Kiểm tra quyền camera trong browser settings
3. Thử trình duyệt khác

### Ảnh không lưu được:
1. Kiểm tra permission thư mục uploads
2. Kiểm tra `upload_max_filesize` và `post_max_size` trong php.ini
3. Kiểm tra database migration đã chạy chưa

### Ghi chú không hiển thị:
1. Xóa cache template: `rm -rf tpl_c/*`
2. Kiểm tra column `note` đã được thêm vào table `reservation_files`

## Testing

Để test tính năng:

```bash
# Run PHPUnit tests
./vendor/bin/phpunit tests/

# Test specific file
./vendor/bin/phpunit tests/Domain/ReservationAttachmentTest.php
```

## Security Notes

- Ảnh từ camera được validate về type và size
- Chỉ chấp nhận image/jpeg, image/png, image/gif
- Maximum file size theo config `upload_max_filesize`
- Tất cả input được sanitize trước khi lưu database
- Files được lưu với tên unique (file_id.extension)

## Support

Nếu gặp vấn đề, vui lòng:
1. Kiểm tra browser console để xem lỗi JavaScript
2. Kiểm tra PHP error log
3. Kiểm tra database schema đã cập nhật đúng
4. Xóa cache template và thử lại

## License

GPL-3.0 (giống LibreBooking project)
