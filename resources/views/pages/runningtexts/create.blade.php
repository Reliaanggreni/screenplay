<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Running Text') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('running-texts.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="isi_teks" class="block mb-2 text-sm font-medium text-gray-700">
                                Isi Running Text <span class="text-red-500">*</span>
                            </label>
                            <input id="isi_teks" name="isi_teks" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#004680] focus:border-[#004680]"
                                placeholder="Masukkan teks yang akan ditampilkan di running text">{{ old('isi_teks') }}</input>
                            @error('isi_teks')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="aktif" value="1"
                                    class="rounded border-gray-300 text-[#004680] focus:ring-[#004680]"
                                    {{ old('aktif') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Aktifkan running text ini</span>
                            </label>
                            <p class="mt-1 text-sm text-gray-500">
                                Hanya running text yang aktif akan ditampilkan di halaman depan
                            </p>
                        </div>
                        <!-- Button Group -->
                        <div class="flex justify-end pt-4 space-x-4 border-t border-gray-200">
                            <a href="{{ route('running-texts.index') }}"
                                class="px-6 py-2 text-gray-700 transition duration-200 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                                <i class="mr-2 fas fa-save"></i>Simpan Media
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
