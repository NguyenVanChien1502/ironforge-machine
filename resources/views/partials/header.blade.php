<header x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-charcoal/90 backdrop-blur-lg shadow-lg' : 'bg-charcoal/50 backdrop-blur-md'"
        class="sticky top-0 z-50 transition-all duration-300">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gold font-black text-charcoal">HN</span>
            <span class="text-lg font-bold tracking-wide text-white">Hồ Nam<span class="text-gold"> Landscape</span></span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">Trang chủ</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">Dự án</a>
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">Tin tức</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">Giới thiệu</a>
            <a href="{{ route('home') }}#contact" class="text-sm font-medium text-gray-200 transition hover:text-gold">Liên hệ</a>
        </nav>

        <div class="hidden lg:block">
            <a href="{{ route('home') }}#contact" class="btn-primary">Nhận báo giá</a>
        </div>

        <button @click="open = !open" class="text-white lg:hidden" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition class="border-t border-white/10 bg-charcoal px-6 py-4 lg:hidden">
        <div class="flex flex-col gap-4">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-200 hover:text-gold">Trang chủ</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-200 hover:text-gold">Dự án</a>
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-gray-200 hover:text-gold">Tin tức</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-gray-200 hover:text-gold">Giới thiệu</a>
            <a href="{{ route('home') }}#contact" class="text-sm font-medium text-gray-200 hover:text-gold">Liên hệ</a>
            <a href="{{ route('home') }}#contact" class="btn-primary w-full">Nhận báo giá</a>
        </div>
    </div>
</header>
