<x-admin-layout title="Dashboard">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach([
            ['label' => 'Total Products', 'value' => $stats['products']],
            ['label' => 'Total Categories', 'value' => $stats['categories']],
            ['label' => 'Total Inquiries', 'value' => $stats['inquiries']],
            ['label' => 'Unread Inquiries', 'value' => $stats['unread_inquiries']],
        ] as $card)
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <p class="text-sm font-medium text-gray-500">{{ $card['label'] }}</p>
                <p class="mt-2 text-3xl font-extrabold text-charcoal">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <h2 class="mb-5 text-lg font-bold text-charcoal">Recent Inquiries</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-xs uppercase tracking-wide text-gray-500">
                        <th class="pb-3">Name</th>
                        <th class="pb-3">Contact</th>
                        <th class="pb-3">Product</th>
                        <th class="pb-3">Date</th>
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
                        <tr><td colspan="4" class="py-6 text-center text-gray-400">No inquiries yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
