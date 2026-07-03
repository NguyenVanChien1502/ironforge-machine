<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'floating_phone' => '064.358.6494',
            'floating_zalo' => 'https://zalo.me/0643586494',
            'floating_facebook' => 'https://facebook.com/cayxanhhonam',
            'floating_chat' => 'mailto:cayxanhhonam.vt@gmail.com',
            'show_floating_cart' => '1',
            'show_floating_zalo' => '1',
            'show_floating_phone' => '1',
            'show_floating_chat' => '1',
            'show_floating_facebook' => '1',
            'floating_cart' => '1',
            'floating_cart_badge' => '1',
            'show_floating_bar' => '1',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
