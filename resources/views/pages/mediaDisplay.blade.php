```<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Media Homescreen') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Pilih media yang akan ditampilkan di layar utama dan atur urutannya.
                </p>
            </div>
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
                        <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Media Table -->
                    @if ($media->count())
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
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                            Tampil
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                            Urutan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                            Durasi (detik)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($media as $item)
                                        <tr class="hover:bg-gray-50">
                                            <!-- PREVIEW -->
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

                                            <!-- JUDUL -->
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                            </td>

                                            <!-- TIPE -->
                                            <td class="px-6 py-4">
                                                <span @class([
                                                    'px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                    'bg-green-100 text-green-800' => $item->tipe === 'gambar',
                                                    'bg-blue-100 text-blue-800' => $item->tipe === 'video',
                                                ])>
                                                    {{ ucfirst($item->tipe) }}
                                                </span>

                                            </td>

                                            <!-- TOGGLE TAMPIL -->
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer toggle-media"
                                                        data-id="{{ $item->id_media }}"
                                                        {{ $item->aktif ? 'checked' : '' }}>
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                    </div>
                                                </label>
                                            </td>

                                            <!-- URUTAN -->
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <input type="number"
                                                    class="w-20 px-3 py-2 text-center border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent urutan-input"
                                                    data-id="{{ $item->id_media }}" value="{{ $item->urutan }}"
                                                    min="1">
                                            </td>

                                            <!-- DURASI -->
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if ($item->tipe === 'gambar')
                                                    <input type="number"
                                                        class="w-20 px-3 py-2 text-center border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent durasi-input"
                                                        data-id="{{ $item->id_media }}"
                                                        value="{{ $item->durasi ?? 5 }}" min="1" max="60">
                                                @else
                                                    <span class="text-gray-400">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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

                            <a href="{{ route('media.create') }}"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Media Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // TOGGLE TAMPIL dengan loading state
        document.querySelectorAll('.toggle-media').forEach(el => {
            el.addEventListener('change', function() {
                const checkbox = this;
                const originalState = checkbox.checked;

                // Tampilkan loading state
                const parentLabel = checkbox.closest('label');
                const toggleDiv = parentLabel.querySelector('div');
                toggleDiv.classList.add('opacity-50');

                fetch('{{ route('media-display.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: this.dataset.id,
                            aktif: this.checked ? 1 : 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            // Jika gagal, kembalikan ke state semula
                            checkbox.checked = !originalState;
                        }
                        toggleDiv.classList.remove('opacity-50');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        checkbox.checked = !originalState;
                        toggleDiv.classList.remove('opacity-50');
                    });
            });
        });

        // URUTAN dengan debounce
        let urutanTimeout;
        document.querySelectorAll('.urutan-input').forEach(el => {
            el.addEventListener('input', function() {
                clearTimeout(urutanTimeout);

                // Tampilkan loading state
                this.classList.add('opacity-50');

                urutanTimeout = setTimeout(() => {
                    fetch('{{ route('media-display.urutan') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: this.dataset.id,
                                urutan: this.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Berikan feedback visual
                                this.classList.remove('opacity-50');
                                this.classList.add('border-green-500');
                                setTimeout(() => {
                                    this.classList.remove('border-green-500');
                                }, 1000);
                            } else {
                                this.classList.remove('opacity-50');
                                this.classList.add('border-red-500');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.classList.remove('opacity-50');
                            this.classList.add('border-red-500');
                        });
                }, 500); // Delay 500ms
            });
        });

        // DURASI GAMBAR dengan debounce
        let durasiTimeout;
        document.querySelectorAll('.durasi-input').forEach(el => {
            el.addEventListener('input', function() {
                clearTimeout(durasiTimeout);

                // Tampilkan loading state
                this.classList.add('opacity-50');

                durasiTimeout = setTimeout(() => {
                    fetch('{{ route('media-display.durasi') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: this.dataset.id,
                                durasi: this.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Berikan feedback visual
                                this.classList.remove('opacity-50');
                                this.classList.add('border-green-500');
                                setTimeout(() => {
                                    this.classList.remove('border-green-500');
                                }, 1000);
                            } else {
                                this.classList.remove('opacity-50');
                                this.classList.add('border-red-500');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.classList.remove('opacity-50');
                            this.classList.add('border-red-500');
                        });
                }, 500); // Delay 500ms
            });
        });

        // Validasi input number
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('min') && this.value < this.min) {
                    this.value = this.min;
                }
                if (this.hasAttribute('max') && this.value > this.max) {
                    this.value = this.max;
                }
            });
        });
    </script>

    <style>
        /* Custom styling untuk toggle switch */
        input:checked+div {
            background-color: #2563eb;
        }

        input:checked+div:after {
            transform: translateX(1.25rem);
        }

        /* Styling untuk input yang sedang di-update */
        .opacity-50 {
            opacity: 0.5;
            transition: opacity 0.2s ease;
        }

        /* Pagination styling */
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
</x-app-layout>
```
