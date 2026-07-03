<x-admin-layout title="Danh mục">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">Quản lý các danh mục dự án</p>
        <a href="{{ route('admin.categories.create') }}" class="btn-secondary">+ Thêm danh mục</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-6 py-3">Tên</th>
                    <th class="px-6 py-3">Đường dẫn</th>
                    <th class="px-6 py-3">Số dự án</th>
                    <th class="px-6 py-3 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 font-medium text-charcoal">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->products_count }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="mr-4 font-medium text-charcoal hover:text-gold">Sửa</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">Chưa có danh mục nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $categories->links() }}</div>
</x-admin-layout>
