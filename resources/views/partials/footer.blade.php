<footer class="bg-charcoal text-gray-300">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 py-16 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
        <div>
            <div class="mb-4 flex items-center gap-2">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gold font-black text-charcoal">IF</span>
                <span class="text-lg font-bold text-white">IronForge<span class="text-gold">.</span></span>
            </div>
            <p class="text-sm leading-relaxed text-gray-400">
                Engineering trusted heavy machinery for construction, mining, and infrastructure projects around the globe.
            </p>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Quick Links</h4>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-gold">Home</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-gold">Products</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-gold">News</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-gold">About Us</a></li>
                <li><a href="{{ route('home') }}#contact" class="hover:text-gold">Contact</a></li>
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Categories</h4>
            <ul class="space-y-3 text-sm">
                @foreach(\App\Models\Category::limit(4)->get() as $category)
                    <li><a href="{{ route('products.index', ['category' => $category->id]) }}" class="hover:text-gold">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Contact</h4>
            <ul class="space-y-3 text-sm text-gray-400">
                <li>123 Industrial Ave, Metro City</li>
                <li>+1 (555) 123-4567</li>
                <li>sales@ironforge.example</li>
            </ul>
            <div class="mt-5 flex gap-3">
                @foreach(['facebook', 'linkedin', 'youtube', 'instagram'] as $social)
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/20 text-xs uppercase text-gray-300 transition hover:border-gold hover:text-gold">
                        {{ substr($social, 0, 2) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 py-6 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} IronForge Machinery. All rights reserved.
    </div>
</footer>
