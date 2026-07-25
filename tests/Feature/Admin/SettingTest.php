<?php

namespace Tests\Feature\Admin;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_home_statistics_and_about_section(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'site_name' => 'Hồ Nam Landscape',
            'stat_1_value' => '25+',
            'stat_1_label' => 'Năm kinh nghiệm',
            'stat_2_value' => '450+',
            'stat_2_label' => 'Dự án bàn giao',
            'stat_3_value' => '4',
            'stat_3_label' => 'Miền phục vụ',
            'stat_4_value' => '80+',
            'stat_4_label' => 'Đối tác',
            'about_eyebrow' => 'Về chúng tôi',
            'about_title' => 'Kiến tạo cảnh quan bền vững',
            'about_description_1' => 'Nội dung giới thiệu mới.',
            'about_description_2' => 'Đoạn nội dung bổ sung.',
            'about_point_1' => 'Khảo sát chuyên nghiệp',
            'about_point_2' => 'Thi công đồng bộ',
            'about_point_3' => 'Bảo dưỡng dài hạn',
        ]);

        $response->assertRedirect(route('admin.settings.edit'));
        $this->assertDatabaseHas('settings', ['key' => 'stat_1_value', 'value' => '25+']);
        $this->assertDatabaseHas('settings', ['key' => 'about_title', 'value' => 'Kiến tạo cảnh quan bền vững']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('25+')
            ->assertSee('Năm kinh nghiệm')
            ->assertSee('Kiến tạo cảnh quan bền vững');
    }
}
