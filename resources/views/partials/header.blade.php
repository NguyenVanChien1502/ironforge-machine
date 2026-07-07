@php
    $currentLocale = app()->getLocale();
    $siteName = $settings['site_name'] ?? 'Hồ Nam Landscape';
    $siteLogo = $settings['site_logo'] ?? null;
@endphp

<header x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-charcoal/90 backdrop-blur-lg shadow-lg' : 'bg-charcoal/50 backdrop-blur-md'"
        class="sticky top-0 z-50 transition-all duration-300">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            @if($siteLogo)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($siteLogo) }}" alt="{{ $siteName }}" class="h-10 w-10 rounded-md object-contain">
            @else
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gold font-black text-charcoal">HN</span>
            @endif
            <span class="text-lg font-bold tracking-wide text-white">{{ $siteName }}</span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">{{ __('navigation.home') }}</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">{{ __('navigation.products') }}</a>
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">{{ __('navigation.news') }}</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">{{ __('navigation.about') }}</a>
            <a href="{{ route('home') }}#contact" class="text-sm font-medium text-gray-200 transition hover:text-gold">{{ __('navigation.contact') }}</a>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <div class="notranslate flex rounded-md border border-white/15 bg-white/10 p-1 text-xs font-bold text-white">
                <a href="{{ route('locale.switch', 'vi') }}" class="rounded px-2 py-1 transition {{ $currentLocale === 'vi' ? 'bg-gold text-charcoal' : 'hover:bg-white/10' }}">VI</a>
                <a href="{{ route('locale.switch', 'en') }}" class="rounded px-2 py-1 transition {{ $currentLocale === 'en' ? 'bg-gold text-charcoal' : 'hover:bg-white/10' }}">EN</a>
            </div>
            <a href="{{ route('home') }}#contact" class="btn-primary">{{ __('navigation.quote') }}</a>
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
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-200 hover:text-gold">{{ __('navigation.home') }}</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-200 hover:text-gold">{{ __('navigation.products') }}</a>
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-gray-200 hover:text-gold">{{ __('navigation.news') }}</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-gray-200 hover:text-gold">{{ __('navigation.about') }}</a>
            <a href="{{ route('home') }}#contact" class="text-sm font-medium text-gray-200 hover:text-gold">{{ __('navigation.contact') }}</a>
            <div class="notranslate flex w-fit rounded-md border border-white/15 bg-white/10 p-1 text-xs font-bold text-white">
                <a href="{{ route('locale.switch', 'vi') }}" class="rounded px-2 py-1 transition {{ $currentLocale === 'vi' ? 'bg-gold text-charcoal' : 'hover:bg-white/10' }}">VI</a>
                <a href="{{ route('locale.switch', 'en') }}" class="rounded px-2 py-1 transition {{ $currentLocale === 'en' ? 'bg-gold text-charcoal' : 'hover:bg-white/10' }}">EN</a>
            </div>
            <a href="{{ route('home') }}#contact" class="btn-primary w-full">{{ __('navigation.quote') }}</a>
        </div>
    </div>
</header>
