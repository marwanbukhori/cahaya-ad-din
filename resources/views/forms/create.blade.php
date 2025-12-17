<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran: ') . $service['title'] }}

            <a href="{{ route('dashboard') }}" class="float-right text-sm text-emerald-600 hover:text-emerald-800">
                &larr; Kembali
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Changed max-w-7xl to widen the container, and grid layout for content -->
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-medium text-emerald-800">Maklumat Pendaftaran</h3>
                        <p class="text-sm text-gray-500">Sila lengkapkan maklumat di bawah dengan teliti.</p>
                    </div>

                    <form method="POST" action="{{ route('submissions.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="form_type" value="{{ $type }}">

                        <!-- Applicant Details Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="applicant_name" :value="__('Nama Pemohon (Wajib)')" />
                                <x-text-input id="applicant_name" class="block mt-1 w-full" type="text"
                                    name="applicant_name" :value="old('applicant_name', Auth::user()->name)" required autofocus />
                                <x-input-error :messages="$errors->get('applicant_name')" class="mt-2" />
                            </div>

                            <!-- IC -->
                            <div>
                                <x-input-label for="applicant_ic" :value="__('No. Kad Pengenalan (Wajib)')" />
                                <x-text-input id="applicant_ic" class="block mt-1 w-full" type="text"
                                    name="applicant_ic" :value="old('applicant_ic')" required />
                                <x-input-error :messages="$errors->get('applicant_ic')" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('No. Telefon (Wajib)')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone')" required />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <!-- Address (Full Width) -->
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="address" :value="__('Alamat Lengkap (Wajib)')" />
                                <textarea id="address" name="address"
                                    class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm"
                                    rows="3" required>{{ old('address') }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Conditional Fields -->
                        @if (in_array($type, ['aqiqah', 'haji', 'umrah', 'pelancongan', 'qurban']))
                            <div class="mt-8 border-t border-gray-100 pt-6">
                                <h3 class="text-lg font-medium text-emerald-800 mb-4">Maklumat Peserta</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="col-span-1 md:col-span-2">
                                        <x-input-label for="participant_name" :value="__('Nama Peserta (Jika berlainan)')" />
                                        <x-text-input id="participant_name" class="block mt-1 w-full" type="text"
                                            name="participant_name" :value="old('participant_name')" />
                                        <x-input-error :messages="$errors->get('participant_name')" class="mt-2" />
                                    </div>

                                    @if (in_array($type, ['haji']))
                                        <div>
                                            <x-input-label for="participant_ic" :value="__('No. KP Peserta')" />
                                            <x-text-input id="participant_ic" class="block mt-1 w-full" type="text"
                                                name="participant_ic" :value="old('participant_ic')" />
                                        </div>
                                        <div>
                                            <x-input-label for="relationship" :value="__('Hubungan')" />
                                            <x-text-input id="relationship" class="block mt-1 w-full" type="text"
                                                name="relationship" :value="old('relationship')" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($type === 'qurban')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <x-input-label for="animal_type" :value="__('Jenis Haiwan')" />
                                    <select id="animal_type" name="animal_type"
                                        class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                        <option value="">Sila Pilih</option>
                                        <option value="kambing">Kambing (1 Ekor)</option>
                                        <option value="lembu_bahagian">Lembu (Bahagian)</option>
                                        <option value="lembu_seekor">Lembu (Seekor)</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="quantity" :value="__('Bilangan / Bahagian')" />
                                    <x-text-input id="quantity" class="block mt-1 w-full" type="number"
                                        name="quantity" :value="old('quantity', 1)" min="1" />
                                </div>
                            </div>
                        @endif

                        @if ($type === 'waqaf_quran' || $type === 'infak_sabil')
                            <div class="mt-6">
                                <x-input-label for="quantity" :value="__('Jumlah (RM) / Kuantiti')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity"
                                    :value="old('quantity')" />
                            </div>
                        @endif

                        <div class="mt-8 border-t border-gray-100 pt-6">
                            <x-input-label for="notes" :value="__('Nota Tambahan (Pilihan)')" />
                            <textarea id="notes" name="notes"
                                class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm"
                                rows="2">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button class="ml-4">
                                {{ __('Hantar Borang') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
