@props(['title' => 'Admin Dashboard'])
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — Hồ Nam Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-charcoal antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-40 w-64 transform bg-charcoal text-white transition-transform duration-200 lg:static lg:translate-x-0">
            <div class="flex items-center gap-3 border-b border-white/10 px-6 py-5">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gold font-black text-charcoal">HN</span>
                <span class="text-lg font-bold">Hồ Nam<span class="text-gold"> Admin</span></span>
            </div>
            <nav class="mt-6 space-y-1 px-4">
                @php
                    $links = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                        ['route' => 'admin.categories.index', 'label' => 'Danh mục'],
                        ['route' => 'admin.products.index', 'label' => 'Dự án'],
                        ['route' => 'admin.posts.index', 'label' => 'Tin tức'],
                        ['route' => 'admin.testimonials.index', 'label' => 'Đánh giá'],
                    ['route' => 'admin.settings.edit', 'label' => 'Cài đặt thanh nổi'],
                    ];
                @endphp
                @foreach($links as $link)
                    <a href="{{ route($link['route']) }}"
                       class="block rounded-md px-4 py-2.5 text-sm font-medium transition {{ request()->routeIs($link['route'].'*') ? 'bg-gold text-charcoal' : 'text-gray-300 hover:bg-white/10' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="absolute bottom-0 w-full border-t border-white/10 p-4">
                <a href="{{ route('home') }}" target="_blank" class="mb-2 block text-xs text-gray-400 hover:text-gold">Xem site &rarr;</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full rounded-md bg-white/10 px-4 py-2 text-sm font-medium text-white hover:bg-white/20">Đăng xuất</button>
                </form>
            </div>
        </aside>

        <div class="flex-1 lg:pl-0">
            <header class="flex items-center justify-between border-b border-gray-200 bg-white px-6 py-4 lg:px-8">
                <button @click="sidebarOpen = !sidebarOpen" class="text-charcoal lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-lg font-bold text-charcoal">{{ $title }}</h1>
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gold/20 text-sm font-bold text-gold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </header>

            <main class="px-6 py-8 lg:px-8">
                @if(session('success'))
                    <div class="mb-6 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700 ring-1 ring-green-200">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
