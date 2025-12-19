<x-app-layout>
    <div x-data="{
        activeService: null,
        defaultHero: {
            title: 'Cahaya Ad-Din',
            description: 'Urus Aqiqah, Qurban, Umrah dan lain-lain dengan mudah, cepat dan dipercayai.',
            image: '/img/masjidputra.jpg'
        },
        services: {{ json_encode(config('cahaya.services')) }},
        get currentHero() {
            if (this.activeService && this.services[this.activeService]) {
                const s = this.services[this.activeService];
                return {
                    title: s.title,
                    description: s.description,
                    image: s.image
                };
            }
            return this.defaultHero;
        }
    }">
        <!-- Hero Section -->
        <div
            class="relative bg-emerald-800 h-96 rounded-b-3xl overflow-hidden shadow-xl mx-4 mt-4 lg:mx-8 transition-all duration-500 ease-in-out">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center transition-all duration-700 ease-in-out transform scale-105"
                :style="`background-image: url('${currentHero.image}')`">
            </div>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-emerald-900 bg-opacity-60 transition-opacity duration-500"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight transition-all duration-300"
                    x-text="currentHero.title"></h1>
                <p class="text-emerald-100 text-lg md:text-xl mb-8 max-w-2xl transition-all duration-300"
                    x-text="currentHero.description"></p>
                <div>
                    <a href="#forms"
                        class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:-translate-y-1">
                        Mula Sekarang!
                    </a>
                </div>
            </div>
        </div>

        <!-- Forms Grid -->
        <div id="forms" class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Borang Pendaftaran</h2>
                    <p class="text-gray-600 mt-2">Pilih borang yang dikehendaki untuk meneruskan pendaftaran.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach (config('cahaya.services') as $key => $service)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 cursor-pointer border border-emerald-50 group hover:-translate-y-1"
                            @mouseenter="activeService = '{{ $key }}'" @mouseleave="activeService = null"
                            onclick="window.location='{{ route('forms.show', $key) }}'">

                            <div class="flex items-start space-x-4">
                                <!-- Icon Batch -->
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center justify-center p-3 bg-emerald-50 rounded-lg text-emerald-600 group-hover:bg-emerald-100 group-hover:text-emerald-700 transition-colors">
                                        <!-- Resize Icon SVG dynamically -->
                                        <div class="w-6 h-6">
                                            {!! str_replace('w-12 h-12', 'w-6 h-6', $service['icon']) !!}
                                        </div>
                                    </span>
                                </div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors">
                                        {{ $service['title'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2 leading-relaxed">
                                        {{ $service['description'] }}</p>
                                </div>
                            </div>

                            <!-- Arrow Indicator -->
                            <div class="mt-4 flex justify-end">
                                <svg class="w-5 h-5 text-gray-300 group-hover:text-emerald-500 transition-colors transform group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
