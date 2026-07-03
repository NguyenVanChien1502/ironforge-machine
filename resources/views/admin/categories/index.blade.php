<x-admin-layout title="Categories">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">Manage product categories</p>
        <a href="{{ route('admin.categories.create') }}" class="btn-secondary">+ New Category</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Slug</th>
                    <th class="px-6 py-3">Products</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 font-medium text-charcoal">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->products_count }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="mr-4 font-medium text-charcoal hover:text-gold">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Delete this category?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">No categories yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $categories->links() }}</div>
</x-admin-layout>
