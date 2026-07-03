<x-admin-layout title="Đánh giá">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">Quản lý đánh giá và phản hồi của khách hàng</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-secondary">+ Thêm đánh giá</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-6 py-3">Khách hàng</th>
                    <th class="px-6 py-3">Sao</th>
                    <th class="px-6 py-3">Nội dung</th>
                    <th class="px-6 py-3">Trạng thái</th>
                    <th class="px-6 py-3 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-none overflow-hidden rounded-full bg-gray-100">
                                    <img src="{{ $testimonial->avatar_url }}" alt="" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium text-charcoal">{{ $testimonial->customer_name }}</p>
                                    <p class="text-xs text-gray-400">{{ $testimonial->company ?? 'Chưa có đơn vị' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex text-gold">
                                @for($i = 0; $i < 5; $i++)
                                    {{ $i < $testimonial->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                        </td>
                        <td class="max-w-xs px-6 py-4 text-gray-500 truncate">
                            {{ $testimonial->content }}
                        </td>
                        <td class="px-6 py-4">
                            @if($testimonial->is_visible)
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/10">Hiển thị</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10">Ẩn</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="mr-4 font-medium text-charcoal hover:text-gold">Sửa</a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này không?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Chưa có đánh giá nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $testimonials->links() }}</div>
</x-admin-layout>
