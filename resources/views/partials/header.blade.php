<header x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-charcoal/80 backdrop-blur-lg shadow-lg' : 'bg-charcoal/40 backdrop-blur-md'"
        class="sticky top-0 z-50 transition-all duration-300">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gold font-black text-charcoal">IF</span>
            <span class="text-lg font-bold tracking-wide text-white">IronForge<span class="text-gold">.</span></span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">Home</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">Products</a>
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">News</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-gray-200 transition hover:text-gold">About</a>
            <a href="{{ route('home') }}#contact" class="text-sm font-medium text-gray-200 transition hover:text-gold">Contact</a>
        </nav>

        <div class="hidden lg:block">
            <a href="{{ route('home') }}#contact" class="btn-primary">Request a Quote</a>
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
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-200 hover:text-gold">Home</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-200 hover:text-gold">Products</a>
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-gray-200 hover:text-gold">News</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-gray-200 hover:text-gold">About</a>
            <a href="{{ route('home') }}#contact" class="text-sm font-medium text-gray-200 hover:text-gold">Contact</a>
            <a href="{{ route('home') }}#contact" class="btn-primary w-full">Request a Quote</a>
        </div>
    </div>
</header>
