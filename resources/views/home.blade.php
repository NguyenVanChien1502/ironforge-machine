<x-app-layout>
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-charcoal">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=2000')] bg-cover bg-center opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/80 to-charcoal/40"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-32 lg:px-8 lg:py-44">
            <p class="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-gold">Engineered for Excellence</p>
            <h1 class="max-w-2xl text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-6xl">
                Premium Heavy Machinery Built to Outperform
            </h1>
            <p class="mt-6 max-w-xl text-lg text-gray-300">
                From excavators to cranes, IronForge delivers industrial-grade equipment engineered for durability, power, and precision on the world's toughest job sites.
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('products.index') }}" class="btn-primary">View Products</a>
                <a href="#contact" class="btn-outline">Contact Us</a>
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="border-b border-gray-100 bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 px-6 py-16 sm:grid-cols-4 lg:px-8">
            @foreach([
                ['value' => '25+', 'label' => 'Years of Experience'],
                ['value' => '40+', 'label' => 'Countries Served'],
                ['value' => '3,000+', 'label' => 'Happy Clients'],
                ['value' => '150+', 'label' => 'Equipment Models'],
            ] as $stat)
                <div class="text-center">
                    <p class="text-4xl font-extrabold text-charcoal">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-sm font-medium uppercase tracking-wide text-gray-500">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- PRODUCT SHOWCASE --}}
    <section class="bg-gray-50 py-24" x-data="{ activeCategory: 'all' }">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-14 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Our Fleet</p>
                    <h2 class="section-heading">Featured Equipment</h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-charcoal hover:text-gold">View all products &rarr;</a>
            </div>

            <div class="mb-10 flex flex-wrap gap-3">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-charcoal text-white' : 'bg-white text-charcoal ring-1 ring-gray-200'"
                        class="rounded-full px-5 py-2 text-sm font-medium transition">All</button>
                @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->slug }}'"
                            :class="activeCategory === '{{ $category->slug }}' ? 'bg-charcoal text-white' : 'bg-white text-charcoal ring-1 ring-gray-200'"
                            class="rounded-full px-5 py-2 text-sm font-medium transition">{{ $category->name }}</button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($allProducts as $product)
                    <div x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug }}'" class="card overflow-hidden">
                        <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                            @if($product->is_featured)
                                <span class="absolute left-4 top-4 rounded-full bg-gold px-3 py-1 text-xs font-bold uppercase text-charcoal">Featured</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gold">{{ $product->category->name }}</p>
                            <h3 class="mt-1 text-lg font-bold text-charcoal">{{ $product->title }}</h3>
                            <div class="mt-4 grid grid-cols-2 gap-2 text-xs text-gray-500">
                                @foreach(array_slice($product->specifications ?? [], 0, 2) as $spec)
                                    <div>
                                        <p class="font-semibold text-charcoal">{{ $spec['value'] }}</p>
                                        <p>{{ $spec['key'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('products.show', $product) }}" class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-charcoal hover:text-gold">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No products available yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ABOUT / VALUES --}}
    <section id="about" class="bg-white py-24">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-16 px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Why IronForge</p>
                <h2 class="section-heading">Precision Engineering Meets Industrial Power</h2>
                <p class="mt-6 text-gray-600">
                    We partner with construction, mining, and infrastructure teams worldwide to deliver machinery that performs reliably in the harshest conditions — backed by responsive service and genuine parts.
                </p>
                <ul class="mt-8 space-y-4">
                    @foreach(['Rigorous quality control on every unit', 'Global parts & service network', 'Flexible financing and leasing options'] as $point)
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="flex h-6 w-6 flex-none items-center justify-center rounded-full bg-gold/20 text-gold">✓</span>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="overflow-hidden rounded-2xl shadow-premium">
                <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?q=80&w=1200" alt="Heavy machinery at work" class="h-full w-full object-cover">
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="bg-gray-50 py-24 border-y border-gray-100">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Testimonials</p>
                <h2 class="section-heading">What Our Clients Say</h2>
                <p class="mt-4 text-gray-500 max-w-lg mx-auto">Read reviews from construction and infrastructure leaders who trust IronForge Machinery.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($testimonials as $testimonial)
                    <div class="card p-8 bg-white border border-gray-100 flex flex-col justify-between">
                        <div>
                            {{-- Stars --}}
                            <div class="flex gap-1 text-gold mb-4 text-lg">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $testimonial->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <p class="text-gray-600 italic text-sm leading-relaxed">
                                "{{ $testimonial->content }}"
                            </p>
                        </div>
                        <div class="mt-6 flex items-center gap-4 border-t border-gray-100 pt-4">
                            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->customer_name }}" class="h-10 w-10 rounded-full object-cover">
                            <div>
                                <h4 class="text-sm font-bold text-charcoal">{{ $testimonial->customer_name }}</h4>
                                <p class="text-xs text-gray-400">{{ $testimonial->company }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No reviews yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- LATEST NEWS --}}
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-14 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Newsroom</p>
                    <h2 class="section-heading">Latest Insights</h2>
                </div>
                <a href="{{ route('news.index') }}" class="text-sm font-semibold text-charcoal hover:text-gold">View all articles &rarr;</a>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($latestPosts as $post)
                    <div class="card overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="h-48 w-full overflow-hidden bg-gray-100">
                                <img src="{{ $post->image ? Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?q=80&w=600' }}" 
                                     alt="{{ $post->title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <p class="text-xs text-gray-400">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</p>
                                <h3 class="mt-2 text-lg font-bold text-charcoal leading-snug hover:text-gold transition">
                                    <a href="{{ route('news.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="mt-3 text-xs text-gray-500 line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->body), 100) }}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('news.show', $post) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-charcoal hover:text-gold">
                                Read Article &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No articles available.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CONTACT --}}
    <section id="contact" class="bg-charcoal py-24">
        <div class="mx-auto max-w-3xl px-6 lg:px-8">
            <div class="text-center">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Get In Touch</p>
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Request a Quote</h2>
                <p class="mt-4 text-gray-400">Tell us about your project and our team will get back to you within 24 hours.</p>
            </div>

            @if(session('success'))
                <div class="mt-8 rounded-md bg-green-500/10 px-4 py-3 text-sm text-green-400 ring-1 ring-green-500/30">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('inquiries.store') }}" x-data="{ submitting: false }" @submit="submitting = true" class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2">
                @csrf
                <div>
                    <label class="label !text-gray-300">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="input">
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label !text-gray-300">Phone</label>
                    <input type="text" name="phone" required value="{{ old('phone') }}" class="input">
                    @error('phone') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="input">
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Product of Interest</label>
                    <select name="product_id" class="input">
                        <option value="">Select a product (optional)</option>
                        @foreach(\App\Models\Product::orderBy('title')->get() as $product)
                            <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>{{ $product->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Message</label>
                    <textarea name="message" rows="4" class="input">{{ old('message') }}</textarea>
                    @error('message') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" :disabled="submitting" class="btn-primary w-full disabled:opacity-60">
                        <span x-show="!submitting">Send Inquiry</span>
                        <span x-show="submitting">Sending...</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
