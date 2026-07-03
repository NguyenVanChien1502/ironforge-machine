<x-admin-layout title="News & Articles">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">Manage news articles and announcements</p>
        <a href="{{ route('admin.posts.create') }}" class="btn-secondary">+ New Article</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-6 py-3">Article</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Published Date</th>
                    <th class="px-6 py-3 text-right">Actions</th>
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
                                    <p class="text-xs text-gray-400 font-mono">{{ $post->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($post->is_published)
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/10">Published</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $post->published_at ? $post->published_at->format('Y-m-d H:i') : '—' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="mr-4 font-medium text-charcoal hover:text-gold">Edit</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Delete this article?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">No articles yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
</x-admin-layout>
