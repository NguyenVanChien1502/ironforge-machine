<x-admin-layout title="Cài đặt thanh nổi">
    <div class="mx-auto max-w-4xl space-y-8">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
            <h2 class="text-lg font-bold text-charcoal">Cấu hình thanh liên hệ nổi</h2>
            <p class="mt-2 text-sm text-gray-500">
                Cập nhật các liên kết và công tắc hiển thị cho thanh nổi ở cạnh phải website. Thay đổi được áp dụng ngay sau khi lưu.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="label">Hotline</label>
                    <input type="text" name="floating_phone" value="{{ old('floating_phone', $settings['floating_phone'] ?? '') }}" class="input">
                    @error('floating_phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label">Link Zalo</label>
                    <input type="text" name="floating_zalo" value="{{ old('floating_zalo', $settings['floating_zalo'] ?? '') }}" class="input">
                    @error('floating_zalo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label">Link Facebook</label>
                    <input type="text" name="floating_facebook" value="{{ old('floating_facebook', $settings['floating_facebook'] ?? '') }}" class="input">
                    @error('floating_facebook') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label">Link tư vấn / hỏi đáp</label>
                    <input type="text" name="floating_chat" value="{{ old('floating_chat', $settings['floating_chat'] ?? '') }}" class="input">
                    @error('floating_chat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label">Badge giỏ hàng</label>
                    <input type="text" name="floating_cart_badge" value="{{ old('floating_cart_badge', $settings['floating_cart_badge'] ?? '') }}" class="input" placeholder="Ví dụ: 1">
                    @error('floating_cart_badge') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_bar" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_bar'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị toàn bộ thanh nổi</span>
                        <span class="block text-sm text-gray-500">Tắt mục này để ẩn hoàn toàn thanh liên hệ bên phải.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="floating_cart" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['floating_cart'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút giỏ hàng</span>
                        <span class="block text-sm text-gray-500">Hiển thị icon giỏ hàng kèm badge số lượng.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_zalo" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_zalo'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút Zalo</span>
                        <span class="block text-sm text-gray-500">Mở link chat Zalo đã cấu hình.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_phone" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_phone'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút hotline</span>
                        <span class="block text-sm text-gray-500">Nhấn để gọi trực tiếp số điện thoại.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_chat" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_chat'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút tư vấn</span>
                        <span class="block text-sm text-gray-500">Mở email hoặc link tư vấn nhanh.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_facebook" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_facebook'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút Facebook</span>
                        <span class="block text-sm text-gray-500">Mở trang Facebook doanh nghiệp.</span>
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Quay lại
                </a>
                <button type="submit" class="btn-primary">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
