<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ isset($agenda) ? __('Edit Agenda') : __('Tambah Agenda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form
                        action="{{ isset($agenda) ? route('agenda.update', $agenda->id_agenda) : route('agenda.store') }}"
                        method="POST">
                        @csrf

                        @if (isset($agenda))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="judul" id="judul" placeholder="Masukkan Judul Agenda"
                                value="{{ old('judul', $agenda->judul ?? '') }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi <span
                                    class="text-red-500">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Masukkan Deskripsi Singkat"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('deskripsi', $agenda->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                            <div>
                                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Tanggal
                                    Mulai <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_mulai" id="tgl_mulai"
                                    value="{{ old('tgl_mulai', isset($agenda) ? \Carbon\Carbon::parse($agenda->tgl_mulai)->format('Y-m-d') : '') }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                @error('tgl_mulai')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tgl_selesai" class="block text-sm font-medium text-gray-700">Tanggal
                                    Selesai <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                    value="{{ old('tgl_selesai', isset($agenda) ? \Carbon\Carbon::parse($agenda->tgl_selesai)->format('Y-m-d') : '') }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                @error('tgl_selesai')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Button Group -->
                        <div class="flex justify-end pt-4 space-x-4 border-t border-gray-200">
                            <a href="{{ route('agenda.index') }}"
                                class="px-6 py-2 text-gray-700 transition duration-200 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                                <i class="mr-2 fas fa-save"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
