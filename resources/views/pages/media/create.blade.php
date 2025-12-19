<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Media Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Form Tambah Media</h3>
                        <p class="text-gray-600">Upload media untuk ditampilkan di digital signage</p>
                    </div>

                    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Media *
                                </label>
                                <input type="text" name="judul" id="judul" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Contoh: Selamat Datang di UHN" value="{{ old('judul') }}">
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- File Upload -->
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                    File Media *
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition duration-200"
                                    onclick="document.getElementById('file').click()">
                                    <input type="file" name="file" id="file" required class="hidden"
                                        accept="image/*,video/*" onchange="previewFile()">

                                    <div id="preview-container" class="hidden">
                                        <img id="preview-image" class="mx-auto max-h-full rounded-lg mb-4"
                                            alt="Preview">
                                        <div id="preview-info" class="text-sm text-gray-600"></div>
                                    </div>

                                    <div id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600">Klik untuk upload file</p>
                                        <p class="text-sm text-gray-400 mt-2">Maksimal 20MB. Format: Gambar, Video</p>
                                    </div>
                                </div>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Info -->
                            <div id="file-info" class="hidden p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-medium" id="file-name"></span>
                                        <span class="text-sm text-gray-500 ml-2" id="file-size"></span>
                                    </div>
                                    <button type="button" onclick="clearFile()"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tipe Media -->
                            <div>
                                <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipe Media *
                                </label>
                                <select name="tipe" id="tipe" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Tipe Media</option>
                                    @foreach ($tipeOptions as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('tipe') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipe')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Button Group -->
                            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                                <a href="{{ route('media.index') }}"
                                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                    <i class="fas fa-save mr-2"></i>Simpan Media
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const fileInput = document.getElementById('file');
            const previewContainer = document.getElementById('preview-container');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const fileInfo = document.getElementById('file-info');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const tipeSelect = document.getElementById('tipe');
            const previewImage = document.getElementById('preview-image');

            if (!fileInput.files.length) return;

            const file = fileInput.files[0];
            const mime = file.type;

            // Reset dulu
            tipeSelect.value = '';
            previewImage.src = '';
            previewContainer.classList.add('hidden');

            // Tentukan tipe berdasarkan MIME
            if (mime.startsWith('image/')) {
                tipeSelect.value = 'gambar';

                const reader = new FileReader();
                reader.onload = e => {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);

            } else if (mime.startsWith('video/')) {
                tipeSelect.value = 'video';

            } else {
                alert('File tidak valid. Hanya gambar dan video yang diperbolehkan.');
                clearFile();
                return;
            }

            // Update info file
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileInfo.classList.remove('hidden');

            // uploadPlaceholder.classList.add('hidden');
        }

        function clearFile() {
            const fileInput = document.getElementById('file');
            fileInput.value = '';

            document.getElementById('tipe').value = '';
            document.getElementById('file-info').classList.add('hidden');
            document.getElementById('preview-container').classList.add('hidden');

            const uploadPlaceholder = document.getElementById('upload-placeholder');
            uploadPlaceholder.classList.remove('hidden');
            uploadPlaceholder.innerHTML = `
            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600">Klik untuk upload file</p>
            <p class="text-sm text-gray-400 mt-2">Maksimal 20MB. Format: Gambar, Video</p>
        `;
        }

        function formatFileSize(bytes) {
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return (bytes / Math.pow(k, i)).toFixed(2) + ' ' + sizes[i];
        }
    </script>

</x-app-layout>
