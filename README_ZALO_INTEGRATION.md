# Tích hợp Zalo trong LibreBooking

Tài liệu mô tả phần code tích hợp gửi thông báo Zalo (check-in/check-out) từ màn hình chỉnh sửa đặt chỗ.

---

## Tổng quan

- **Luồng**: Người dùng chụp ảnh trong modal camera → chọn "Khách vào" hoặc "Khách ra" → ảnh + nội dung được gửi tới Zalo (user/group) tùy theo **ResourceId**.
- **Bảo mật**: API key Zalo **không** gửi ra trình duyệt; cấu hình lưu trên server, trình duyệt chỉ nhận URL proxy, token proxy và danh sách người nhận (per-resource).
- **CORS**: Trình duyệt luôn gọi **proxy cùng origin** (`/Web/zalo-proxy.php`), proxy chuyển tiếp tới Zalo API server (Node.js) → tránh lỗi CORS.

---

## Cấu trúc file

| File | Mô tả |
|------|--------|
| `app/config/zalo.config.php` | Cấu hình Zalo (apiUrl, apiKey, per-resource). **Không commit** (`.gitignore`). |
| `app/Pages/Admin/ManageZaloPage.php` | Trang admin: đọc/ghi `zalo.config.php`. |
| `app/Web/admin/manage_zalo.php` | Entry point trang Cấu hình Zalo. |
| `app/tpl/Admin/Zalo/manage_zalo.tpl` | Giao diện form cấu hình Zalo. |
| `app/Web/zalo-settings.php` | API trả JSON cấu hình cho frontend (không trả `apiKey`/`apiUrl` thật). |
| `app/Web/zalo-proxy.php` | Proxy: nhận POST từ trình duyệt, gửi tiếp tới Zalo API server (dùng apiKey từ config). |
| `app/Web/scripts/zalo-config.js` | Load cấu hình từ `zalo-settings.php` → gán vào `window.ZaloConfig`. |
| `app/Web/scripts/reservation-camera.js` | Logic camera + gửi Zalo (đọc `window.ZaloConfig`, gửi qua `browserApiUrl` + `proxy_token`). |

---

## Cấu hình (trang Admin)

Vào **Cấu hình (⚙️) → Cấu hình Zalo** (chỉ Admin).

### Trên form

1. **URL API Zalo**  
   URL đầy đủ của Zalo API server (Node.js), ví dụ:  
   `https://ntzl.kimthanh.co/v1/messages/send`  
   Dùng cho **proxy** khi gửi request; **không** trả ra trình duyệt.

2. **API Key**  
   API key dùng để proxy xác thực với Zalo API server.  
   **Không** gửi ra client; chỉ proxy đọc từ config và gửi header khi gọi Zalo.

3. **UID mặc định** / **GROUPID mặc định**  
   Người nhận mặc định khi **không** có cấu hình theo resource (để trống nếu chỉ dùng per-resource).

4. **Cấu hình theo ResourceId (JSON)**  
   Object: key = **ResourceId** (số hoặc chuỗi), value = `recipientUID` và/hoặc `recipientGroupID`.

Ví dụ:

```json
{
  "9": {
    "recipientUID": "1896033675901362911",
    "recipientGroupID": ""
  },
  "7": {
    "recipientUID": "1896033675901362911",
    "recipientGroupID": "3433735635368484904"
  }
}
```

- ResourceId lấy từ input ẩn `#primaryResourceId` trên form đặt chỗ.
- Nếu resource có cấu hình riêng thì **chỉ** dùng UID/GroupID của resource đó (chuỗi rỗng = không gửi tới UID/Group tương ứng).

Sau khi sửa, bấm **Lưu cấu hình**. Lần đầu lưu sẽ tự sinh **proxy token** (dùng để proxy chỉ chấp nhận request từ frontend của bạn).

---

## Luồng bảo mật

1. **Trình duyệt**  
   - Gọi `GET /Web/zalo-settings.php` → nhận JSON: `browserApiUrl`, `proxyAuthToken`, `recipientUID`, `recipientGroupID`, `perResourceRecipients`.  
   - **Không** nhận `apiKey` hay `apiUrl` thật.

2. **Gửi Zalo**  
   - Frontend POST tới `browserApiUrl` (cùng origin, ví dụ `/Web/zalo-proxy.php`) với body: `text`, `file`, `toUID`, `toGROUPID`, `proxy_token`.  
   - **Không** gửi API key Zalo.

3. **Proxy**  
   - Đọc `config/zalo.config.php` → lấy `apiUrl`, `apiKey`, `proxyAuthToken`.  
   - Kiểm tra `proxy_token` (trong body hoặc header `X-Proxy-Token`) = `proxyAuthToken`.  
   - Gửi request tới `apiUrl` với header `X-API-Key: apiKey` từ config.

→ API key Zalo chỉ tồn tại trên server; client chỉ dùng proxy + token.

---

## Response của zalo-settings.php (ví dụ)

```json
{
  "recipientUID": "",
  "recipientGroupID": "",
  "perResourceRecipients": {
    "9": {
      "recipientUID": "1896033675901362911",
      "recipientGroupID": ""
    },
    "7": { "recipientUID": "1896033675901362911", "recipientGroupID": "" }
  },
  "proxyAuthToken": "c1b34c2764093067fe28aa1fa1301ff4",
  "browserApiUrl": "https://datlich.kimthanh.co/Web/zalo-proxy.php"
}
```

- `apiKey` và `apiUrl` **không** có trong response.

---

## Cài đặt / Triển khai

1. Đảm bảo đã có **Zalo API server** (Node.js) chạy và có endpoint nhận POST (ví dụ `/v1/messages/send`). Chi tiết xem `README_ZALO_API.md`.
2. Upload đủ các file liệt kê ở **Cấu trúc file** (trong đó có `zalo-proxy.php`, `zalo-settings.php`, `ManageZaloPage.php`, template, `zalo-config.js`, `reservation-camera.js`).
3. Tạo file cấu hình (hoặc dùng trang Admin):  
   Trong Admin → **Cấu hình Zalo**, nhập URL API, API Key, (tùy chọn) UID/GROUPID mặc định và JSON per-resource → **Lưu cấu hình**.  
   File `app/config/zalo.config.php` sẽ được tạo/cập nhật (và có `proxyAuthToken` nếu lần đầu lưu).
4. Phân quyền: chỉ Admin truy cập trang Cấu hình Zalo; trang đặt chỗ (có nút gửi Zalo) theo quyền LibreBooking hiện tại.

---

## Xử lý lỗi thường gặp

| Triệu chứng | Gợi ý |
|-------------|--------|
| **401 từ zalo-proxy.php** | Proxy yêu cầu `proxy_token` trùng config. Frontend gửi token trong body (`proxy_token`). Kiểm tra Form Data có field `proxy_token`; kiểm tra `zalo.config.php` có `proxyAuthToken` và giá trị trùng với `zalo-settings.php` trả về. |
| **CORS khi gọi trực tiếp Zalo API** | Trình duyệt phải gọi **browserApiUrl** (proxy), không gọi thẳng URL Zalo. Kiểm tra `zalo-config.js` dùng `serverConfig.browserApiUrl` cho `window.ZaloConfig.apiUrl`. |
| **Gửi sai người nhận (nhiều UID/Group)** | Đảm bảo `reservation-camera.js` đọc **window.ZaloConfig** mới nhất khi gửi và áp dụng đúng per-resource (ResourceId). Kiểm tra Console log `[Zalo Send] ResourceId` và `Final recipients`. |
| **JSON per-resource báo lỗi** | Dùng **object** `{ "9": { ... } }`, không dùng array `[ { "9": ... } ]`. Dấu ngoặc cuối đúng (một `}` cho object resource, một `}` cho object ngoài). |

---

## Tài liệu liên quan

- **README_ZALO_API.md** – Zalo API server (Node.js): endpoint, đăng nhập, gửi tin nhắn.
- **README.md** – Tổng quan project, Camera, cấu hình file đính kèm.

---

*Phần tích hợp Zalo trong LibreBooking – cập nhật theo kiến trúc admin config + proxy + token (January 2026).*
