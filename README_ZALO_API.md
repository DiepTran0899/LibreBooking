# Zalo Messaging API Server

API server Node.js chuyên nghiệp tích hợp thư viện `zca-js` để gửi tin nhắn Zalo (text, image, video, file) qua HTTP API. Server sử dụng cookie-based authentication để duy trì session ổn định, tránh phải login lại mỗi request.

## ✨ Tính năng

- 🔐 **Đăng nhập bằng Cookie**: Sử dụng session cookie để duy trì kết nối lâu dài
- 🚀 **API RESTful**: Fastify server với performance cao
- 📤 **Gửi nhiều loại tin nhắn**: Text, Image, Video, File
- 🔒 **Bảo mật**: API Key/JWT authentication, Rate limiting, CORS protection
- 📁 **Upload an toàn**: Validate MIME type, giới hạn dung lượng, chống path traversal
- 🪟 **Windows Compatible**: Hoạt động hoàn hảo trên Windows/PowerShell
- 🔄 **Singleton Pattern**: Zalo client được khởi tạo một lần duy nhất
- 📝 **Logging**: Request tracking với UUID

## 📋 Yêu cầu

- Node.js 18.x trở lên
- Windows 10/11 hoặc Windows Server
- Cookie Zalo hợp lệ (lấy từ browser)

## 🔧 Cài đặt

### 1. Clone hoặc tải project

```powershell
# Nếu có git
git clone <repository-url>
cd zalo-api-server

# Hoặc giải nén file zip vào thư mục
```

### 2. Cài đặt dependencies

```powershell
npm install
```

### 3. Cấu hình .env

```powershell
Copy-Item .env.example .env
```

Chỉnh sửa `.env` (đặc biệt là `API_KEY`):

```env
PORT=3000
HOST=0.0.0.0
AUTH_MODE=apikey
API_KEY=your-secret-api-key-change-me
MAX_UPLOAD_MB=50
RATE_LIMIT_GLOBAL=100
RATE_LIMIT_SEND=20
CORS_ORIGINS=http://localhost:3000,http://localhost:8080
LOG_LEVEL=info
```

### 4. Đăng nhập Zalo (chọn 1 trong 2 cách)

#### 🎯 CÁCH 1: Đăng nhập bằng QR Code (KHUYẾN KHÍCH - DỄ NHẤT)

**Lần đầu tiên hoặc khi cookie hết hạn:**

```powershell
.\login-qr.ps1
```

Script sẽ:
1. Tạo QR code (lưu vào `qr.png`)
2. Bạn quét QR bằng app Zalo trên điện thoại
3. Tự động lưu cookie và config
4. **Lần sau KHÔNG CẦN QR nữa!**

**Hoặc chạy server trực tiếp** (nếu chưa có cookie, server sẽ tự động hiện QR):

```powershell
npm start
# Server sẽ tự động tạo QR nếu chưa có cookie
# Quét QR, credentials sẽ được lưu tự động
```

#### 📋 CÁCH 2: Đăng nhập bằng Cookie thủ công (Nâng cao)

Xem hướng dẫn chi tiết trong [SETUP-INSTRUCTIONS.md](SETUP-INSTRUCTIONS.md)

### 4. Đăng nhập Zalo (chọn 1 trong 2 cách)

#### 🎯 CÁCH 1: Đăng nhập bằng QR Code (KHUYẾN KHÍCH - DỄ NHẤT)

**Lần đầu tiên hoặc khi cookie hết hạn:**

```powershell
.\login-qr.ps1
```

Script sẽ:
1. Tạo QR code (lưu vào `qr.png`)
2. Bạn quét QR bằng app Zalo trên điện thoại
3. Tự động lưu cookie và config
4. **Lần sau KHÔNG CẦN QR nữa!**

**Hoặc chạy server trực tiếp** (nếu chưa có cookie, server sẽ tự động hiện QR):

```powershell
npm start
# Server sẽ tự động tạo QR nếu chưa có cookie
# Quét QR, credentials sẽ được lưu tự động
```

#### 📋 CÁCH 2: Đăng nhập bằng Cookie thủ công (Nâng cao)

Xem hướng dẫn chi tiết trong [SETUP-INSTRUCTIONS.md](SETUP-INSTRUCTIONS.md)

### 5. Chạy Server

### 5. Chạy Server

```powershell
npm start
```

Server sẽ:
- Tự động kiểm tra cookie
- Nếu chưa có hoặc hết hạn → Hiển thị QR code để quét
- Nếu đã có cookie hợp lệ → Đăng nhập trực tiếp

Server sẽ chạy tại: `http://localhost:3000`

## 🔄 Quản lý Session

### Cookie Lifecycle

**Với QR Code Login:**
- ✅ Lần đầu: Quét QR → Credentials tự động lưu
- ✅ Lần sau: Server tự động dùng cookie đã lưu
- ✅ Cookie hết hạn: Server tự động chuyển sang QR mode
- ⏱️ Thời gian cookie: ~2-4 tuần

**Không cần làm gì thêm!** Server tự động xử lý mọi thứ.

### Khi nào cần quét QR lại?

1. Lần đầu tiên chạy server (chưa có cookie)
2. Cookie hết hạn (server sẽ báo và tự động hiện QR)
3. Đổi tài khoản Zalo khác

## 📡 API Endpoints

### 1. Health Check

**GET** `/healthz`

```powershell
curl.exe http://localhost:3000/healthz
```

**Response:**

```json
{
  "status": "ok",
  "timestamp": "2026-01-28T10:30:00.000Z",
  "zaloConnected": true
}
```

### 2. Get Current User Info

**GET** `/v1/messages/me`

```powershell
curl.exe http://localhost:3000/v1/messages/me -H "X-API-Key: your-secret-api-key-change-me"
```

**Response:**

```json
{
  "success": true,
  "data": {
    "uid": "1494219021607501875"
  }
}
```

### 3. Get Friends List

**GET** `/v1/messages/friends`

```powershell
curl.exe http://localhost:3000/v1/messages/friends -H "X-API-Key: your-secret-api-key-change-me"
```

**Response:**

```json
{
  "success": true,
  "data": {
    "friends": [
      {
        "no": 1,
        "uid": "1896033675901362911",
        "name": "Nguyễn Văn A"
      },
      {
        "no": 2,
        "uid": "7243740909306202633",
        "name": "Trần Thị B"
      }
    ],
    "total": 2
  }
}
```

**Lưu ý kỹ thuật:** User model trong zca-js có property `userId`, không phải `uid`. Code đã mapping `uid: f.userId` để consistency với API responses.

**Lưu ý UTF-8:** Nếu dùng PowerShell và thấy tiếng Việt bị lỗi, dùng `Invoke-RestMethod`:

```powershell
$headers = @{ "X-API-Key" = "your-secret-api-key-change-me" }
Invoke-RestMethod -Uri "http://localhost:3000/v1/messages/friends" -Headers $headers
```

### 4. Get Groups List

**GET** `/v1/messages/groups`

```powershell
curl.exe http://localhost:3000/v1/messages/groups -H "X-API-Key: your-secret-api-key-change-me"
```

**Response:**

```json
{
  "success": true,
  "data": {
    "groups": [
      {
        "no": 1,
        "gid": "7808676868721678802",
        "name": "3 anh em siêu nhân"
      },
      {
        "no": 2,
        "gid": "6620108605920717904",
        "name": "LAPTOP KIM THÀNH BẢO GIÁ THỞ"
      }
    ],
    "total": 2
  }
}
```

**Lưu ý kỹ thuật:** `api.getGroupInfo(gid)` trả về `{ gridInfoMap: { [gid]: GroupInfo } }`, không phải `GroupInfo` trực tiếp. Tên group nằm ở `groupInfo.gridInfoMap[gid].name`.

**Lưu ý UTF-8:** Tương tự friends endpoint, dùng `Invoke-RestMethod` cho tiếng Việt:

```powershell
$headers = @{ "X-API-Key" = "your-secret-api-key-change-me" }
Invoke-RestMethod -Uri "http://localhost:3000/v1/messages/groups" -Headers $headers
```

### 5. Logout

**POST** `/v1/auth/logout`

Logout và xóa credentials (cookie + config).

```powershell
curl.exe -X POST http://localhost:3000/v1/auth/logout -H "X-API-Key: your-secret-api-key-change-me"
```

**Response:**

```json
{
  "success": true,
  "message": "Logged out successfully. Credentials deleted.",
  "data": {
    "nextStep": "Restart server or call GET /v1/auth/qr to get QR code for re-login"
  }
}
```

**Workflow sau khi logout:**

**Cách 1: Restart server (Đơn giản nhất)**
```powershell
# Tắt server (Ctrl+C), sau đó:
npm start
# Server sẽ tự động tạo QR vì chưa có credentials
```

**Cách 2: Dùng QR API (Không cần restart)**

**Lưu ý quan trọng:** Sau khi logout, server vẫn chạy nhưng chưa kết nối Zalo. Để login lại qua API:

1. Logout trước:
   ```powershell
   curl.exe -X POST http://localhost:3000/v1/auth/logout -H "X-API-Key: your-api-key"
   ```

2. Gọi QR endpoint để lấy QR code:
   ```powershell
   $response = curl.exe -s http://localhost:3000/v1/auth/qr -H "X-API-Key: your-api-key" | ConvertFrom-Json
   
   # Lưu QR thành file PNG
   [System.IO.File]::WriteAllBytes("qr-login.png", [System.Convert]::FromBase64String($response.data.qrCode))
   
   # Mở file để quét
   Start-Process qr-login.png
   ```

3. Quét QR bằng app Zalo

4. Đợi vài giây để credentials tự động lưu

5. Kiểm tra trạng thái:
   ```powershell
   curl.exe http://localhost:3000/v1/auth/status -H "X-API-Key: your-api-key"
   ```

### 6. Get QR Code (Login qua API)

**GET** `/v1/auth/qr`

Lấy QR code dưới dạng base64 để login (không cần restart server).

```powershell
curl.exe http://localhost:3000/v1/auth/qr -H "X-API-Key: your-secret-api-key-change-me"
```

**Response:**

```json
{
  "success": true,
  "data": {
    "qrCode": "iVBORw0KGgoAAAANSUhEUgAA...",
    "url": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...",
    "expiresIn": 120,
    "instructions": [
      "1. Open Zalo app on your phone",
      "2. Go to Settings > Linked Devices",
      "3. Scan this QR code",
      "4. Wait for login confirmation",
      "5. Credentials will be saved automatically"
    ]
  }
}
```

**Hiển thị QR code từ base64:**

```powershell
# Lấy QR
$response = curl.exe -s http://localhost:3000/v1/auth/qr -H "X-API-Key: zalo-api-secret-key-2026" | ConvertFrom-Json

# Lưu thành file PNG
$qrBase64 = $response.data.qrCode
[System.IO.File]::WriteAllBytes("qr-login.png", [System.Convert]::FromBase64String($qrBase64))

# Mở file để quét
Start-Process qr-login.png
```

**🔧 Với Postman:**

**Cách 1: Xem QR trực tiếp trong Postman (KHUYẾN NGHỊ)**

1. **Method**: GET
2. **URL**: `http://localhost:3000/v1/auth/qr`
3. **Headers**: `X-API-Key: your-secret-api-key-change-me`
4. Tab **Tests**, paste code:
   ```javascript
   const response = pm.response.json();
   const template = `
       <html>
       <body style="text-align: center; padding: 20px;">
           <h2>🔐 Zalo QR Login</h2>
           <img src="data:image/png;base64,${response.data.qrCode}" 
                width="300" />
           <div style="margin-top: 20px;">
               ${response.data.instructions.map(i => `<p>${i}</p>`).join('')}
               <p><strong>Expires: ${response.data.expiresIn}s</strong></p>
           </div>
       </body>
       </html>
   `;
   pm.visualizer.set(template);
   ```
5. Click **Send**
6. Click tab **Visualize** → QR hiển thị ngay!

**Cách 2: Download QR thành file**

1. Gửi request như trên
2. Copy `data.qrCode` từ response
3. Vào https://base64.guru/converter/decode/image
4. Paste base64 → Decode → Download PNG

**Hoặc hiển thị trong HTML:**

```html
<img src="data:image/png;base64,{qrCode}" alt="Scan to login">
```

### 7. Check Login Status

**GET** `/v1/auth/status`

```powershell
curl.exe http://localhost:3000/v1/auth/status -H "X-API-Key: your-secret-api-key-change-me"
```

**Response:**

```json
{
  "success": true,
  "data": {
    "isLoggedIn": true,
    "loginInfo": {
      "lastLoginTime": "2026-01-28T10:00:00.000Z",
      "daysSinceLogin": 0,
      "estimatedDaysRemaining": 21,
      "estimatedExpiryDate": "2026-02-18T10:00:00.000Z",
      "isExpiringSoon": false,
      "isLikelyExpired": false
    }
  }
}
```

### 8. Send Message

**POST** `/v1/messages/send`

**Headers:**

```
X-API-Key: your-secret-api-key-change-me
Content-Type: multipart/form-data
```

#### Gửi đến 1 user

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toUID=123456789" `
  -F "text=Hello from API"
```

#### Gửi đến nhiều users

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toUID=123456789,987654321,555666777" `
  -F "text=Broadcast message!"
```

#### Gửi đến 1 group

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toGROUPID=8544007930595627863" `
  -F "text=Hello group!"
```

#### Gửi đến nhiều groups

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toGROUPID=8544007930595627863,9876543210123456789" `
  -F "text=Group broadcast!"
```

#### Gửi đến CẢ users VÀ groups

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toUID=123456789,987654321" `
  -F "toGROUPID=8544007930595627863" `
  -F "text=Message for all!"
```

**🔧 Test với Postman:**

1. **Method**: POST (QUAN TRỌNG - không phải GET!)
2. **URL**: `http://localhost:3000/v1/messages/send`
3. **Headers** tab:
   ```
   X-API-Key: your-secret-api-key-change-me
   ```
4. **Body** tab:
   - Chọn **form-data** (không phải raw hay x-www-form-urlencoded)
   - Thêm các fields:
   
   | KEY | VALUE | TYPE |
   |-----|-------|------|
   | toUID | 123456789,987654321 | Text |
   | toGROUPID | 8544007930595627863 | Text |
   | text | Hello from Postman! | Text |

**❌ SAI:**
- Dùng GET method
- Gửi params qua query string: `?toUID=xxx&text=xxx`
- Dùng raw JSON body

**✅ ĐÚNG:**
- POST method
- form-data body
- X-API-Key header

#### Gửi Image

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toUID=123456789" `
  -F "text=Check this out!" `
  -F "file=@D:\path\to\image.jpg"
```

#### Gửi Video

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toUID=123456789" `
  -F "text=Video demo" `
  -F "file=@D:\path\to\video.mp4"
```

#### Gửi File đến nhiều người

```powershell
curl.exe -X POST http://localhost:3000/v1/messages/send `
  -H "X-API-Key: your-secret-api-key-change-me" `
  -F "toUID=123456789,987654321" `
  -F "toGROUPID=8544007930595627863" `
  -F "text=Weekly report" `
  -F "file=@D:\path\to\document.pdf"
```

**📎 Gửi file với Postman:**

1. **Method**: POST
2. **URL**: `http://localhost:3000/v1/messages/send`
3. **Headers**: `X-API-Key: your-secret-api-key-change-me`
4. **Body** → **form-data**:

   | KEY | VALUE | TYPE |
   |-----|-------|------|
   | toUID | 123456789 | Text |
   | text | Check this file | Text |
   | file | [Select File] | **File** ← Click để chọn file |

5. Ở cột TYPE, chọn **File** (không phải Text)
6. Click vào cell VALUE, nút "Select Files" sẽ hiện ra
7. Chọn file từ máy tính

**Request Parameters:**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `toUID` | string | No* | User ID (có thể nhiều, cách nhau bởi dấu phẩy) |
| `toGROUPID` | string | No* | Group ID (có thể nhiều, cách nhau bởi dấu phẩy) |
| `text` | string | No | Nội dung tin nhắn text |
| `file` | file | No | File đính kèm (image/video/document) |

*Ít nhất 1 trong 2 field `toUID` hoặc `toGROUPID` phải có

**Success Response (200):**

```json
{
  "success": true,
  "data": {
    "sent": 4,
    "failed": 0,
    "totalUsers": 2,
    "totalGroups": 2,
    "results": [
      {
        "to": "123456789",
        "type": "user",
        "success": true,
        "messageId": 123456789
      },
      {
        "to": "987654321",
        "type": "user",
        "success": true,
        "messageId": 123456790
      },
      {
        "to": "8544007930595627863",
        "type": "group",
        "success": true,
        "messageId": 123456791
      },
      {
        "to": "9876543210123456789",
        "type": "group",
        "success": true,
        "messageId": 123456792
      }
    ],
    "timestamp": "2026-01-28T10:30:00.000Z"
  },
  "requestId": "550e8400-e29b-41d4-a716-446655440000"
}
```

**Error Response (4xx/5xx):**

```json
{
  "success": false,
  "error": {
    "code": "INVALID_RECIPIENT",
    "message": "Recipient ID is invalid",
    "requestId": "550e8400-e29b-41d4-a716-446655440000"
  }
}
```

## 🔒 Bảo mật

### API Key Authentication

Thêm header vào mọi request:

```
X-API-Key: your-secret-api-key-change-me
```

### JWT Authentication (Nâng cao)

1. Đổi `AUTH_MODE=jwt` trong `.env`
2. Tạo JWT token bằng secret key
3. Thêm header:

```
Authorization: Bearer <your-jwt-token>
```

### Rate Limiting

- **Global**: 100 requests/15 phút/IP
- **Send Message**: 20 requests/1 phút/IP

### CORS

Chỉ cho phép origins được liệt kê trong `CORS_ORIGINS`.

### Upload Security & File Handling

- Max file size: 50MB (configurable)
- MIME type validation (magic number sniffing)
- Path traversal protection
- **Original filename preserved**: Tên file giữ nguyên 100% khi gửi qua Zalo
- **Auto-cleanup**: File tự động xóa khỏi server sau khi gửi (thành công hoặc thất bại)
- **Supported file types**: 
  - Images: JPG, PNG, GIF, WebP, BMP
  - Videos: MP4, MOV, AVI, MKV
  - Documents: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX
  - Archives: ZIP, RAR, 7Z
  - Text: TXT

## 🔄 Quản lý Session

### Cookie Lifecycle

**Với QR Code Login:**
- ✅ Lần đầu: Quét QR → Credentials tự động lưu
- ✅ Lần sau: Server tự động dùng cookie đã lưu
- ✅ Cookie hết hạn: Server tự động chuyển sang QR mode
- ⏱️ Thời gian cookie: ~2-4 tuần

**Không cần làm gì thêm!** Server tự động xử lý mọi thứ.

### Kiểm tra trạng thái đăng nhập

#### Cách 1: Health Check Endpoint (KHUYẾN NGHỊ)

```powershell
curl.exe http://localhost:3000/healthz
```

**Khi đã đăng nhập:**
```json
{
  "status": "ok",
  "timestamp": "2026-01-28T10:30:00.000Z",
  "zaloConnected": true
}
```

**Khi chưa đăng nhập hoặc bị logout:**
```json
{
  "status": "ok",
  "timestamp": "2026-01-28T10:30:00.000Z",
  "zaloConnected": false
}
```

#### Cách 2: Kiểm tra User Info

```powershell
curl.exe http://localhost:3000/v1/messages/me -H "X-API-Key: your-secret-api-key-change-me"
```

**Khi đã đăng nhập:**
```json
{
  "success": true,
  "data": {
    "uid": "1494219021607501875",
    "message": "Đây là UID của bạn..."
  }
}
```

**Khi bị logout:**
```json
{
  "success": false,
  "error": {
    "code": "GET_USER_FAILED",
    "message": "Cannot read properties of null..."
  }
}
```

#### Cách 3: Kiểm tra Server Logs

**Khi đã đăng nhập:**
```
[ZaloClient] ✓ Login successful!
[ZaloClient] ✓ Logged in as: Trần Điệp
✓ Zalo client initialized and ready
```

**Khi bị logout hoặc cookie hết hạn:**
```
[ZaloClient] Cookie expired or invalid
[ZaloClient] Switching to QR login...
[QR Code hiển thị tại đây]
Please scan this QR code with Zalo app
```

### Khi nào cần quét QR lại?

1. **Lần đầu tiên chạy server** (chưa có cookie)
   - Server tự động hiển thị QR
   - Quét QR bằng app Zalo
   
2. **Cookie hết hạn** (sau ~2-4 tuần)
   - Server báo: "Cookie expired"
   - QR code tự động hiển thị
   - Quét lại để renew session
   
3. **Bị logout từ thiết bị khác**
   - Health check trả về `zaloConnected: false`
   - API calls trả về error
   - Restart server để quét QR mới
   
4. **Đổi tài khoản Zalo khác**
   - Xóa credentials cũ:
     ```powershell
     Remove-Item data\cookie.json, config\config.json
     npm start
     ```

### Đăng nhập lại thủ công

Nếu muốn đăng nhập lại (ví dụ đổi tài khoản):

```powershell
# Xóa credentials cũ
Remove-Item data\cookie.json
Remove-Item config\config.json

# Chạy lại để quét QR
.\login-qr.ps1
# Hoặc
npm start
```

### Monitoring tự động (Tùy chọn)

Để tự động kiểm tra session mỗi 5 phút:

```powershell
# Tạo file monitor.ps1
@"
while ($true) {
    $response = curl.exe -s http://localhost:3000/healthz | ConvertFrom-Json
    $time = Get-Date -Format "HH:mm:ss"
    
    if ($response.zaloConnected -eq $false) {
        Write-Host "[$time] ⚠️  CẢNH BÁO: Zalo bị logout!" -ForegroundColor Red
        # Có thể gửi email/notification ở đây
    } else {
        Write-Host "[$time] ✓ Zalo đang hoạt động" -ForegroundColor Green
    }
    
    Start-Sleep -Seconds 300  # 5 phút
}
"@ | Out-File monitor.ps1

# Chạy monitoring
.\monitor.ps1
```

### Monitoring tự động (Tùy chọn)

Để tự động kiểm tra session mỗi 5 phút:

```powershell
# Tạo file monitor.ps1
@"
while ($true) {
    $response = curl.exe -s http://localhost:3000/healthz | ConvertFrom-Json
    $time = Get-Date -Format "HH:mm:ss"
    
    if ($response.zaloConnected -eq $false) {
        Write-Host "[$time] ⚠️  CẢNH BÁO: Zalo bị logout!" -ForegroundColor Red
        # Có thể gửi email/notification ở đây
    } else {
        Write-Host "[$time] ✓ Zalo đang hoạt động" -ForegroundColor Green
    }
    
    Start-Sleep -Seconds 300  # 5 phút
}
"@ | Out-File monitor.ps1

# Chạy monitoring
.\monitor.ps1
```

## 📁 Cấu trúc thư mục

```
zalo-api-server/
├── src/
│   ├── server.js              # Fastify server entry point
│   ├── routes/
│   │   └── messages.js        # Message endpoints
│   ├── middlewares/
│   │   ├── auth.js            # API Key/JWT authentication
│   │   └── rateLimit.js       # Rate limiting
│   ├── zca/
│   │   ├── client.js          # Singleton Zalo client (login bằng cookie)
│   │   └── send.js            # Send message wrapper
│   └── utils/
│       ├── upload.js          # Upload handler với validation
│       └── mime.js            # MIME type detector
├── data/
│   ├── cookie.json            # Zalo cookies (KHÔNG commit)
│   └── cookie.json.example    # Template mẫu
├── config/
│   ├── config.json            # imei + userAgent (KHÔNG commit)
│   └── config.json.example    # Template mẫu
├── uploads/                   # Thư mục upload tạm
├── .env                       # Environment variables (KHÔNG commit)
├── .env.example               # Template mẫu
├── .gitignore
├── package.json
└── README.md
```

## 🐛 Troubleshooting

### ❓ Làm sao biết khi nào bị logout?

**Dấu hiệu nhận biết:**

1. **Health check trả về `zaloConnected: false`**
   ```powershell
   curl.exe http://localhost:3000/healthz
   # {"zaloConnected": false}
   ```

2. **API calls bị lỗi:**
   ```json
   {
     "success": false,
     "error": {
       "code": "GET_USER_FAILED",
       "message": "API not initialized"
     }
   }
   ```

3. **Server logs hiển thị:**
   ```
   [ZaloClient] Login failed: Invalid cookie
   [ZaloClient] Switching to QR login mode...
   ```

**Giải pháp:**
- Restart server → Quét QR code mới
- Hoặc chạy `./login-qr.ps1`

### Lỗi: "Cannot find module 'zca-js'"

```powershell
npm install
```

### Lỗi: "Missing required params" hoặc "Login failed"

- Kiểm tra `data/cookie.json` có đúng format
- Kiểm tra `config/config.json` có đầy đủ `imei` và `userAgent`
- **Khuyến nghị:** Xóa credentials cũ và login lại bằng QR

### Lỗi: "Unauthorized" / "Cookie expired"

Cookie đã hết hạn:

**Giải pháp nhanh (QR Login):**
```powershell
Remove-Item data\cookie.json, config\config.json -ErrorAction SilentlyContinue
npm start
# Quét QR code hiển thị
```

### Lỗi: "Port 3000 already in use"

```powershell
# Thay đổi port trong .env
$env:PORT = "3001"
npm start
```

### Server không khởi động được

```powershell
# Xóa node_modules và reinstall
Remove-Item -Recurse -Force node_modules
npm install
```

## ⚠️ Lưu ý quan trọng

1. **KHÔNG commit** các file sau:
   - `data/cookie.json`
   - `config/config.json`
   - `.env`

2. **Cookie management**:
   - Cookie là "session", không tự động refresh
   - Khi hết hạn, phải lấy cookie mới từ browser
   - KHÔNG login lại bằng code

3. **Security**:
   - Đổi `API_KEY` và `JWT_SECRET` trong production
   - Không log cookie/imei/userAgent
   - Sử dụng HTTPS trong production

4. **Rate Limiting**:
   - Tránh spam API để không bị Zalo chặn
   - Điều chỉnh rate limit phù hợp với use case

5. **Zalo Policy**:
   - Sử dụng thư viện này có thể vi phạm điều khoản của Zalo
   - Tài khoản có thể bị khóa
   - Sử dụng với trách nhiệm của bản thân

## 📚 Tài liệu tham khảo

- [zca-js GitHub](https://github.com/RFS-ADRENO/zca-js)
- [zca-js Documentation](https://tdung.gitbook.io/zca-js)
- [Fastify Documentation](https://fastify.dev)

## 📝 License

MIT License - Sử dụng tự do với trách nhiệm của bản thân.

---

**Developed by**: Senior Node.js Engineer  
**Date**: January 2026
