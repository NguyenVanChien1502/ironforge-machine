<x-app-layout>
    <x-slot:title>{{ $post->title }} — IronForge Machinery</x-slot:title>
    <x-slot:description>{{ $post->excerpt ?? Str::limit(strip_tags($post->body), 150) }}</x-slot:description>

    <article class="bg-white py-16 sm:py-24">
        <div class="mx-auto max-w-3xl px-6 lg:px-8">
            {{-- META INFO --}}
            <div class="flex items-center gap-3 text-sm text-gold font-semibold uppercase tracking-wide mb-4">
                <span>Newsroom</span>
                <span>•</span>
                <span class="text-gray-500 font-normal normal-case">{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</span>
            </div>

            {{-- TITLE --}}
            <h1 class="text-3xl font-extrabold tracking-tight text-charcoal sm:text-5xl leading-tight">
                {{ $post->title }}
            </h1>

            {{-- EXCERPT --}}
            @if($post->excerpt)
                <p class="mt-6 text-xl text-gray-500 italic leading-relaxed border-l-4 border-gold pl-6">
                    {{ $post->excerpt }}
                </p>
            @endif

            {{-- FEATURED IMAGE --}}
            <div class="my-10 overflow-hidden rounded-2xl bg-gray-100 shadow-premium">
                <img src="{{ $post->image ? Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?q=80&w=1200' }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-auto max-h-[450px] object-cover">
            </div>

            {{-- BODY CONTENT --}}
            <div class="prose prose-lg prose-gold text-gray-700 leading-relaxed space-y-6">
                {!! nl2br(e($post->body)) !!}
            </div>

            <div class="mt-16 border-t border-gray-100 pt-8">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-charcoal hover:text-gold">
                    &larr; Back to all news
                </a>
            </div>
        </div>
    </article>

    {{-- RELATED ARTICLES SECTION --}}
    @if($relatedPosts->count() > 0)
        <section class="bg-gray-50 py-16 border-t border-gray-100">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="text-2xl font-extrabold text-charcoal mb-10">Related Articles</h2>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedPosts as $related)
                        <div class="card overflow-hidden bg-white p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-xs text-gray-400">{{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}</span>
                                <h3 class="mt-2 text-lg font-bold text-charcoal hover:text-gold transition">
                                    <a href="{{ route('news.show', $related) }}">{{ $related->title }}</a>
                                </h3>
                                <p class="mt-3 text-sm text-gray-500 line-clamp-2">{{ $related->excerpt ?? Str::limit(strip_tags($related->body), 100) }}</p>
                            </div>
                            <a href="{{ route('news.show', $related) }}" class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-charcoal hover:text-gold">
                                Read More &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-app-layout>
