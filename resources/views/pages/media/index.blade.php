<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Daftar Media') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Gunakan fitur pada tabel agar mempermudah proses pemilihan media
                </p>
            </div>
            <a href="{{ route('media.create') }}"
                class="flex items-center px-3 py-2 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
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
                    @if ($media->isEmpty())
                        <div class="py-8 text-center">
                            <p class="text-gray-500">Belum ada media.</p>
                        </div>
                    @else
                        <!-- Media Table -->
                        <div class="overflow-x-auto ">
                            <table id="mediaTable" class="min-w-full border border-gray-200 divide-y divide-gray-200 ">
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
                                            Tampil
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Urutan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Durasi
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($media as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->tipe === 'gambar')
                                                    <div
                                                        class="w-32 h-20 overflow-hidden bg-gray-100 border border-gray-300 rounded">
                                                        <img src="{{ Storage::url($item->thumb_path) }}"
                                                            alt="{{ $item->judul }}" class="object-cover w-full h-full"
                                                            loading="lazy"
                                                            onerror="this.onerror=null;
                                                                    this.classList.add('hidden');
                                                                    const fb = this.parentElement.querySelector('.img-fallback');
                                                                    fb.classList.remove('hidden');
                                                                    fb.classList.add('flex','items-center','justify-center');
                                                                    ">

                                                        <div class="hidden w-full h-full bg-gray-100 img-fallback">
                                                            <svg class="w-8 h-8 text-gray-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- VIDEO --}}
                                                    <div
                                                        class="relative w-32 h-20 overflow-hidden bg-gray-800 border border-gray-300 rounded">
                                                        <div class="absolute inset-0 flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-white/80" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        <div
                                                            class="absolute bottom-0 left-0 right-0 px-2 py-1 text-xs text-center text-white bg-black/60">
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

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-1">
                                                    <!-- Detail Button -->
                                                    <a href="{{ route('media.show', $item->id_media) }}"
                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 transition-colors duration-200 bg-blue-100 rounded hover:bg-blue-200"
                                                        title="Lihat Detail">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <g fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2">
                                                                <path
                                                                    d="M2.062 12.348a1 1 0 0 1 0-.696a10.75 10.75 0 0 1 19.876 0a1 1 0 0 1 0 .696a10.75 10.75 0 0 1-19.876 0" />
                                                                <circle cx="12" cy="12" r="3" />
                                                            </g>
                                                        </svg>
                                                        Detail
                                                    </a>

                                                    <!-- Edit Button -->
                                                    <a href="{{ route('media.edit', $item->id_media) }}"
                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 transition-colors duration-200 bg-blue-100 rounded hover:bg-blue-200"
                                                        title="Edit">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497zM15 5l4 4" />
                                                        </svg>
                                                        Edit
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('media.destroy', $item->id_media) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 transition-colors duration-200 bg-red-100 rounded hover:bg-red-200"
                                                            title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus media ini?')">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path fill="none" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
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
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const table = $('#mediaTable').DataTable({
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],

                    scrollY: true,
                    scrollCollapse: true,
                    autoWidth: false,
                    deferRender: false,

                    order: [

                    ],

                    language: {
                        search: "Cari: ",
                        searchPlaceholder: "Cari data...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        zeroRecords: "Data tidak ditemukan",
                        paginate: {
                            previous: "Prev",
                            next: "Next"
                        }
                    },

                    columnDefs: [{
                            targets: 0,
                            orderable: false,
                            searchable: false,
                        },
                        {
                            targets: [2, 3, 4, 5, 6],
                            searchable: false,
                        },
                        {
                            targets: 6,
                            orderable: false,
                        }
                    ]
                });
            });


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

            // TOGGLE TAMPIL dengan loading state
            document.querySelectorAll('.toggle-media').forEach(el => {
                el.addEventListener('change', function() {
                    const checkbox = this;
                    const originalState = checkbox.checked;

                    // Tampilkan loading state
                    const parentLabel = checkbox.closest('label');
                    const toggleDiv = parentLabel.querySelector('div');
                    toggleDiv.classList.add('opacity-50');

                    fetch('{{ route('media.toggle') }}', {
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
                        fetch('{{ route('media.urutan') }}', {
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
                        fetch('{{ route('media.durasi') }}', {
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
    @endpush

</x-app-layout>
