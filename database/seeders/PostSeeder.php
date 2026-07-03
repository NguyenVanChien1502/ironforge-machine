<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Xu hướng thiết kế cảnh quan resort ven biển năm 2026',
                'excerpt' => 'Những nguyên tắc giúp cảnh quan resort vừa sang trọng vừa bền vững trước điều kiện nắng, gió và hơi muối.',
                'body' => "Cảnh quan ven biển đòi hỏi sự cân bằng giữa thẩm mỹ, vi khí hậu và khả năng thích nghi của cây trồng. Các khu nghỉ dưỡng cao cấp ngày nay không chỉ cần một không gian đẹp mắt mà còn cần vận hành bền vững trong suốt nhiều năm.\n\n### 1. Ưu tiên cây bản địa\nNhững loài cây bản địa chịu gió, chịu mặn và ít rụng lá giúp giảm chi phí bảo dưỡng, đồng thời giữ được vẻ tự nhiên của vùng biển.\n\n### 2. Tạo lớp cảnh quan nhiều tầng\nKết hợp cây bóng mát, cây bụi, thảm cỏ và mảng nước sẽ giúp không gian có chiều sâu, chuyển tiếp mềm giữa kiến trúc và thiên nhiên.\n\n### 3. Tối ưu lối đi và điểm nhìn\nỞ resort ven biển, cảnh quan cần dẫn dắt tầm nhìn ra biển, hồ bơi hoặc quảng trường trung tâm thay vì che khuất trải nghiệm của du khách.",
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Lựa chọn cây xanh phù hợp cho khu đô thị và công trình công cộng',
                'excerpt' => 'Một số tiêu chí thực tế để chọn cây xanh cho công viên, quảng trường, bảo tàng và khu đô thị mới.',
                'body' => "Chọn cây xanh cho công trình công cộng không thể chỉ dựa vào vẻ đẹp. Cần xét đến mật độ người qua lại, độ an toàn rễ cây, khả năng che bóng và tần suất chăm sóc.\n\n### Nhóm cây nên ưu tiên\n- Cây có tán đẹp, rễ ít phá vỡ hạ tầng.\n- Cây chịu được cắt tỉa định kỳ.\n- Cây phù hợp với điều kiện đất, nước và nắng của từng khu vực.\n\n### Quy trình triển khai\nMột hồ sơ cảnh quan tốt luôn bắt đầu bằng khảo sát hiện trạng, sau đó mới tới bố trí cây, hệ tưới và kế hoạch duy tu dài hạn.\n\n### Kết quả mong đợi\nKhông gian phải sạch, thoáng, bền và dễ bảo trì trong nhiều năm sử dụng.",
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => '5 nguyên tắc chăm sóc cây xanh sau khi bàn giao dự án',
                'excerpt' => 'Bàn giao xong chỉ là khởi đầu. Giai đoạn chăm sóc quyết định phần lớn tuổi thọ của toàn bộ cảnh quan.',
                'body' => "Sau khi công trình hoàn thành, giai đoạn chăm sóc quyết định 60-70% chất lượng cảnh quan về lâu dài. Những nguyên tắc dưới đây giúp duy trì diện mạo dự án ổn định và khỏe mạnh.\n\n### 1. Tưới đúng nhịp\nMỗi loại cây và mỗi giai đoạn phát triển sẽ có nhu cầu nước khác nhau. Tưới quá nhiều còn nguy hiểm hơn tưới thiếu.\n\n### 2. Cắt tỉa định kỳ\nCắt tỉa giúp cây giữ form đẹp, giảm sâu bệnh và tránh cạnh tranh ánh sáng.\n\n### 3. Bón phân theo chu kỳ\nKhông nên bón theo cảm tính. Cần có kế hoạch dinh dưỡng theo mùa và theo tình trạng thực tế của cây.\n\n### 4. Kiểm tra sâu bệnh\nPhát hiện sớm luôn rẻ hơn xử lý muộn.\n\n### 5. Ghi nhật ký chăm sóc\nNhật ký rõ ràng giúp đội vận hành theo dõi thay đổi và tối ưu công tác bảo dưỡng.",
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Hồ Nam khởi động chuỗi dự án cảnh quan xanh tại Bà Rịa - Vũng Tàu',
                'excerpt' => 'Công ty tiếp tục mở rộng năng lực thi công và chăm sóc cây xanh cho các khu resort, công viên và công trình công cộng.',
                'body' => "Hồ Nam đang đẩy mạnh các hạng mục thi công cảnh quan theo hướng tổng thể: thiết kế, cung cấp cây, thi công, hệ tưới và bảo dưỡng sau bàn giao.\n\n### Điểm nổi bật của dự án\n- Chú trọng cây bản địa và cây chịu điều kiện khí hậu biển.\n- Tối ưu trải nghiệm thị giác tại các khu đón khách.\n- Đảm bảo vận hành, chăm sóc và thay thế cây trong suốt vòng đời dự án.\n\n### Định hướng tiếp theo\nTrong giai đoạn tới, Hồ Nam sẽ tiếp tục tập trung vào các dự án resort, khu công nghiệp và công trình công cộng có yêu cầu cao về tính bền vững và chất lượng thẩm mỹ.",
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $item) {
            Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'excerpt' => $item['excerpt'],
                'body' => $item['body'],
                'image' => null,
                'is_published' => $item['is_published'],
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
