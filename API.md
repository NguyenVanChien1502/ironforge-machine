# IronForge Machinery API

API công khai dùng prefix `/api/v1`. Các endpoint đọc không yêu cầu đăng nhập.

## Chạy dự án

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Mặc định API chạy tại `http://127.0.0.1:8000/api/v1`.

## Endpoint

| Method | URL | Mô tả |
|---|---|---|
| GET | `/home` | Dữ liệu tổng hợp cho trang chủ |
| GET | `/settings` | Cấu hình công khai |
| GET | `/categories` | Danh sách danh mục |
| GET | `/categories/{slug}` | Chi tiết danh mục và sản phẩm |
| GET | `/products` | Danh sách sản phẩm |
| GET | `/products/featured` | Sản phẩm nổi bật |
| GET | `/products/{slug}` | Chi tiết và sản phẩm liên quan |
| GET | `/posts` | Danh sách bài đã xuất bản |
| GET | `/posts/{slug}` | Chi tiết bài đã xuất bản |
| GET | `/testimonials` | Đánh giá đang hiển thị |
| POST | `/inquiries` | Gửi yêu cầu tư vấn |

Các endpoint dạng danh sách hỗ trợ `per_page` (1–100). Sản phẩm hỗ trợ thêm
`search`, `category` (ID hoặc slug), `featured`; bài viết hỗ trợ `search`.

## Test tự động

Test dùng SQLite in-memory, không sửa database trong `.env`:

```powershell
php artisan test
```

Chỉ chạy test API:

```powershell
php artisan test --filter=ApiTest
```

## Test thủ công bằng PowerShell

```powershell
Invoke-RestMethod http://127.0.0.1:8000/api/v1/products

Invoke-RestMethod "http://127.0.0.1:8000/api/v1/products?search=excavator&featured=1&per_page=5"

Invoke-RestMethod http://127.0.0.1:8000/api/v1/categories/excavators

$body = @{
    name = "Nguyễn Văn An"
    phone = "0901234567"
    email = "an@example.com"
    message = "Tôi cần báo giá máy xúc."
} | ConvertTo-Json

Invoke-RestMethod `
    -Method Post `
    -Uri http://127.0.0.1:8000/api/v1/inquiries `
    -ContentType "application/json" `
    -Body $body
```

Yêu cầu hợp lệ trả HTTP `201`. Dữ liệu không hợp lệ trả HTTP `422` cùng
trường `errors`; slug không tồn tại hoặc bài chưa xuất bản trả HTTP `404`.

## Test bằng Postman

1. Tạo environment variable `base_url = http://127.0.0.1:8000/api/v1`.
2. Gửi `GET {{base_url}}/products`.
3. Gửi `POST {{base_url}}/inquiries`, chọn **Body → raw → JSON** và nhập:

```json
{
  "name": "Nguyễn Văn An",
  "phone": "0901234567",
  "email": "an@example.com",
  "message": "Tôi cần báo giá máy xúc."
}
```
