<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Media Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                                <label for="judul" class="block mb-2 text-sm font-medium text-gray-700">
                                    Judul Media <span class="text-red-500">*</span>
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
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-700">
                                    File Media <span class="text-red-500">*</span>
                                </label>
                                <div class="p-6 text-center transition duration-200 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500"
                                    onclick="document.getElementById('file').click()">
                                    <input type="file" name="file" id="file" required class="hidden"
                                        accept=".jpg,.jpeg,.png,.webp,.mp4" onchange="previewFile()">

                                    <div id="preview-container" class="hidden">
                                        <img id="preview-image" class="max-h-full mx-auto mb-4 rounded-lg"
                                            alt="Preview">
                                        <video id="preview-video" class="hidden max-h-full mx-auto mb-4 rounded-lg"
                                            controls muted>
                                        </video>

                                        <div id="preview-info" class="text-sm text-gray-600"></div>
                                    </div>

                                    <div id="upload-placeholder">
                                        <i class="mb-4 text-4xl text-gray-400 fas fa-cloud-upload-alt"></i>
                                        <p class="text-gray-600">Klik untuk upload file</p>
                                        <p class="mt-2 text-sm text-gray-400">
                                            Maksimal 50MB. Format: JPG, PNG, WEBP, MP4
                                        </p>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Disarankan:
                                    <span class="font-medium">Gambar</span> resolusi HD (min. 1280×720),
                                    format JPG / WEBP.
                                    <span class="font-medium">Video</span> MP4 , resolusi 1080p,
                                    durasi singkat agar tampil lancar.
                                </p>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Info -->
                            <div id="file-info" class="hidden p-4 rounded-lg bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-medium" id="file-name"></span>
                                        <span class="ml-2 text-sm text-gray-500" id="file-size"></span>
                                    </div>
                                    <button type="button" onclick="clearFile()"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tipe Media -->
                            <div>
                                <label for="tipe" class="block mb-2 text-sm font-medium text-gray-700">
                                    Tipe Media
                                </label>

                                <!-- Select hanya untuk tampilan -->
                                <select id="tipe_display" disabled
                                    class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                    <option value="">Pilih Tipe Media</option>
                                    @foreach ($tipeOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>

                                <!-- Hidden input untuk dikirim -->
                                <input type="hidden" name="tipe" id="tipe">

                                @error('tipe')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Button Group -->
                            <div class="flex justify-end pt-4 space-x-4 border-t border-gray-200">
                                <a href="{{ route('media.index') }}"
                                    class="px-6 py-2 text-gray-700 transition duration-200 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="mr-2 fas fa-save"></i>Simpan Media
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
            const file = fileInput.files[0];

            if (!file) return;

            const MAX_SIZE = 150 * 1024 * 1024; // 150MB

            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const previewVideo = document.getElementById('preview-video');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const fileInfo = document.getElementById('file-info');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const tipeHidden = document.getElementById('tipe');
            const tipeDisplay = document.getElementById('tipe_display');

            // Reset tampilan
            previewImage.classList.add('hidden');
            previewVideo.classList.add('hidden');
            previewContainer.classList.add('hidden');

            // Validasi ukuran
            if (file.size > MAX_SIZE) {
                alert('Ukuran file maksimal 150MB');
                clearFile();
                return;
            }

            // Update info file
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileInfo.classList.remove('hidden');
            // uploadPlaceholder.classList.add('hidden');

            // Deteksi tipe berdasarkan MIME
            if (file.type.startsWith('image/')) {
                tipeHidden.value = 'gambar';
                tipeDisplay.value = 'gambar';

                const reader = new FileReader();
                reader.onload = e => {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);

            } else if (file.type === 'video/mp4') {
                tipeHidden.value = 'video';
                tipeDisplay.value = 'video';

                previewVideo.src = URL.createObjectURL(file);
                previewVideo.load();
                previewVideo.classList.remove('hidden');
                previewContainer.classList.remove('hidden');

            } else {
                alert('Format file tidak didukung. Gunakan JPG, PNG, WEBP, atau MP4.');
                clearFile();
            }
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
            <i class="mb-4 text-4xl text-gray-400 fas fa-cloud-upload-alt"></i>
            <p class="text-gray-600">Klik untuk upload file</p>
            <p class="mt-2 text-sm text-gray-400">Maksimal 50MB. Format: JPG, PNG, WEBP, MP4</p>

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
