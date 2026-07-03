<x-app-layout>
    <x-slot:title>About Us — IronForge Machinery</x-slot:title>
    <x-slot:description>Learn about the heritage, values, and engineering standards that make IronForge a trusted leader in heavy machinery.</x-slot:description>

    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-charcoal py-24 text-white">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2000')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/80 to-charcoal/40"></div>
        <div class="relative mx-auto max-w-7xl px-6 text-center lg:px-8">
            <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-gold animate-fade-in">Our Heritage</p>
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-6xl text-white">
                Shaping the World's Infrastructure
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-300">
                Since 2001, IronForge Machinery has engineered and distributed premium, heavy-duty industrial equipment built to conquer the most challenging terrains.
            </p>
        </div>
    </section>

    {{-- VISION, MISSION & STORY --}}
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 items-center">
                <div class="space-y-6">
                    <span class="text-xs font-semibold uppercase tracking-widest text-gold">Who We Are</span>
                    <h2 class="text-3xl font-extrabold tracking-tight text-charcoal sm:text-4xl">
                        Uncompromising Quality and Engineered Durability
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        What started as a small mechanical repair workshop in the early 2000s has evolved into a global powerhouse in the heavy machinery sector. Today, IronForge design offices and fabrication yards manufacture specialized crawler excavators, high-capacity wheel loaders, and site-ready cranes.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        We believe that heavy machinery must not only be powerful but intelligent. That is why our entire new fleet is integrated with advanced safety telemetry and low-emission hybrid systems to maximize productivity while respecting environmental parameters.
                    </p>
                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div class="border-l-4 border-gold pl-4">
                            <h4 class="text-xl font-bold text-charcoal">Global Standards</h4>
                            <p class="text-xs text-gray-500 mt-1">Full compliance with ISO 9001 quality audits.</p>
                        </div>
                        <div class="border-l-4 border-gold pl-4">
                            <h4 class="text-xl font-bold text-charcoal">24/7 Support</h4>
                            <p class="text-xs text-gray-500 mt-1">Responsive global parts delivery network.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 rounded-2xl bg-gradient-to-tr from-gold/10 to-gold/30 blur-lg"></div>
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=1200" alt="IronForge heavy fabrication yard" class="relative rounded-2xl shadow-premium object-cover w-full h-[450px]">
                </div>
            </div>
        </div>
    </section>

    {{-- OUR VALUES --}}
    <section class="bg-gray-50 py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-xs font-semibold uppercase tracking-widest text-gold">Core Values</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-charcoal sm:text-4xl mt-2">The Principles That Guide Us</h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto">Every weld, every transaction, and every customer service call is shaped by our three core pillars.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach([
                    [
                        'title' => 'Relentless Durability',
                        'desc' => 'We engineer our machinery to withstand the harshest construction and mining conditions, ensuring constant uptime.',
                        'icon' => '⚙️'
                    ],
                    [
                        'title' => 'Customer-First Telemetry',
                        'desc' => 'We do not just sell machines; we provide comprehensive cloud telemetry and training to keep operators safe and efficient.',
                        'icon' => '🛡️'
                    ],
                    [
                        'title' => 'Eco-Conscious Power',
                        'desc' => 'We constantly iterate on hybrid drives and low-emissions exhaust designs to lead the industrial sector into a green future.',
                        'icon' => '🌱'
                    ]
                ] as $value)
                    <div class="card p-8 bg-white border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="h-12 w-12 rounded-xl bg-gold/10 flex items-center justify-center text-2xl mb-6">{{ $value['icon'] }}</div>
                            <h3 class="text-lg font-bold text-charcoal mb-3">{{ $value['title'] }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LEADERSHIP / TEAM --}}
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-xs font-semibold uppercase tracking-widest text-gold">Leadership Team</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-charcoal sm:text-4xl mt-2">Executive Officers</h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto">The industry veterans steering the course of IronForge Machinery globally.</p>
            </div>

            <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    ['name' => 'Viktor Vance', 'role' => 'Founder & CEO', 'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400'],
                    ['name' => 'Sarah Sterling', 'role' => 'Chief Technology Officer', 'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400'],
                    ['name' => 'Robert Miller', 'role' => 'VP of Engineering', 'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400'],
                    ['name' => 'Amanda Cruz', 'role' => 'Head of Global Support', 'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=400']
                ] as $member)
                    <div class="text-center">
                        <div class="relative h-60 w-full overflow-hidden rounded-xl mb-4 bg-gray-100">
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-charcoal">{{ $member['name'] }}</h3>
                        <p class="text-xs font-semibold text-gold uppercase tracking-wider mt-1">{{ $member['role'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
