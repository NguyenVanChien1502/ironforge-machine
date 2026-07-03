<x-app-layout>
    <x-slot:title>Tin tức & Chia sẻ — Công Ty TNHH Hồ Nam</x-slot:title>
    <x-slot:description>Cập nhật tin tức dự án, kinh nghiệm chăm sóc cây xanh và những chia sẻ chuyên môn từ đội ngũ Hồ Nam.</x-slot:description>

    <section class="relative overflow-hidden bg-charcoal py-20 text-white">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2000')] bg-cover bg-center opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/80 to-charcoal/40"></div>
        <div class="relative mx-auto max-w-7xl px-6 text-center lg:px-8">
            <span class="mb-3 block text-xs font-semibold uppercase tracking-[0.3em] text-gold">Hồ Nam Newsroom</span>
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl text-white">
                Tin tức dự án và góc chia sẻ chuyên môn
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base text-gray-300">
                Khám phá các bài viết về cảnh quan, kỹ thuật chăm sóc cây xanh và cập nhật từ những dự án mà Hồ Nam đang triển khai.
            </p>
        </div>
    </section>

    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        <article class="card flex h-full flex-col justify-between overflow-hidden bg-white">
                            <div>
                                <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                                    <img src="{{ $post->image ? Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=600' }}"
                                         alt="{{ $post->title }}"
                                         class="h-full w-full object-cover transition duration-500 hover:scale-105">
                                </div>
                                <div class="p-6">
                                    <div class="mb-3 flex items-center gap-3 text-xs text-gray-400">
                                        <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span class="font-semibold uppercase text-gold">Chia sẻ</span>
                                    </div>
                                    <h3 class="mb-3 text-xl font-bold text-charcoal leading-snug hover:text-gold transition">
                                        <a href="{{ route('news.show', $post) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-500 line-clamp-3">
                                        {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 150) }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-6 pb-6 pt-2">
                                <a href="{{ route('news.show', $post) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-charcoal hover:text-gold">
                                    Đọc bài viết &rarr;
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="py-20 text-center">
                    <h3 class="text-lg font-bold text-charcoal mt-4">Chưa có bài viết nào</h3>
                    <p class="mt-2 text-sm text-gray-500">Hãy quay lại sau để xem những cập nhật mới từ Hồ Nam.</p>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
