<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Nguyễn Quốc Huy',
                'company' => 'BQL Khu nghỉ dưỡng Six Senses',
                'rating' => 5,
                'content' => 'Đội ngũ Hồ Nam triển khai rất chỉn chu, từ khảo sát đến bàn giao đều đúng tiến độ. Mảng xanh sau thi công giữ form tốt và phù hợp với khí hậu biển.',
            ],
            [
                'customer_name' => 'Lê Thị Kim Anh',
                'company' => 'Ban Quản lý Công viên Bãi Trước',
                'rating' => 5,
                'content' => 'Khả năng phối hợp hiện trường rất tốt. Cảnh quan sau khi hoàn thiện tạo được không gian đi bộ thoáng, sạch và có chiều sâu thẩm mỹ.',
            ],
            [
                'customer_name' => 'Trần Minh Quân',
                'company' => 'KCN Đông Xuyên',
                'rating' => 4,
                'content' => 'Hồ Nam tư vấn hợp lý cho mảng cây xanh ven trục đường nội khu. Cây sinh trưởng ổn định, ít công chăm sóc và hiệu quả che bóng rất tốt.',
            ],
            [
                'customer_name' => 'Phạm Hồng Nhung',
                'company' => 'Ocenami Resort',
                'rating' => 5,
                'content' => 'Dịch vụ chăm sóc định kỳ rất chuyên nghiệp. Sau mỗi đợt bảo dưỡng, khuôn viên nhìn luôn tươi mới và đồng đều, đúng tiêu chuẩn resort cao cấp.',
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::create([
                'customer_name' => $item['customer_name'],
                'company' => $item['company'],
                'avatar' => null,
                'rating' => $item['rating'],
                'content' => $item['content'],
                'is_visible' => true,
            ]);
        }
    }
}
