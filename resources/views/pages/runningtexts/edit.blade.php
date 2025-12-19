<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Running Text') }}
            </h2>
            <a href="{{ route('running-texts.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('running-texts.update', $runningText->id_running_text) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="isi_teks" class="block text-sm font-medium text-gray-700 mb-2">
                                Isi Running Text *
                            </label>
                            <textarea id="isi_teks" name="isi_teks" rows="3" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#004680] focus:border-[#004680]"
                                placeholder="Masukkan teks yang akan ditampilkan di running text">{{ old('isi_teks', $runningText->isi_teks) }}</textarea>
                            @error('isi_teks')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="aktif" value="1"
                                    class="rounded border-gray-300 text-[#004680] focus:ring-[#004680]"
                                    {{ old('aktif', $runningText->aktif) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Aktifkan running text ini</span>
                            </label>
                            <p class="mt-1 text-sm text-gray-500">
                                Hanya running text yang aktif akan ditampilkan di halaman depan
                            </p>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('running-texts.index') }}" class="text-gray-600 hover:text-gray-900">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-[#004680] hover:bg-[#003560] text-white font-bold py-2 px-6 rounded">
                                Update Running Text
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
