<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">Ringkasan keseluruhan data</p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Media -->
                <div class="p-6 transition bg-white shadow-sm sm:rounded-lg hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Media</h3>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $mediaCount }}</p>
                        </div>
                        <div class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                            {{ $mediaActiveCount }} Aktif
                        </div>
                    </div>
                    <a href="{{ route('media.index') }}"
                        class="inline-block mt-4 text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>

                <!-- Running Text -->
                <div class="p-6 transition bg-white shadow-sm sm:rounded-lg hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Running Text</h3>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $runningTextCount }}</p>
                        </div>
                        <div class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                            {{ $runningTextActiveCount }} Aktif
                        </div>
                    </div>
                    <a href="{{ route('running-texts.index') }}"
                        class="inline-block mt-4 text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>

                <!-- Agenda -->
                <div class="p-6 transition bg-white shadow-sm sm:rounded-lg hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Agenda</h3>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $agendaCount }}</p>
                        </div>

                    </div>
                    <a href="{{ route('agenda.index') }}"
                        class="inline-block mt-4 text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>
            </div>

            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Agenda Aktif</h3>
                    <a href="{{ route('agenda.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse ($activeAgenda as $agenda)
                        <div class="p-4 transition border-l-4 border-blue-500 rounded-md bg-gray-50 hover:bg-gray-100">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $agenda->judul }}</p>
                                    <p class="text-xs text-gray-500">{{ $agenda->deskripsi }}</p>
                                    <p class="mt-1 text-xs text-gray-400">
                                        Mulai:
                                        {{ \Carbon\Carbon::parse($agenda->tgl_mulai)->translatedFormat('d M Y') }},
                                        Selesai:
                                        {{ \Carbon\Carbon::parse($agenda->tgl_selesai)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada agenda.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
