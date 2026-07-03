<x-app-layout :title="$product->title . ' — IronForge Machinery'">
    <section class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <nav class="mb-8 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-gold">Home</a> /
                <a href="{{ route('products.index') }}" class="hover:text-gold">Products</a> /
                <span class="text-charcoal">{{ $product->title }}</span>
            </nav>

            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                {{-- IMAGE GALLERY --}}
                <div x-data="{ active: 0, images: ['{{ $product->image_url }}'] }">
                    <div class="overflow-hidden rounded-2xl bg-white shadow-premium ring-1 ring-gray-100">
                        <img :src="images[active]" alt="{{ $product->title }}" class="h-96 w-full object-cover">
                    </div>
                    <div class="mt-4 flex gap-3">
                        <template x-for="(img, i) in images" :key="i">
                            <button @click="active = i" :class="active === i ? 'ring-2 ring-gold' : 'ring-1 ring-gray-200'" class="h-20 w-20 overflow-hidden rounded-lg">
                                <img :src="img" class="h-full w-full object-cover">
                            </button>
                        </template>
                    </div>
                </div>

                {{-- INFO --}}
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-gold">{{ $product->category->name }}</p>
                    <h1 class="mt-2 text-3xl font-extrabold text-charcoal sm:text-4xl">{{ $product->title }}</h1>
                    @if($product->model_number)
                        <p class="mt-2 text-sm text-gray-500">Model No: {{ $product->model_number }}</p>
                    @endif

                    <div class="prose prose-sm mt-6 max-w-none text-gray-600">
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    @if(!empty($product->specifications))
                        <div class="mt-8 overflow-hidden rounded-xl ring-1 ring-gray-200">
                            <table class="w-full text-sm">
                                <tbody>
                                    @foreach($product->specifications as $i => $spec)
                                        <tr class="{{ $i % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                            <td class="w-1/2 px-5 py-3 font-medium text-gray-500">{{ $spec['key'] }}</td>
                                            <td class="px-5 py-3 font-semibold text-charcoal">{{ $spec['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <a href="#inquire" class="btn-secondary mt-8">Request a Quote for this Unit</a>
                </div>
            </div>
        </div>
    </section>

    {{-- INQUIRY FORM --}}
    <section id="inquire" class="bg-charcoal py-20">
        <div class="mx-auto max-w-2xl px-6 lg:px-8">
            <h2 class="text-center text-2xl font-extrabold text-white">Inquire About {{ $product->title }}</h2>

            @if(session('success'))
                <div class="mt-6 rounded-md bg-green-500/10 px-4 py-3 text-sm text-green-400 ring-1 ring-green-500/30">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('inquiries.store') }}" class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div>
                    <label class="label !text-gray-300">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="input">
                </div>
                <div>
                    <label class="label !text-gray-300">Phone</label>
                    <input type="text" name="phone" required value="{{ old('phone') }}" class="input">
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="input">
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Message</label>
                    <textarea name="message" rows="4" class="input"></textarea>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="btn-primary w-full">Send Inquiry</button>
                </div>
            </form>
        </div>
    </section>

    {{-- RELATED --}}
    @if($relatedProducts->isNotEmpty())
        <section class="bg-gray-50 py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="section-heading mb-10">Related Equipment</h2>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
                    @foreach($relatedProducts as $related)
                        <div class="card overflow-hidden">
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="h-48 w-full object-cover">
                            <div class="p-5">
                                <h3 class="font-bold text-charcoal">{{ $related->title }}</h3>
                                <a href="{{ route('products.show', $related) }}" class="mt-3 inline-block text-sm font-semibold text-charcoal hover:text-gold">View Details &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-app-layout>
