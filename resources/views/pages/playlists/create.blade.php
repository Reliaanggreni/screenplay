<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Playlist Baru') }}
            </h2>
            <a href="{{ route('playlists.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('playlists.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Playlist
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah Baru</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terdapat {{ $errors->count() }} kesalahan dalam input
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Form Header -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900">Form Tambah Playlist</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Tambahkan playlist baru untuk ditampilkan di digital signage
                        </p>
                    </div>

                    <form action="{{ route('playlists.store') }}" method="POST" id="playlistForm">
                        @csrf

                        <div class="space-y-6">
                            <!-- Judul Playlist -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Playlist <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                        required maxlength="255"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                        placeholder="Contoh: Slide Utama - Selamat Datang">

                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        @error('judul')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="text-xs text-gray-500" id="charCount">
                                        <span id="currentChars">{{ strlen(old('judul', '')) }}</span>/255 karakter
                                    </div>
                                </div>

                                <p class="mt-2 text-sm text-gray-500">
                                    Berikan nama yang deskriptif untuk playlist ini
                                </p>
                            </div>

                            <!-- Pilih Media -->
                            <div>
                                <label for="id_media" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Media <span class="text-red-500">*</span>
                                </label>

                                @if ($media->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        @foreach ($media as $item)
                                            <div class="media-option border border-gray-300 rounded-lg p-3 hover:border-blue-500 hover:shadow-sm transition-all duration-200 cursor-pointer"
                                                data-media-id="{{ $item->id_media }}" data-tipe="{{ $item->tipe }}"
                                                data-judul="{{ $item->judul }}" onclick="selectMedia(this)">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-12 h-12 rounded overflow-hidden border border-gray-300 flex-shrink-0">
                                                        @if ($item->tipe == 'gambar')
                                                            @if (file_exists(public_path('storage/' . $item->file_path)))
                                                                <img src="{{ Storage::url($item->file_path) }}"
                                                                    alt="{{ $item->judul }}"
                                                                    class="w-full h-full object-cover">
                                                            @else
                                                                <div
                                                                    class="w-full h-full flex items-center justify-center bg-gray-100">
                                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="relative w-full h-full bg-gray-800">
                                                                <div
                                                                    class="absolute inset-0 flex items-center justify-center">
                                                                    <svg class="w-5 h-5 text-white/80"
                                                                        fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-sm font-medium text-gray-900 truncate">
                                                            {{ $item->judul }}
                                                        </div>
                                                        <div class="flex items-center mt-1">
                                                            <span
                                                                class="px-2 py-0.5 text-xs rounded-full
                                                                @if ($item->tipe == 'gambar') bg-green-100 text-green-800
                                                                @else bg-blue-100 text-blue-800 @endif">
                                                                {{ ucfirst($item->tipe) }}
                                                            </span>
                                                            <span class="ml-2 text-xs text-gray-500">
                                                                {{ pathinfo($item->file_path, PATHINFO_EXTENSION) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <input type="hidden" name="id_media" id="selectedMediaId"
                                        value="{{ old('id_media') }}" required>

                                    <!-- Selected Media Preview -->
                                    <div id="selectedMediaPreview"
                                        class="hidden border border-blue-200 bg-blue-50 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div id="selectedPreview"
                                                    class="w-16 h-16 rounded-lg overflow-hidden border border-gray-300 bg-gray-100">
                                                    <!-- Preview akan diisi oleh JavaScript -->
                                                </div>
                                                <div>
                                                    <div id="selectedTitle" class="font-medium text-gray-900"></div>
                                                    <div id="selectedType" class="text-sm text-gray-500"></div>
                                                </div>
                                            </div>
                                            <button type="button" onclick="clearSelection()"
                                                class="text-gray-400 hover:text-gray-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    @error('id_media')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                @else
                                    <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 mb-2">Belum ada media tersedia</p>
                                        <p class="text-sm text-gray-400 mb-4">Tambahkan media terlebih dahulu sebelum
                                            membuat playlist</p>
                                        <a href="{{ route('media.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Media
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Durasi -->
                            <div>
                                <label for="durasi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Durasi Tampilan (detik) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="durasi" id="durasi"
                                        value="{{ old('durasi', 10) }}" required min="1" max="300"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                        placeholder="Durasi dalam detik">

                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    @error('durasi')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <p class="mt-2 text-sm text-gray-500">
                                    Durasi tampilan media dalam detik (1-300 detik)
                                </p>

                                <!-- Slider untuk durasi -->
                                <div class="mt-4">
                                    <input type="range" id="durasiSlider" min="1" max="300"
                                        value="{{ old('durasi', 10) }}"
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                        oninput="updateDurasiValue(this.value)">
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>1 detik</span>
                                        <span id="durasiValue">{{ old('durasi', 10) }} detik</span>
                                        <span>300 detik (5 menit)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Urutan -->
                            <div>
                                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Urutan Tampilan
                                </label>
                                <div class="relative">
                                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan') }}"
                                        min="0"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                        placeholder="Kosongkan untuk urutan terakhir">

                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16m-7 6h7"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    @error('urutan')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <p class="mt-2 text-sm text-gray-500">
                                    Urutan tampilan dalam daftar playlist. Kosongkan untuk menempatkan di urutan
                                    terakhir.
                                </p>
                            </div>

                            <!-- Status Aktif -->
                            <div class="flex items-center">
                                <input type="checkbox" name="aktif" id="aktif" value="1"
                                    {{ old('aktif', true) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="aktif" class="ml-2 block text-sm text-gray-900">
                                    Aktifkan playlist
                                </label>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">
                                Hanya playlist yang aktif yang akan ditampilkan di digital signage
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <div>
                                    <a href="{{ route('playlists.index') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Batal
                                    </a>
                                </div>

                                <div class="flex space-x-3">
                                    <button type="reset" onclick="resetForm()"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        Reset
                                    </button>

                                    <button type="submit" id="submitBtn"
                                        class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Playlist
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Information Card -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800 mb-1">Informasi Playlist</h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Playlist menentukan konten yang akan ditampilkan di digital signage</li>
                            <li>• Durasi: Waktu tampil setiap media (1-300 detik)</li>
                            <li>• Urutan: Posisi dalam daftar playlist</li>
                            <li>• Hanya playlist aktif yang akan ditampilkan</li>
                            <li>• Pastikan media sudah diupload terlebih dahulu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Character counter
        document.addEventListener('DOMContentLoaded', function() {
            const judulInput = document.getElementById('judul');
            const currentChars = document.getElementById('currentChars');

            judulInput.addEventListener('input', function() {
                currentChars.textContent = this.value.length;

                if (this.value.length > 240) {
                    document.getElementById('charCount').classList.add('text-red-600');
                } else {
                    document.getElementById('charCount').classList.remove('text-red-600');
                }
            });

            // Initialize selected media from old input
            const selectedMediaId = document.getElementById('selectedMediaId').value;
            if (selectedMediaId) {
                const selectedOption = document.querySelector(`.media-option[data-media-id="${selectedMediaId}"]`);
                if (selectedOption) {
                    selectMedia(selectedOption);
                }
            }

            // Form validation
            const form = document.getElementById('playlistForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                const mediaId = document.getElementById('selectedMediaId').value;
                if (!mediaId) {
                    e.preventDefault();
                    alert('Silakan pilih media terlebih dahulu');
                    return;
                }

                if (this.checkValidity()) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                        <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Menyimpan...
                    `;
                }
            });
        });

        function selectMedia(element) {
            // Remove selected class from all options
            document.querySelectorAll('.media-option').forEach(option => {
                option.classList.remove('border-blue-500', 'bg-blue-50');
                option.classList.add('border-gray-300');
            });

            // Add selected class to clicked option
            element.classList.remove('border-gray-300');
            element.classList.add('border-blue-500', 'bg-blue-50');

            // Get media data
            const mediaId = element.getAttribute('data-media-id');
            const mediaType = element.getAttribute('data-tipe');
            const mediaTitle = element.getAttribute('data-judul');

            // Update hidden input
            document.getElementById('selectedMediaId').value = mediaId;

            // Update preview
            const preview = document.getElementById('selectedMediaPreview');
            const previewImage = document.getElementById('selectedPreview');
            const titleElement = document.getElementById('selectedTitle');
            const typeElement = document.getElementById('selectedType');

            // Create preview based on media type
            if (mediaType === 'gambar') {
                const imgElement = element.querySelector('img');
                if (imgElement) {
                    previewImage.innerHTML =
                        `<img src="${imgElement.src}" alt="${mediaTitle}" class="w-full h-full object-cover">`;
                } else {
                    previewImage.innerHTML = `
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    `;
                }
            } else {
                previewImage.innerHTML = `
                    <div class="relative w-full h-full bg-gray-800">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white/80" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                `;
            }

            titleElement.textContent = mediaTitle;
            typeElement.textContent = mediaType === 'gambar' ? 'Gambar' : 'Video';

            // Show preview
            preview.classList.remove('hidden');
        }

        function clearSelection() {
            document.getElementById('selectedMediaId').value = '';
            document.getElementById('selectedMediaPreview').classList.add('hidden');

            // Remove selected class from all options
            document.querySelectorAll('.media-option').forEach(option => {
                option.classList.remove('border-blue-500', 'bg-blue-50');
                option.classList.add('border-gray-300');
            });
        }

        function updateDurasiValue(value) {
            document.getElementById('durasi').value = value;
            document.getElementById('durasiValue').textContent = value + ' detik';
        }

        function resetForm() {
            document.getElementById('judul').value = '';
            document.getElementById('durasi').value = 10;
            document.getElementById('durasiSlider').value = 10;
            document.getElementById('durasiValue').textContent = '10 detik';
            document.getElementById('urutan').value = '';
            document.getElementById('aktif').checked = true;
            document.getElementById('currentChars').textContent = '0';
            document.getElementById('charCount').classList.remove('text-red-600');

            clearSelection();

            // Show confirmation
            const notification = document.createElement('div');
            notification.className =
                'fixed top-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
            notification.textContent = 'Form telah direset';
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 2000);
        }

        // Initialize slider sync
        document.getElementById('durasi').addEventListener('input', function() {
            document.getElementById('durasiSlider').value = this.value;
            document.getElementById('durasiValue').textContent = this.value + ' detik';
        });

        // Auto-focus on judul field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('judul').focus();
        });
    </script>

    <style>
        /* Custom range slider */
        input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            background: transparent;
            cursor: pointer;
        }

        input[type="range"]::-webkit-slider-track {
            background: #e5e7eb;
            height: 8px;
            border-radius: 4px;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            height: 20px;
            width: 20px;
            background-color: #3b82f6;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            margin-top: -6px;
        }

        input[type="range"]::-moz-range-track {
            background: #e5e7eb;
            height: 8px;
            border-radius: 4px;
        }

        input[type="range"]::-moz-range-thumb {
            height: 20px;
            width: 20px;
            background-color: #3b82f6;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Media option hover effect */
        .media-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Loading animation */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Character counter warning */
        .text-red-600 {
            color: #dc2626;
            font-weight: 600;
        }
    </style>
</x-app-layout>
