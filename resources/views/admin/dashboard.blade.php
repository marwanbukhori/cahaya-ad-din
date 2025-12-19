<x-app-layout>
    <x-slot name="header">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 1. Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center justify-center text-center">
                    <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold mb-1">Total Pengguna</div>
                    <div class="text-4xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center justify-center text-center">
                    <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold mb-1">Total Permohonan</div>
                    <div class="text-4xl font-bold text-gray-900">{{ $stats['total_submissions'] }}</div>
                </div>
            </div>

            <!-- 2. Submissions Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ showFilter: {{ request()->hasAny(['search', 'status', 'date_start', 'date_end']) ? 'true' : 'false' }} }">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">Senarai Permohonan</h3>
                        <button @click="showFilter = !showFilter"
                            class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-medium text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </div>

                    <!-- Collapsible Filter Section -->
                    <div x-show="showFilter" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="mb-6 bg-gray-50 p-6 rounded-xl border border-gray-100 shadow-inner">

                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <!-- Search -->
                                <div class="md:col-span-4">
                                    <label for="search"
                                        class="block text-sm font-medium text-gray-700 mb-2">Carian</label>
                                    <div
                                        class="relative flex items-center w-full rounded-lg border border-gray-300 bg-white shadow-sm focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500">
                                        <div class="pointer-events-none pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="search" name="search"
                                            value="{{ request('search') }}" placeholder="ID, Nama, Jenis..."
                                            class="block w-full border-0 bg-transparent py-2.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="md:col-span-3">
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select id="status" name="status"
                                        class="block w-full rounded-lg border-gray-300 bg-white py-2.5 pl-3 pr-10 text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="processing"
                                            {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="completed"
                                            {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                                        </option>
                                        <option value="rejected"
                                            {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                        </option>
                                    </select>
                                </div>

                                <!-- Date Range -->
                                <div class="md:col-span-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tarikh
                                        Pendaftaran</label>
                                    <div class="flex items-center gap-2">
                                        <div class="relative flex-grow">
                                            <input type="date" name="date_start" value="{{ request('date_start') }}"
                                                class="block w-full rounded-lg border-gray-300 bg-white py-2.5 px-3 text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                placeholder="Dari">
                                        </div>
                                        <span class="text-gray-400 font-medium">-</span>
                                        <div class="relative flex-grow">
                                            <input type="date" name="date_end" value="{{ request('date_end') }}"
                                                class="block w-full rounded-lg border-gray-300 bg-white py-2.5 px-3 text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                placeholder="Hingga">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-200 pt-4">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-sm font-medium text-gray-500 hover:text-gray-700 px-4 py-2 transition-colors">
                                    Reset Filter
                                </a>
                                <button type="submit"
                                    class="inline-flex justify-center rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all">
                                    Tapis Permohonan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Form Type</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Applicant</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Address</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($submissions as $submission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $submission->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $submission->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ ucfirst(str_replace('_', ' ', $submission->form_type)) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $submission->applicant_name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                            {{ $submission->address }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <form action="{{ route('admin.submissions.update-status', $submission) }}"
                                                method="POST" x-data="{ status: '{{ $submission->status }}' }">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" x-model="status" @change="$root.submit()"
                                                    class="text-xs rounded-full border-gray-300 py-1 pl-2 pr-6 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm cursor-pointer"
                                                    :class="{
                                                        'bg-yellow-100 text-yellow-800': status === 'pending',
                                                        'bg-blue-100 text-blue-800': status === 'processing',
                                                        'bg-green-100 text-green-800': status === 'completed',
                                                        'bg-red-100 text-red-800': status === 'rejected'
                                                    }">
                                                    <option value="pending">Pending</option>
                                                    <option value="processing">Processing</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 hover:text-blue-900">
                                            <a href="{{ route('submissions.pdf', $submission) }}"
                                                class="text-emerald-600 hover:text-emerald-900 font-medium">PDF</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 italic">Tiada
                                            permohonan dijumpai.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $submissions->links() }}
                    </div>
                </div>
            </div>

            <!-- 3. Users Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ showUserFilter: {{ request()->has('search_user') ? 'true' : 'false' }} }">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">Senarai Pengguna</h3>
                        <button @click="showUserFilter = !showUserFilter"
                            class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-medium text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </div>

                    <!-- Collapsible User Filter Section -->
                    <div x-show="showUserFilter" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="mb-6 bg-gray-50 p-6 rounded-xl border border-gray-100 shadow-inner">

                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <!-- Preserve other query params if any (optional, but good practice if we want to keep tab state later) -->
                            @if (request()->has('submissions_page'))
                                <input type="hidden" name="submissions_page"
                                    value="{{ request('submissions_page') }}">
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <!-- User Search -->
                                <div class="md:col-span-12">
                                    <label for="search_user"
                                        class="block text-sm font-medium text-gray-700 mb-2">Carian
                                        Pengguna</label>
                                    <div
                                        class="relative flex items-center w-full rounded-lg border border-gray-300 bg-white shadow-sm focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500">
                                        <div class="pointer-events-none pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="search_user" name="search_user"
                                            value="{{ request('search_user') }}" placeholder="Nama, E-mel..."
                                            class="block w-full border-0 bg-transparent py-2.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-200 pt-4">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-sm font-medium text-gray-500 hover:text-gray-700 px-4 py-2 transition-colors">
                                    Reset
                                </a>
                                <button type="submit"
                                    class="inline-flex justify-center rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all">
                                    Cari Pengguna
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        E-mel</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Peranan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tarikh Daftar</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
