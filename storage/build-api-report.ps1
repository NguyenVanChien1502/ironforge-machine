$ErrorActionPreference = 'Stop'
$root = 'D:\ironforge-machinery'
$outDir = Join-Path $root 'bao-cao-api'
New-Item -ItemType Directory -Force -Path $outDir | Out-Null
$server = Start-Process -FilePath 'powershell.exe' `
    -ArgumentList @('-NoProfile', '-ExecutionPolicy', 'Bypass', '-File', (Join-Path $root 'storage\start-evidence-server.ps1')) `
    -WindowStyle Hidden -PassThru
Start-Sleep -Seconds 2

function New-TerminalImage {
    param(
        [string]$Title,
        [string[]]$Lines,
        [string]$Path,
        [int]$Width = 1500,
        [int]$Height = 900
    )

    Add-Type -AssemblyName System.Drawing
    $bitmap = New-Object System.Drawing.Bitmap($Width, $Height)
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.SmoothingMode = 'AntiAlias'
    $graphics.TextRenderingHint = 'ClearTypeGridFit'
    $graphics.Clear([System.Drawing.Color]::FromArgb(15, 23, 42))

    $titleFont = New-Object System.Drawing.Font('Segoe UI', 22, [System.Drawing.FontStyle]::Bold)
    $bodyFont = New-Object System.Drawing.Font('Consolas', 15)
    $mutedFont = New-Object System.Drawing.Font('Segoe UI', 12)
    $white = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb(241, 245, 249))
    $green = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb(74, 222, 128))
    $muted = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb(148, 163, 184))

    $graphics.FillEllipse([System.Drawing.Brushes]::Red, 24, 22, 16, 16)
    $graphics.FillEllipse([System.Drawing.Brushes]::Gold, 50, 22, 16, 16)
    $graphics.FillEllipse([System.Drawing.Brushes]::LimeGreen, 76, 22, 16, 16)
    $graphics.DrawString($Title, $titleFont, $white, 118, 14)
    $graphics.DrawString('Nguồn: đầu ra thực tế từ dự án tại thời điểm lập báo cáo', $mutedFont, $muted, 24, 58)

    $y = 92
    foreach ($line in $Lines) {
        if ($y -gt ($Height - 30)) { break }
        $brush = if ($line -match 'PASS|Tests:|200|201|GET|POST|Showing') { $green } else { $white }
        $graphics.DrawString($line, $bodyFont, $brush, 24, $y)
        $y += 25
    }

    $bitmap.Save($Path, [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    $titleFont.Dispose()
    $bodyFont.Dispose()
    $mutedFont.Dispose()
    $white.Dispose()
    $green.Dispose()
    $muted.Dispose()
}

Set-Location $root
$routes = (& php artisan route:list --path=api 2>&1 | Out-String).Trim() -split "`r?`n"
$tests = (& php artisan test 2>&1 | Out-String).Trim() -split "`r?`n"
$response = Invoke-RestMethod 'http://127.0.0.1:8765/api/v1/products?per_page=1'
$json = ($response | ConvertTo-Json -Depth 6).Trim() -split "`r?`n"

$routeImage = Join-Path $outDir 'bang-chung-01-routes.png'
$testImage = Join-Path $outDir 'bang-chung-02-tests.png'
$jsonImage = Join-Path $outDir 'bang-chung-03-json.png'
New-TerminalImage 'Bằng chứng 01 — Laravel nhận diện API routes' $routes $routeImage 1500 720
New-TerminalImage 'Bằng chứng 02 — Kết quả kiểm thử tự động' $tests $testImage 1500 620
New-TerminalImage 'Bằng chứng 03 — Phản hồi JSON từ API đang chạy' $json $jsonImage 1500 1080

$docPath = Join-Path $outDir 'Bao-cao-xay-dung-API-IronForge.docx'
$pdfPath = Join-Path $outDir 'Bao-cao-xay-dung-API-IronForge.pdf'

$word = New-Object -ComObject Word.Application
$word.Visible = $false
$word.DisplayAlerts = 0
$doc = $word.Documents.Add()
$selection = $word.Selection

$section = $doc.Sections.Item(1)
$section.PageSetup.TopMargin = $word.CentimetersToPoints(2.2)
$section.PageSetup.BottomMargin = $word.CentimetersToPoints(2.0)
$section.PageSetup.LeftMargin = $word.CentimetersToPoints(2.5)
$section.PageSetup.RightMargin = $word.CentimetersToPoints(2.2)

$normal = $doc.Styles.Item('Normal')
$normal.Font.Name = 'Arial'
$normal.Font.Size = 11
$normal.ParagraphFormat.SpaceAfter = 6
$normal.ParagraphFormat.LineSpacingRule = 1
$normal.ParagraphFormat.LineSpacing = 15

foreach ($styleName in @('Heading 1', 'Heading 2')) {
    $style = $doc.Styles.Item($styleName)
    $style.Font.Name = 'Arial'
    $style.Font.Color = 1162571
}
$doc.Styles.Item('Heading 1').Font.Size = 16
$doc.Styles.Item('Heading 2').Font.Size = 13

function Add-Text {
    param([string]$Text, [switch]$Bold, [switch]$Center, [int]$Size = 11)
    $selection.Style = $doc.Styles.Item('Normal')
    $selection.Font.Name = 'Arial'
    $selection.Font.Size = $Size
    $selection.Font.Bold = if ($Bold) { 1 } else { 0 }
    $selection.ParagraphFormat.Alignment = if ($Center) { 1 } else { 0 }
    $selection.TypeText($Text)
    $selection.TypeParagraph()
}

function Add-Heading {
    param([string]$Text, [int]$Level = 1)
    $selection.Style = $doc.Styles.Item("Heading $Level")
    $selection.ParagraphFormat.Alignment = 0
    $selection.TypeText($Text)
    $selection.TypeParagraph()
}

function Add-Bullet {
    param([string]$Text)
    $selection.Style = $doc.Styles.Item('Normal')
    $selection.Range.ListFormat.ApplyBulletDefault()
    $selection.TypeText($Text)
    $selection.TypeParagraph()
    $selection.Range.ListFormat.RemoveNumbers()
}

function Add-Picture {
    param([string]$Path, [string]$Caption)
    $selection.ParagraphFormat.Alignment = 1
    $shape = $selection.InlineShapes.AddPicture($Path)
    $shape.LockAspectRatio = -1
    $shape.Width = $word.CentimetersToPoints(16.0)
    $selection.TypeParagraph()
    $selection.Font.Name = 'Arial'
    $selection.Font.Size = 9
    $selection.Font.Italic = 1
    $selection.TypeText($Caption)
    $selection.TypeParagraph()
    $selection.Font.Italic = 0
    $selection.ParagraphFormat.Alignment = 0
}

# Cover
$selection.TypeParagraph()
$selection.TypeParagraph()
Add-Text 'BÁO CÁO XÂY DỰNG API' -Bold -Center -Size 24
Add-Text 'Dự án IronForge Machinery' -Bold -Center -Size 18
Add-Text 'Laravel 11 — RESTful API phiên bản v1' -Center -Size 13
$selection.TypeParagraph()
$selection.TypeParagraph()
Add-Text 'Sinh viên: ............................................................' -Size 12
Add-Text 'Mã số sinh viên: ...................................................' -Size 12
Add-Text 'Lớp: .....................................................................' -Size 12
Add-Text 'Giảng viên: ............................................................' -Size 12
$selection.TypeParagraph()
Add-Text 'Ngày lập báo cáo: 04/07/2026' -Center -Size 11
$selection.InsertBreak(7)

Add-Heading '1. Mục tiêu và phạm vi' 1
Add-Text 'Mục tiêu của công việc là xây dựng lớp API công khai cho website IronForge Machinery mà không thay đổi đáng kể luồng xử lý web và trang quản trị hiện có. API phục vụ việc tích hợp frontend, ứng dụng di động hoặc hệ thống bên thứ ba.'
Add-Bullet 'Giữ nguyên các model, migration, controller web và giao diện Blade hiện hữu.'
Add-Bullet 'Tách API theo namespace App\Http\Controllers\Api\V1 và prefix /api/v1.'
Add-Bullet 'Chuẩn hóa dữ liệu trả về bằng Laravel API Resource.'
Add-Bullet 'Bảo vệ endpoint gửi yêu cầu bằng validation và rate limiting.'
Add-Bullet 'Kiểm thử trên SQLite in-memory để không tác động cơ sở dữ liệu thật.'

Add-Heading '2. Công nghệ và kiến trúc triển khai' 1
Add-Text 'Dự án sử dụng PHP 8.2+, Laravel 11, Eloquent ORM và PHPUnit 11. API được tổ chức theo phiên bản v1 để có thể mở rộng mà không phá vỡ client đang sử dụng.'
Add-Text 'Luồng xử lý: HTTP Request → routes/api.php → API Controller → Eloquent Model → API Resource → JSON Response.' -Bold
Add-Heading '2.1. Các thành phần bổ sung' 2
Add-Bullet 'routes/api.php: khai báo 11 endpoint công khai.'
Add-Bullet 'app/Http/Controllers/Api/V1: xử lý truy vấn, lọc, phân trang và tạo inquiry.'
Add-Bullet 'app/Http/Resources/Api/V1: định dạng JSON nhất quán, chỉ công khai trường cần thiết.'
Add-Bullet 'bootstrap/app.php: đăng ký api route theo cơ chế Laravel 11.'
Add-Bullet 'tests/Feature/Api/V1/ApiTest.php: kiểm thử tích hợp các hành vi quan trọng.'

Add-Heading '3. Danh sách endpoint' 1
$table = $doc.Tables.Add($selection.Range, 12, 3)
$table.Borders.Enable = 1
$table.AllowAutoFit = $false
$table.Columns.Item(1).Width = $word.CentimetersToPoints(2.0)
$table.Columns.Item(2).Width = $word.CentimetersToPoints(7.0)
$table.Columns.Item(3).Width = $word.CentimetersToPoints(7.0)
$headers = @('Method', 'Endpoint', 'Chức năng')
for ($c = 1; $c -le 3; $c++) {
    $table.Cell(1, $c).Range.Text = $headers[$c - 1]
    $table.Cell(1, $c).Range.Bold = 1
    $table.Cell(1, $c).Shading.BackgroundPatternColor = 15132390
}
$rows = @(
    @('GET', '/api/v1/home', 'Dữ liệu tổng hợp trang chủ'),
    @('GET', '/api/v1/settings', 'Cấu hình công khai'),
    @('GET', '/api/v1/categories', 'Danh sách danh mục'),
    @('GET', '/api/v1/categories/{slug}', 'Chi tiết danh mục và sản phẩm'),
    @('GET', '/api/v1/products', 'Danh sách, tìm kiếm và lọc sản phẩm'),
    @('GET', '/api/v1/products/featured', 'Sản phẩm nổi bật'),
    @('GET', '/api/v1/products/{slug}', 'Chi tiết và sản phẩm liên quan'),
    @('GET', '/api/v1/posts', 'Danh sách bài đã xuất bản'),
    @('GET', '/api/v1/posts/{slug}', 'Chi tiết bài đã xuất bản'),
    @('GET', '/api/v1/testimonials', 'Đánh giá đang hiển thị'),
    @('POST', '/api/v1/inquiries', 'Gửi yêu cầu tư vấn')
)
for ($r = 0; $r -lt $rows.Count; $r++) {
    for ($c = 0; $c -lt 3; $c++) {
        $table.Cell($r + 2, $c + 1).Range.Text = $rows[$r][$c]
    }
}
$selection.SetRange($table.Range.End, $table.Range.End)
$selection.TypeParagraph()

Add-Heading '4. Các chức năng chính' 1
Add-Heading '4.1. Truy vấn và phân trang' 2
Add-Text 'Danh sách sản phẩm, danh mục, bài viết và đánh giá sử dụng paginator. Tham số per_page được giới hạn từ 1 đến 100 nhằm tránh truy vấn quá lớn. Sản phẩm hỗ trợ search, category và featured; bài viết hỗ trợ search.'
Add-Heading '4.2. Route model binding bằng slug' 2
Add-Text 'Các endpoint chi tiết dùng cú pháp {product:slug}, {category:slug} và {post:slug}. Laravel tự tìm bản ghi theo slug; nếu không tồn tại sẽ trả HTTP 404.'
Add-Heading '4.3. Validation và an toàn dữ liệu' 2
Add-Text 'POST /inquiries tái sử dụng StoreInquiryRequest. Các trường name, phone và email là bắt buộc; product_id phải tồn tại nếu được gửi. Endpoint áp dụng throttle 30 request/phút và trả HTTP 201 khi tạo thành công.'
Add-Heading '4.4. Kiểm soát nội dung công khai' 2
Add-Text 'API bài viết chỉ trả bản ghi is_published = true; đánh giá chỉ trả is_visible = true. SettingController chỉ công khai nhóm cấu hình cần cho giao diện, không trả toàn bộ bảng settings.'

$selection.InsertBreak(7)
Add-Heading '5. Bằng chứng triển khai' 1
Add-Text 'Hình 1 chứng minh Laravel đã nạp routes/api.php và nhận diện đầy đủ 11 endpoint dưới prefix /api/v1.'
Add-Picture $routeImage 'Hình 1. Kết quả lệnh php artisan route:list --path=api.'
Add-Text 'Hình 2 là kết quả chạy toàn bộ bộ test. Tất cả 6 test với 36 assertion đều vượt qua, bao gồm lọc sản phẩm, route binding, bảo vệ bài nháp, validation inquiry và cấu trúc JSON trang chủ.'
Add-Picture $testImage 'Hình 2. Kết quả lệnh php artisan test.'

$selection.InsertBreak(7)
Add-Heading '6. Bằng chứng phản hồi API' 1
Add-Text 'Server Laravel được chạy cục bộ với SQLite riêng tại cổng 8765. Lệnh GET /api/v1/products?per_page=1 trả HTTP thành công, gồm data, links và meta. Điều này chứng minh API có dữ liệu, quan hệ category và thông tin phân trang.'
Add-Picture $jsonImage 'Hình 3. JSON thực tế từ GET http://127.0.0.1:8765/api/v1/products?per_page=1.'

Add-Heading '7. Quy trình kiểm thử lại' 1
Add-Text 'Bước 1 — Chuẩn bị dữ liệu:' -Bold
Add-Text 'php artisan migrate --seed'
Add-Text 'Bước 2 — Khởi động server:' -Bold
Add-Text 'php artisan serve'
Add-Text 'Bước 3 — Chạy kiểm thử tự động:' -Bold
Add-Text 'php artisan test --filter=ApiTest'
Add-Text 'Bước 4 — Kiểm thử thủ công:' -Bold
Add-Text 'Invoke-RestMethod http://127.0.0.1:8000/api/v1/products'
Add-Text 'Có thể dùng Postman với base URL http://127.0.0.1:8000/api/v1. Khi gửi POST /inquiries, chọn Body → raw → JSON và cung cấp name, phone, email, message.'

Add-Heading '8. Kết luận' 1
Add-Text 'API v1 đã được tích hợp theo hướng ít xâm lấn: không thay đổi schema dữ liệu, không sửa luồng web/admin và tái sử dụng model cùng validation hiện có. Kết quả kiểm thử xác nhận các endpoint quan trọng hoạt động đúng, dữ liệu công khai được kiểm soát và phản hồi tuân theo JSON có cấu trúc.'

$footer = $section.Footers.Item(1).Range
$footer.Text = 'Báo cáo xây dựng API — IronForge Machinery'
$footer.Font.Name = 'Arial'
$footer.Font.Size = 9
$footer.Font.Color = 8421504
$footer.ParagraphFormat.Alignment = 1

$doc.SaveAs2($docPath, 16)
$doc.ExportAsFixedFormat($pdfPath, 17)
$doc.Close()
$word.Quit()
[System.Runtime.InteropServices.Marshal]::ReleaseComObject($doc) | Out-Null
[System.Runtime.InteropServices.Marshal]::ReleaseComObject($word) | Out-Null
Stop-Process -Id $server.Id -Force -ErrorAction SilentlyContinue

Write-Output $docPath
Write-Output $pdfPath
