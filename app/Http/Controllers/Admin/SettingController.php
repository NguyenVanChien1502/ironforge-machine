<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Schema::hasTable('settings')
            ? Setting::pluck('value', 'key')->all()
            : [];

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('settings')) {
            return redirect()
                ->route('admin.settings.edit')
                ->with('error', 'Bảng settings chưa tồn tại. Hãy chạy migrate trước khi cấu hình thanh nổi.');
        }

        $validated = $request->validate([
            'floating_phone' => ['nullable', 'string', 'max:50'],
            'floating_zalo' => ['nullable', 'string', 'max:255'],
            'floating_facebook' => ['nullable', 'string', 'max:255'],
            'floating_chat' => ['nullable', 'string', 'max:255'],
            'floating_cart_badge' => ['nullable', 'string', 'max:20'],
            'show_floating_cart' => ['nullable'],
            'show_floating_zalo' => ['nullable'],
            'show_floating_phone' => ['nullable'],
            'show_floating_chat' => ['nullable'],
            'show_floating_facebook' => ['nullable'],
            'show_floating_bar' => ['nullable'],
        ]);

        $payload = [
            'floating_phone' => $validated['floating_phone'] ?? null,
            'floating_zalo' => $validated['floating_zalo'] ?? null,
            'floating_facebook' => $validated['floating_facebook'] ?? null,
            'floating_chat' => $validated['floating_chat'] ?? null,
            'floating_cart_badge' => $validated['floating_cart_badge'] ?? null,
            'show_floating_cart' => $request->boolean('show_floating_cart') ? '1' : '0',
            'show_floating_zalo' => $request->boolean('show_floating_zalo') ? '1' : '0',
            'show_floating_phone' => $request->boolean('show_floating_phone') ? '1' : '0',
            'show_floating_chat' => $request->boolean('show_floating_chat') ? '1' : '0',
            'show_floating_facebook' => $request->boolean('show_floating_facebook') ? '1' : '0',
            'floating_cart' => $request->boolean('floating_cart') ? '1' : '0',
            'show_floating_bar' => $request->boolean('show_floating_bar') ? '1' : '0',
        ];

        foreach ($payload as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Cài đặt thanh liên hệ nổi đã được cập nhật.');
    }
}
