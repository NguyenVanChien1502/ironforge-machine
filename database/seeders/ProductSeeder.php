<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Thi công Resort Six Senses - Đất Dốc Côn Đảo',
                'category' => 'Resort Landscape',
                'model' => 'SS-CONDAO',
                'featured' => true,
                'specs' => [
                    ['key' => 'Quy mô dự án', 'value' => '12 héc-ta'],
                    ['key' => 'Thời gian thi công', 'value' => '18 tháng'],
                    ['key' => 'Mật độ cây xanh', 'value' => '65%'],
                    ['key' => 'Hạng mục chính', 'value' => 'Cây dừa cát, phong ba, cây bóng mát ven biển'],
                ],
                'desc' => 'Gói thi công cảnh quan cho khu nghỉ dưỡng cao cấp Six Senses Côn Đảo, ưu tiên hệ sinh thái bản địa, mảng xanh ven biển và trải nghiệm nghỉ dưỡng hài hòa với thiên nhiên.',
            ],
            [
                'title' => 'EPC Cảnh quan KDL Bến Thành - Long Hải',
                'category' => 'Resort Landscape',
                'model' => 'BTLH-EPC',
                'featured' => true,
                'specs' => [
                    ['key' => 'Quy mô dự án', 'value' => '20 héc-ta'],
                    ['key' => 'Thời gian thi công', 'value' => '24 tháng'],
                    ['key' => 'Mật độ cây xanh', 'value' => '58%'],
                    ['key' => 'Hạng mục chính', 'value' => 'Chà là biển, phi lao, cỏ nhung Nhật'],
                ],
                'desc' => 'Tổng thầu EPC cho toàn bộ hệ thống cây xanh, thảm cỏ và tiểu cảnh nước tại khu du lịch sinh thái Bến Thành - Long Hải, bảo đảm chất lượng thi công đồng bộ và vận hành bền vững.',
            ],
            [
                'title' => 'Thi công và chăm sóc cây xanh Ocenami',
                'category' => 'Resort Landscape',
                'model' => 'OCN-VILLA',
                'featured' => false,
                'specs' => [
                    ['key' => 'Quy mô dự án', 'value' => '350 căn biệt thự'],
                    ['key' => 'Hợp đồng chăm sóc', 'value' => 'Định kỳ hàng năm'],
                    ['key' => 'Mật độ cây xanh', 'value' => '50%'],
                    ['key' => 'Hạng mục chính', 'value' => 'Cây sứ đại, hoa giấy cổ thụ, cây lài tây'],
                ],
                'desc' => 'Dịch vụ thi công và bảo dưỡng vườn cảnh quan cho quần thể biệt thự nghỉ dưỡng Ocenami, đi kèm chăm sóc định kỳ, cắt tỉa tạo dáng và phòng trừ sâu bệnh theo mùa.',
            ],
            [
                'title' => 'Thi công Công viên Bãi Trước Vũng Tàu',
                'category' => 'Villas & Corporate Gardens',
                'model' => 'BT-PARK',
                'featured' => true,
                'specs' => [
                    ['key' => 'Quy mô dự án', 'value' => '3 héc-ta'],
                    ['key' => 'Thời gian thi công', 'value' => '6 tháng'],
                    ['key' => 'Mật độ cây xanh', 'value' => '70%'],
                    ['key' => 'Hạng mục chính', 'value' => 'Dừa xiêm, bàng Đài Loan, hoa giấy ngũ sắc'],
                ],
                'desc' => 'Dự án chỉnh trang công viên ven biển, bổ sung bóng mát, thảm cỏ và không gian đi bộ thân thiện cho người dân cũng như du khách tại khu vực Bãi Trước, Vũng Tàu.',
            ],
            [
                'title' => 'Thi công cây xanh Bảo tàng Bà Rịa - Vũng Tàu',
                'category' => 'Villas & Corporate Gardens',
                'model' => 'BRVT-MUSEUM',
                'featured' => false,
                'specs' => [
                    ['key' => 'Quy mô dự án', 'value' => '1,5 héc-ta'],
                    ['key' => 'Thời gian thi công', 'value' => '4 tháng'],
                    ['key' => 'Mật độ cây xanh', 'value' => '40%'],
                    ['key' => 'Hạng mục chính', 'value' => 'Cây Osaka đỏ, vạn tuế, thảm cỏ lá gừng'],
                ],
                'desc' => 'Hạng mục cảnh quan quanh bảo tàng tỉnh, tạo cảm giác trang trọng nhưng vẫn thông thoáng, gần gũi và dễ chăm sóc trong dài hạn.',
            ],
            [
                'title' => 'Cung cấp cây xanh cảnh quan KCN Đông Xuyên',
                'category' => 'Industrial Parks',
                'model' => 'DX-IZ',
                'featured' => true,
                'specs' => [
                    ['key' => 'Quy mô dự án', 'value' => 'Hệ thống trục đường chính'],
                    ['key' => 'Thời gian thi công', 'value' => '8 tháng'],
                    ['key' => 'Mật độ cây xanh', 'value' => '30%'],
                    ['key' => 'Hạng mục chính', 'value' => 'Cây dầu rái, lim sét, việt quất cảnh quan'],
                ],
                'desc' => 'Thiết lập dải cây xanh cách ly, hàng rào xanh giảm bụi và tạo bóng mát ven các trục giao thông nội khu của Khu Công Nghiệp Đông Xuyên.',
            ],
        ];

        foreach ($projects as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'model_number' => $item['model'],
                'category_id' => $category->id,
                'image' => null,
                'specifications' => $item['specs'],
                'description' => $item['desc'],
                'is_featured' => $item['featured'],
            ]);
        }
    }
}
