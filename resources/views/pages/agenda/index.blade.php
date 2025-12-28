<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Agenda') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Hanya agenda yg sedang berlangsung atau akan datang yg tampil
                </p>
            </div>
            <a href="{{ route('agenda.create') }}"
                class="flex items-center px-3 py-2 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Agenda
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($agenda->isEmpty())
                        <div class="py-8 text-center">
                            <p class="text-gray-500">Belum ada agenda.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table id="agendaTable" class="min-w-full border border-gray-200 divide-y divide-gray-200 ">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            No
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Judul
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Deskripsi
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Tanggal Mulai
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Tanggal Selesai
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($agenda as $item)
                                        <tr class="transition-colors duration-150 hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm whitespace-nowrap"></td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 line-clamp-3">
                                                    {{ $item->deskripsi }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($item->tgl_mulai)->translatedFormat('d F Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($item->tgl_selesai)->translatedFormat('d F Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-1">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('agenda.edit', $item->id_agenda) }}"
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
                                                    <form action="{{ route('agenda.destroy', $item->id_agenda) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 transition-colors duration-200 bg-red-100 rounded hover:bg-red-200"
                                                            title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const table = $('#agendaTable').DataTable({
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],

                    scrollY: true,
                    scrollCollapse: true,

                    order: [],

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
                            type: 'string',
                        }, // No,
                        {
                            targets: [3, 4, 5],
                            searchable: false
                        }, {
                            targets: 5,
                            orderable: false
                        } // Aksi
                    ]
                });

                table.on('order.dt search.dt draw.dt', function() {
                    let i = 1;
                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function() {
                            this.data(i++);
                        });
                }).draw();

            });
        </script>
    @endpush

</x-app-layout>
