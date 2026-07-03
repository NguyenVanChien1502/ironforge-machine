<x-app-layout>
    <x-slot:title>News & Industry Insights — IronForge Machinery</x-slot:title>
    <x-slot:description>Stay updated with the latest mechanical innovations, company announcements, and equipment safety articles from IronForge.</x-slot:description>

    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-charcoal py-20 text-white">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1541625602330-2277a4c46182?q=80&w=2000')] bg-cover bg-center opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/80 to-charcoal/40"></div>
        <div class="relative mx-auto max-w-7xl px-6 text-center lg:px-8">
            <span class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-gold block">IronForge Newsroom</span>
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl text-white">
                Articles & Industry Insights
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base text-gray-300">
                Explore tech briefs, engineering milestones, and safety best practices curated by our technical team.
            </p>
        </div>
    </section>

    {{-- ARTICLES GRID --}}
    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        <article class="card overflow-hidden bg-white flex flex-col justify-between h-full">
                            <div>
                                <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                                    <img src="{{ $post->image ? Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?q=80&w=600' }}" 
                                         alt="{{ $post->title }}" 
                                         class="h-full w-full object-cover transition duration-500 hover:scale-105">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
                                        <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span class="text-gold font-semibold uppercase">Insights</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-charcoal leading-snug hover:text-gold transition mb-3">
                                        <a href="{{ route('news.show', $post) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-500 line-clamp-3">
                                        {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 150) }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-6 pb-6 pt-2">
                                <a href="{{ route('news.show', $post) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-charcoal hover:text-gold">
                                    Read Article &rarr;
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <div class="mt-16">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <span class="text-4xl">📰</span>
                    <h3 class="text-lg font-bold text-charcoal mt-4">No articles found</h3>
                    <p class="text-sm text-gray-500 mt-2">Check back soon for new articles and announcements.</p>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
