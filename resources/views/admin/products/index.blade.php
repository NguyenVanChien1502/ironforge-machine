<x-admin-layout title="Dự án">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">Quản lý danh mục dự án và dịch vụ</p>
        <a href="{{ route('admin.products.create') }}" class="btn-secondary">+ Thêm dự án</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-6 py-3">Dự án</th>
                    <th class="px-6 py-3">Danh mục</th>
                    <th class="px-6 py-3">Mã dự án</th>
                    <th class="px-6 py-3">Tiêu biểu</th>
                    <th class="px-6 py-3 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr>
                        <td class="flex items-center gap-3 px-6 py-4">
                            <img src="{{ $product->image_url }}" class="h-10 w-10 rounded-md object-cover" alt="{{ $product->title }}">
                            <span class="font-medium text-charcoal">{{ $product->title }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $product->model_number }}</td>
                        <td class="px-6 py-4">
                            @if($product->is_featured)
                                <span class="rounded-full bg-gold/20 px-3 py-1 text-xs font-semibold text-gold-dark">Có</span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="mr-4 font-medium text-charcoal hover:text-gold">Sửa</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa dự án này không?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Chưa có dự án nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
</x-admin-layout>
