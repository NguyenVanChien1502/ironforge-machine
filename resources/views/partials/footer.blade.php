@php
    $settings = $settings ?? [];
@endphp
<footer class="bg-charcoal text-gray-300">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 py-16 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
        <div>
            <div class="mb-4 flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gold font-black text-charcoal">HN</span>
                <span class="text-lg font-bold text-white">Hồ Nam<span class="text-gold"> Landscape</span></span>
            </div>
            <p class="text-sm leading-relaxed text-gray-400">
                Thi công, chăm sóc và phát triển cảnh quan cho resort, khu công nghiệp, công viên và công trình công cộng theo tiêu chuẩn bền vững.
            </p>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Liên kết nhanh</h4>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-gold">Trang chủ</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-gold">Dự án</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-gold">Tin tức</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-gold">Giới thiệu</a></li>
                <li><a href="{{ route('home') }}#contact" class="hover:text-gold">Liên hệ</a></li>
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Danh mục</h4>
            <ul class="space-y-3 text-sm">
                @foreach(\App\Models\Category::limit(4)->get() as $category)
                    <li><a href="{{ route('products.index', ['category' => $category->id]) }}" class="hover:text-gold">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Liên hệ</h4>
            <ul class="space-y-3 text-sm text-gray-400">
                <li>Trụ sở: Phước Thắng, TP. Vũng Tàu / TP.HCM</li>
                <li>Hotline: {{ $settings['floating_phone'] ?? '064.358.6494' }}</li>
                <li>Fax: 0254.3.586.495</li>
                <li>Email: cayxanhhonam.vt@gmail.com</li>
            </ul>
            <div class="mt-5 flex gap-3">
                @foreach([
                    ['label' => 'fb', 'url' => $settings['floating_facebook'] ?? '#'],
                    ['label' => 'zl', 'url' => $settings['floating_zalo'] ?? '#'],
                    ['label' => 'mail', 'url' => $settings['floating_chat'] ?? '#'],
                ] as $social)
                    <a href="{{ $social['url'] }}" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/20 text-[10px] font-bold uppercase text-gray-300 transition hover:border-gold hover:text-gold">
                        {{ $social['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 py-6 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} Công Ty TNHH Hồ Nam. All rights reserved.
    </div>
</footer>
