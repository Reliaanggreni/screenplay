```<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Daftar Media') }}
            </h2>
            <a href="{{ route('media.create') }}"
                class="flex items-center px-4 py-2 font-medium text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Media
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Alert Message -->
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($media->count())
                        <!-- Media Table
                    <!-- Media Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Preview
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Judul
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Tipe
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Tanggal Upload
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($media as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->tipe == 'gambar')
                                                    <div
                                                        class="w-20 h-20 overflow-hidden bg-gray-100 border border-gray-300 rounded-lg">
                                                        @if (file_exists(public_path('storage/' . $item->file_path)))
                                                            <img src="{{ Storage::url($item->file_path) }}"
                                                                alt="{{ $item->judul }}"
                                                                class="object-cover w-full h-full"
                                                                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center\'><svg class=\'w-8 h-8 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                                                        @else
                                                            <div
                                                                class="flex items-center justify-center w-full h-full bg-gray-100">
                                                                <svg class="w-8 h-8 text-gray-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @elseif($item->tipe == 'video')
                                                    <div
                                                        class="relative w-20 h-20 overflow-hidden bg-gray-800 border border-gray-300 rounded-lg group">
                                                        <div class="absolute inset-0 flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-white/80" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                        <div
                                                            class="absolute bottom-0 left-0 right-0 px-2 py-1 text-xs text-white bg-black/60">
                                                            Video
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span @class([
                                                    'px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                    'bg-green-100 text-green-800' => $item->tipe === 'gambar',
                                                    'bg-blue-100 text-blue-800' => $item->tipe === 'video',
                                                ])>
                                                    {{ ucfirst($item->tipe) }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $item->created_at->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-3">
                                                    <a href="{{ route('media.show', $item->id_media) }}"
                                                        class="p-2 text-blue-600 transition-colors duration-200 rounded-lg hover:text-blue-900 hover:bg-blue-50"
                                                        title="Lihat Detail">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('media.edit', $item->id_media) }}"
                                                        class="p-2 text-yellow-600 transition-colors duration-200 rounded-lg hover:text-yellow-900 hover:bg-yellow-50"
                                                        title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('media.destroy', $item->id_media) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 text-red-600 transition-colors duration-200 rounded-lg hover:text-red-900 hover:bg-red-50"
                                                            title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus media ini?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-16 h-16 mb-4 bg-gray-100 rounded-full">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-medium text-gray-900">Belum ada media
                                                    </h3>
                                                    <p class="mb-4 text-gray-500">Mulai dengan menambahkan media baru
                                                    </p>
                                                    <a href="{{ route('media.create') }}"
                                                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                        <svg class="w-4 h-4 mr-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                        </svg>
                                                        Tambah Media Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($media->hasPages())
                            <div class="mt-6">
                                <nav class="flex items-center justify-between px-4 border-t border-gray-200 sm:px-0">
                                    <div class="flex flex-1 w-0 -mt-px">
                                        @if ($media->onFirstPage())
                                            <span
                                                class="inline-flex items-center pt-4 pr-1 text-sm font-medium text-gray-300 border-t-2 border-transparent">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                                Sebelumnya
                                            </span>
                                        @else
                                            <a href="{{ $media->previousPageUrl() }}"
                                                class="inline-flex items-center pt-4 pr-1 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:border-gray-300 hover:text-gray-700">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                                Sebelumnya
                                            </a>
                                        @endif
                                    </div>

                                    <div class="hidden md:-mt-px md:flex">
                                        @foreach (range(1, min(5, $media->lastPage())) as $page)
                                            @if ($page == $media->currentPage())
                                                <a href="#"
                                                    class="inline-flex items-center px-4 pt-4 text-sm font-medium text-blue-600 border-t-2 border-blue-500">
                                                    {{ $page }}
                                                </a>
                                            @else
                                                <a href="{{ $media->url($page) }}"
                                                    class="inline-flex items-center px-4 pt-4 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:border-gray-300 hover:text-gray-700">
                                                    {{ $page }}
                                                </a>
                                            @endif
                                        @endforeach

                                        @if ($media->lastPage() > 5)
                                            <span
                                                class="inline-flex items-center px-4 pt-4 text-sm font-medium text-gray-500 border-t-2 border-transparent">
                                                ...
                                            </span>
                                            <a href="{{ $media->url($media->lastPage()) }}"
                                                class="inline-flex items-center px-4 pt-4 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:border-gray-300 hover:text-gray-700">
                                                {{ $media->lastPage() }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="flex justify-end flex-1 w-0 -mt-px">
                                        @if ($media->hasMorePages())
                                            <a href="{{ $media->nextPageUrl() }}"
                                                class="inline-flex items-center pt-4 pl-1 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:border-gray-300 hover:text-gray-700">
                                                Selanjutnya
                                                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <span
                                                class="inline-flex items-center pt-4 pl-1 text-sm font-medium text-gray-300 border-t-2 border-transparent">
                                                Selanjutnya
                                                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </nav>
                            </div>
                        @endif
                    @else
                        <!-- EMPTY STATE -->
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <div class="flex items-center justify-center w-20 h-20 mb-6 bg-gray-100 rounded-full">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>

                            <h3 class="mb-2 text-xl font-semibold text-gray-900">
                                Belum ada media
                            </h3>

                            <p class="max-w-md mb-6 text-gray-500">
                                Belum ada media yang ditambahkan ke sistem.
                                Silakan tambahkan gambar atau video untuk ditampilkan di digital signage.
                            </p>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

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
    </style>

    <script>
        // Tambahkan loading state untuk tombol hapus
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
        });
    </script>
</x-app-layout>
```
