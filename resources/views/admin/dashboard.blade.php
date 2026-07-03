<x-admin-layout title="Bảng điều khiển">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach([
            ['label' => 'Tổng dự án', 'value' => $stats['products']],
            ['label' => 'Tổng danh mục', 'value' => $stats['categories']],
            ['label' => 'Tổng yêu cầu', 'value' => $stats['inquiries']],
            ['label' => 'Yêu cầu chưa đọc', 'value' => $stats['unread_inquiries']],
            ['label' => 'Tổng bài viết', 'value' => $stats['posts']],
            ['label' => 'Tổng đánh giá', 'value' => $stats['testimonials']],
        ] as $card)
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <p class="text-sm font-medium text-gray-500">{{ $card['label'] }}</p>
                <p class="mt-2 text-3xl font-extrabold text-charcoal">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <h2 class="mb-5 text-lg font-bold text-charcoal">Yêu cầu gần đây</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-xs uppercase tracking-wide text-gray-500">
                        <th class="pb-3">Họ tên</th>
                        <th class="pb-3">Liên hệ</th>
                        <th class="pb-3">Dự án</th>
                        <th class="pb-3">Thời gian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentInquiries as $inquiry)
                        <tr>
                            <td class="py-3 font-medium text-charcoal">{{ $inquiry->name }}</td>
                            <td class="py-3 text-gray-500">{{ $inquiry->phone }} &middot; {{ $inquiry->email }}</td>
                            <td class="py-3 text-gray-500">{{ $inquiry->product?->title ?? '—' }}</td>
                            <td class="py-3 text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-6 text-center text-gray-400">Chưa có yêu cầu nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
