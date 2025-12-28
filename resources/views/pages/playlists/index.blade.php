<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Playlist') }}
            </h2>
            <a href="{{ route('playlists.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Playlist
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Playlist Table -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            @if ($playlists->count())
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900">Manajemen Playlist</h3>
                                    <p class="text-gray-600">Kelola konten yang akan ditampilkan di digital signage</p>
                                </div>


                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Urutan
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Media
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Judul Playlist
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Durasi
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tanggal
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($playlists as $playlist)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <span class="text-lg font-semibold text-gray-900">
                                                                {{ $playlist->urutan }}
                                                            </span>
                                                            <div class="ml-3 flex flex-col space-y-1">
                                                                <button
                                                                    onclick="movePlaylistUp({{ $playlist->id_playlist }})"
                                                                    class="text-gray-400 hover:text-blue-600 p-1 rounded hover:bg-gray-100">
                                                                    <svg class="w-3 h-3" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M5 15l7-7 7 7"></path>
                                                                    </svg>
                                                                </button>
                                                                <button
                                                                    onclick="movePlaylistDown({{ $playlist->id_playlist }})"
                                                                    class="text-gray-400 hover:text-blue-600 p-1 rounded hover:bg-gray-100">
                                                                    <svg class="w-3 h-3" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 9l-7 7-7-7"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($playlist->media)
                                                            <div class="flex items-center space-x-3">
                                                                <div
                                                                    class="w-16 h-16 rounded-lg overflow-hidden border border-gray-300 flex-shrink-0">
                                                                    @if ($playlist->media->tipe == 'gambar')
                                                                        @if (file_exists(public_path('storage/' . $playlist->media->file_path)))
                                                                            <img src="{{ Storage::url($playlist->media->file_path) }}"
                                                                                alt="{{ $playlist->media->judul }}"
                                                                                class="w-full h-full object-cover">
                                                                        @else
                                                                            <div
                                                                                class="w-full h-full flex items-center justify-center bg-gray-100">
                                                                                <svg class="w-6 h-6 text-gray-400"
                                                                                    fill="none" stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                                    </path>
                                                                                </svg>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <div class="relative w-full h-full bg-gray-800">
                                                                            <div
                                                                                class="absolute inset-0 flex items-center justify-center">
                                                                                <svg class="w-6 h-6 text-white/80"
                                                                                    fill="currentColor"
                                                                                    viewBox="0 0 20 20">
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                                        clip-rule="evenodd"></path>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <div
                                                                        class="text-sm font-medium text-gray-900 truncate max-w-xs">
                                                                        {{ $playlist->media->judul }}
                                                                    </div>
                                                                    <div class="text-xs text-gray-500">
                                                                        <span
                                                                            class="px-1.5 py-0.5 rounded-full text-xs
                                                                    @if ($playlist->media->tipe == 'gambar') bg-green-100 text-green-800
                                                                    @else bg-blue-100 text-blue-800 @endif">
                                                                            {{ ucfirst($playlist->media->tipe) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-gray-400 italic">Media tidak
                                                                ditemukan</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $playlist->judul }}
                                                        </div>
                                                        @if ($playlist->media)
                                                            <div class="text-xs text-gray-500 truncate max-w-xs">
                                                                Media: {{ $playlist->media->judul }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                            </svg>
                                                            <span class="text-sm text-gray-900 font-medium">
                                                                {{ $playlist->durasi }} detik
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <form
                                                            action="{{ route('playlists.toggle', $playlist->id_playlist) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="px-3 py-1 rounded-full text-xs font-medium transition-colors duration-200
                                                                @if ($playlist->aktif) bg-green-100 text-green-800 hover:bg-green-200
                                                                @else
                                                                    bg-gray-100 text-gray-800 hover:bg-gray-200 @endif">
                                                                {{ $playlist->aktif ? 'Aktif' : 'Nonaktif' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ $playlist->created_at->format('d/m/Y') }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ $playlist->created_at->format('H:i') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="flex items-center space-x-3">
                                                            <a href="{{ route('playlists.show', $playlist->id_playlist) }}"
                                                                class="text-blue-600 hover:text-blue-900 p-2 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                                title="Lihat Detail">
                                                                <svg class="w-5 h-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('playlists.edit', $playlist->id_playlist) }}"
                                                                class="text-yellow-600 hover:text-yellow-900 p-2 hover:bg-yellow-50 rounded-lg transition-colors duration-200"
                                                                title="Edit">
                                                                <svg class="w-5 h-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                            <form
                                                                action="{{ route('playlists.destroy', $playlist->id_playlist) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900 p-2 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                                    title="Hapus"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus playlist ini?')">
                                                                    <svg class="w-5 h-5" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="mt-6">
                                    {{ $playlists->links() }}
                                </div>
                            @else
                                <!-- EMPTY STATE -->
                                <div class="flex flex-col items-center justify-center py-20 text-center">
                                    <div
                                        class="w-20 h-20 mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>

                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                        Belum ada playlist
                                    </h3>

                                    <p class="text-gray-500 mb-6 max-w-md">
                                        Belum ada media yang ditambahkan ke sistem.
                                        Silakan tambahkan gambar atau video untuk ditampilkan di digital signage.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function movePlaylistUp(playlistId) {
            fetch(`/api/playlists/${playlistId}/move-up`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function movePlaylistDown(playlistId) {
            fetch(`/api/playlists/${playlistId}/move-down`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Add loading state for delete buttons
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    button.disabled = true;
                    button.innerHTML = `
                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    `;
                });
            });

            // Add loading state for toggle buttons
            const toggleForms = document.querySelectorAll('form[action*="toggle"]');
            toggleForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    button.disabled = true;
                    button.innerHTML = `<span class="animate-pulse">...</span>`;
                });
            });
        });
    </script>

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 2px;
        }

        .pagination li a {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination li.active a {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination li a:hover:not(.active) {
            background-color: #f3f4f6;
            transform: translateY(-1px);
        }

        .pagination li.disabled a {
            color: #9ca3af;
            cursor: not-allowed;
        }

        .pagination li.disabled a:hover {
            background-color: transparent;
            transform: none;
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }
    </style>
</x-app-layout>
