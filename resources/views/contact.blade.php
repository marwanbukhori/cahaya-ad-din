<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hubungi Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Contact Info -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Maklumat Perhubungan</h3>
                            <p class="text-gray-600 mb-8">
                                Jika anda mempunyai sebarang pertanyaan mengenai pendaftaran atau perkhidmatan kami,
                                sila hubungi kami melalui saluran di bawah.
                            </p>

                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-emerald-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-gray-900">E-mel</h4>
                                        <p class="text-gray-600">admin@cahaya.com</p>
                                        <a href="mailto:admin@cahaya.com"
                                            class="text-emerald-600 hover:text-emerald-700 font-medium mt-1 inline-block">Hantar
                                            E-mel &rarr;</a>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-emerald-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-gray-900">Telefon</h4>
                                        <p class="text-gray-600">+60 12-345 6789</p>
                                        <p class="text-sm text-gray-500">(Isnin - Jumaat, 9:00 Pagi - 5:00 Petang)</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-emerald-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-gray-900">Alamat</h4>
                                        <p class="text-gray-600">
                                            Cahaya Ad Din,<br>
                                            123 Jalan Masjid,<br>
                                            Presint 3, 62100 Putrajaya.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ / Additional Info -->
                        <div class="bg-gray-50 rounded-xl p-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Soalan Lazim</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-gray-900">Berapa lama proses pengesahan?</h4>
                                    <p class="text-sm text-gray-600 mt-1">Proses pengesahan biasanya mengambil masa 1-3
                                        hari bekerja.</p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Bagaimana saya boleh membatalkan pendaftaran?
                                    </h4>
                                    <p class="text-sm text-gray-600 mt-1">Sila hubungi kami melalui telefon atau e-mel
                                        untuk sebarang pembatalan.</p>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Adakah resit rasmi disediakan?</h4>
                                    <p class="text-sm text-gray-600 mt-1">Ya, anda boleh memuat turun resit PDF di
                                        halaman "Borang Saya" selepas pendaftaran berjaya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
