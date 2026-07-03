<x-app-layout>
    <section class="border-b border-gray-100 bg-charcoal py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Dự án tiêu biểu</p>
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl">Danh mục dự án và dịch vụ cảnh quan</h1>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-10 flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}"
                   class="rounded-full px-5 py-2 text-sm font-medium transition {{ request('category') ? 'bg-white text-charcoal ring-1 ring-gray-200' : 'bg-charcoal text-white' }}">Tất cả</a>
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}"
                       class="rounded-full px-5 py-2 text-sm font-medium transition {{ (int) request('category') === $category->id ? 'bg-charcoal text-white' : 'bg-white text-charcoal ring-1 ring-gray-200' }}">
                        {{ $category->name }} <span class="text-xs opacity-60">({{ $category->products_count }})</span>
                    </a>
                @endforeach
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($products as $product)
                    <div class="card overflow-hidden">
                        <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                            @if($product->is_featured)
                                <span class="absolute left-4 top-4 rounded-full bg-gold px-3 py-1 text-xs font-bold uppercase text-charcoal">Tiêu biểu</span>
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
                                Xem chi tiết &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Không có dự án nào trong danh mục này.</p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
