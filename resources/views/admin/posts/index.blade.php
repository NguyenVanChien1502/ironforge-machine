<x-admin-layout title="Bài viết">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">Quản lý tin tức và bài chia sẻ</p>
        <a href="{{ route('admin.posts.create') }}" class="btn-secondary">+ Thêm bài viết</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-6 py-3">Bài viết</th>
                    <th class="px-6 py-3">Trạng thái</th>
                    <th class="px-6 py-3">Ngày đăng</th>
                    <th class="px-6 py-3 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-none overflow-hidden rounded bg-gray-100">
                                    <img src="{{ $post->image ? Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?q=80&w=100' }}" alt="" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium text-charcoal">{{ $post->title }}</p>
                                    <p class="font-mono text-xs text-gray-400">{{ $post->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($post->is_published)
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/10">Đã đăng</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10">Bản nháp</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $post->published_at ? $post->published_at->format('Y-m-d H:i') : '—' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="mr-4 font-medium text-charcoal hover:text-gold">Sửa</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này không?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">Chưa có bài viết nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
</x-admin-layout>
