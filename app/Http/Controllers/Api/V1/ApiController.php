<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

abstract class ApiController extends Controller
{
    protected function publicSettings(): array
    {
        if (! Schema::hasTable('settings')) {
            return [
                'floating_phone' => null,
                'floating_zalo' => null,
                'floating_facebook' => null,
                'floating_chat' => null,
                'show_floating_cart' => '0',
                'show_floating_zalo' => '0',
                'show_floating_phone' => '0',
                'show_floating_chat' => '0',
                'show_floating_facebook' => '0',
                'floating_cart' => '0',
                'floating_cart_badge' => null,
                'show_floating_bar' => '0',
            ];
        }

        $settings = Setting::pluck('value', 'key')->all();

        return [
            'floating_phone' => $settings['floating_phone'] ?? null,
            'floating_zalo' => $settings['floating_zalo'] ?? null,
            'floating_facebook' => $settings['floating_facebook'] ?? null,
            'floating_chat' => $settings['floating_chat'] ?? null,
            'show_floating_cart' => $settings['show_floating_cart'] ?? '0',
            'show_floating_zalo' => $settings['show_floating_zalo'] ?? '0',
            'show_floating_phone' => $settings['show_floating_phone'] ?? '0',
            'show_floating_chat' => $settings['show_floating_chat'] ?? '0',
            'show_floating_facebook' => $settings['show_floating_facebook'] ?? '0',
            'floating_cart' => $settings['floating_cart'] ?? '0',
            'floating_cart_badge' => $settings['floating_cart_badge'] ?? null,
            'show_floating_bar' => $settings['show_floating_bar'] ?? '0',
        ];
    }
}
