<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Media') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="p-4 mb-6 border-l-4 border-red-500 rounded-r-lg bg-red-50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
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
                                <ul class="pl-5 space-y-1 list-disc">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
                    <!-- Current Media Preview -->
                    <div class="mb-8">
                        <h4 class="mb-3 text-sm font-medium text-gray-500">Media Saat Ini</h4>
                        <div class="flex items-center p-4 space-x-4 border border-gray-200 rounded-lg bg-gray-50">
                            @if ($media->tipe == 'gambar')
                                <div
                                    class="flex-shrink-0 w-20 h-20 overflow-hidden bg-gray-100 border border-gray-300 rounded-lg">
                                    @if (file_exists(public_path('storage/' . $media->file_path)))
                                        <img src="{{ Storage::url($media->file_path) }}" alt="{{ $media->judul }}"
                                            class="object-cover w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div
                                    class="relative flex-shrink-0 w-20 h-20 overflow-hidden bg-gray-800 border border-gray-300 rounded-lg">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white/80" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 right-0 px-2 py-1 text-xs text-center text-white bg-black/60">
                                        Video
                                    </div>
                                </div>
                            @endif

                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $media->judul }}</p>
                                        <div class="flex items-center mt-1 space-x-3">
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full
                                                @if ($media->tipe == 'gambar') bg-green-100 text-green-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($media->tipe) }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                {{ pathinfo($media->file_path, PATHINFO_EXTENSION) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            <span class="font-medium">Catatan:</span> File media tidak dapat diubah.
                            Jika ingin mengganti file, silakan buat media baru.
                        </p>
                    </div>

                    <!-- Edit Form -->
                    <form action="{{ route('media.update', $media->id_media) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Judul Field -->
                            <div>
                                <label for="judul" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Media <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="judul" id="judul"
                                        value="{{ old('judul', $media->judul) }}" required maxlength="255"
                                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-150 ease-in-out border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: Selamat Datang di UHN Gusti Bagus Sugriwa">

                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-2">
                                    <div>
                                        @error('judul')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Button Group -->
                            <div class="flex justify-end pt-4 space-x-4 border-t border-gray-200">
                                <a href="{{ route('running-texts.index') }}"
                                    class="px-6 py-2 text-gray-700 transition duration-200 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="mr-2 fas fa-save"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
