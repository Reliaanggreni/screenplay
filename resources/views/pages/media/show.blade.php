<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Media') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="p-4 mb-6 border-l-4 border-green-500 rounded-r-lg bg-green-50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
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

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-8">
                        <div class="flex items-start justify-between">
                            <a href="{{ route('media.index') }}"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out border border-gray-300 rounded-md hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        <!-- Left Column: Media Preview -->
                        <div class="space-y-6">
                            <!-- Media Preview -->
                            <div class="overflow-hidden border border-gray-200 bg-gray-50 rounded-xl">
                                <div class="p-4 bg-white border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900">Preview Media</h3>
                                </div>

                                <div class="p-6">
                                    @if ($media->tipe == 'gambar')
                                        <div class="relative">
                                            <div class="overflow-hidden bg-gray-100 rounded-lg">
                                                @if (file_exists(public_path('storage/' . $media->file_path)))
                                                    <img src="{{ Storage::url($media->file_path) }}"
                                                        alt="{{ $media->judul }}"
                                                        class="object-contain w-full h-auto mx-auto max-h-96"
                                                        onerror="this.onerror=null; this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22600%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20600%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_186d3a6b7b1%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_186d3a6b7b1%22%3E%3Crect%20width%3D%22800%22%20height%3D%22600%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247%22%20y%3D%22329%22%3EGambar%20Tidak%20Ditemukan%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E'">
                                                @else
                                                    <div
                                                        class="flex flex-col items-center justify-center bg-gray-100 h-96">
                                                        <svg class="w-16 h-16 mb-4 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        <p class="text-gray-500">File gambar tidak ditemukan</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif($media->tipe == 'video')
                                        <div class="relative">
                                            <div class="overflow-hidden bg-black rounded-lg">
                                                <video controls class="w-full h-auto max-h-96">
                                                    <source src="{{ Storage::url($media->file_path) }}"
                                                        type="video/mp4">
                                                    Browser Anda tidak mendukung pemutaran video.
                                                </video>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex justify-center mt-6 space-x-4">
                                        <a href="{{ Storage::url($media->file_path) }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                            Buka di Tab Baru
                                        </a>
                                        <a href="{{ Storage::url($media->file_path) }}"
                                            download="{{ $media->judul . '.' . pathinfo($media->file_path, PATHINFO_EXTENSION) }}"
                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out border border-gray-300 rounded-md hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Right Column: Media Information -->
                        <div class="space-y-6">
                            <!-- Media Details -->
                            <div class="bg-white border border-gray-200 rounded-xl">
                                <div class="p-4 border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900">Detail Media</h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-500">Judul
                                                Media</label>
                                            <p class="font-medium text-gray-900">{{ $media->judul }}</p>
                                        </div>

                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-500">Tipe
                                                Media</label>
                                            <div class="flex items-center">
                                                <span class="ml-2 text-sm text-gray-500">
                                                    @if ($media->tipe == 'gambar')
                                                        <svg class="inline w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        Gambar
                                                    @elseif($media->tipe == 'video')
                                                        <svg class="inline w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        Video
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block mb-1 text-sm font-medium text-gray-500">Dibuat</label>
                                                <p class="text-gray-900">
                                                    {{ $media->created_at->format('d/m/Y') }}
                                                    <span class="text-gray-500">•
                                                        {{ $media->created_at->format('H:i') }}</span>
                                                </p>
                                            </div>
                                            <div>
                                                <label
                                                    class="block mb-1 text-sm font-medium text-gray-500">Diupdate</label>
                                                <p class="text-gray-900">
                                                    {{ $media->updated_at->format('d/m/Y') }}
                                                    <span class="text-gray-500">•
                                                        {{ $media->updated_at->format('H:i') }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mb-1 text-sm text-gray-500">Ukuran File</div>
                                        <div class="text-lg font-semibold text-gray-900">
                                            @if (file_exists(storage_path('app/public/' . $media->file_path)))
                                                {{ number_format(filesize(storage_path('app/public/' . $media->file_path)) / 1024 / 1024, 2) }}
                                                MB
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Add loading state for delete button
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForm = document.querySelector('form[action*="destroy"]');
            if (deleteForm) {
                deleteForm.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    button.disabled = true;
                    button.innerHTML = `
                        <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Menghapus...
                    `;
                });
            }
        });
    </script>


</x-app-layout>
