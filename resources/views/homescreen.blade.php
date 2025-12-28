<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UHN Gusti Bagus Sugriwa Denpasar</title>
    <link rel="icon" type="image/png" href="{{ asset('img/uhnicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1), transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
            will-change: opacity;
        }

        .slide.active {
            opacity: 1;
            z-index: 2;
        }

        video,
        img {
            background: transparent;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 100s linear infinite;
        }

        .separator {
            border-left: 1px solid #999;
            height: 18px;
            margin: 0 20px;
        }
    </style>
</head>

<body class="overflow-hidden bg-black">

    <div class="flex flex-col sm:flex-row sm:h-screen">

        {{-- kiri --}}
        <div
            class="relative flex flex-col w-full h-full {{ $agenda->isNotEmpty() ? 'sm:w-[70%] lg:w-4/5' : 'sm:w-full' }}">
            <div class="absolute z-20 flex items-center justify-between top-8 left-12 right-12">

                {{-- logo --}}
                <img src="{{ asset('img/uhnlogo.png') }}" alt="Logo UHN Sugriwa"
                    class="hidden object-contain h-24 sm:block drop-shadow-md">

                @if ($agenda->isEmpty())
                    {{-- jam --}}
                    <div class="hidden text-right sm:block">
                        <div class="text-5xl font-semibold text-white clock"></div>
                        <div class="mt-2 text-sm text-white date"></div>
                    </div>
                @endif
            </div>

            {{-- foto video --}}
            <div id="slideshow"
                class="relative flex-1 overflow-hidden bg-black {{ $agenda->isEmpty() ? 'flex' : 'hidden sm:flex' }}">

                @forelse ($media as $index => $item)
                    <div class="slide {{ $index === 0 ? 'active' : '' }}" data-tipe="{{ $item->tipe }}"
                        data-durasi="{{ $item->tipe === 'gambar' ? $item->durasi ?? 5 : 0 }}">

                        @if ($item->tipe === 'video')
                            <video class="object-cover w-full h-full " muted playsinline>
                                <source src="{{ asset('storage/' . $item->file_path) }}">
                            </video>
                        @else
                            <img src="{{ asset('storage/' . $item->file_path) }}" class="object-cover w-full h-full ">
                        @endif
                    </div>
                @empty
                    <img src="{{ asset('img/bg.jpg') }}" class="object-cover w-full h-full opacity-80">
                @endforelse

                {{-- <div class="absolute inset-0 bg-black/30"></div> --}}
            </div>
            @if ($runningTexts->isNotEmpty())
                <div class="bg-white border-t-4 border-[#004680] py-1 hidden sm:block">
                    <div class="overflow-hidden">
                        <div class="inline-flex whitespace-nowrap text-md">
                            <div class="inline-block animate-marquee">
                                @foreach ($runningTexts as $item)
                                    <span class="inline-block px-12 text-sm text-gray-700">{{ $item->isi_teks }}</span>
                                    <span class="separator"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- kanan --}}
        <div
            class="w-full h-screen bg-[#f5f5f5] flex flex-col {{ $agenda->isEmpty() ? 'flex sm:hidden' : 'sm:w-[30%] lg:w-1/5' }}">

            <!-- jam -->
            <div class="text-center py-4 bg-[#004680] relative overflow-hidden border-b-2">
                <div class="text-5xl font-semibold text-white clock"></div>
                <div class="mt-2 text-sm text-white date"></div>

                <svg class="absolute bottom-0 right-0 w-40 h-40 pointer-events-none opacity-10" viewBox="0 0 163 160"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                        <path
                            d="M82.9041 60.1227L82.9041 79.9963H102.778C113.864 79.9963 122.852 71.0087 122.852 59.922V40.0483H102.978C91.8917 40.0483 82.9041 49.0359 82.9041 60.1227Z"
                            fill="#91A4AE" />
                        <path
                            d="M91.5361 60.0223C91.5361 66.5081 96.7939 71.7658 103.28 71.7658C109.765 71.7658 115.023 66.5081 115.023 60.0223V48.2788L103.28 48.2788C96.7939 48.2788 91.5361 53.5366 91.5361 60.0223Z"
                            fill="#38474F" />
                        <path
                            d="M82.9041 72.1071V80.0967H90.8936C97.5124 80.0967 102.878 74.7311 102.878 68.1123V60.1227H94.8884C88.2696 60.1227 82.9041 65.4883 82.9041 72.1071Z"
                            fill="#DEE2E6" />
                        <path
                            d="M162.8 19.974V0.100361L142.926 0.100361C131.839 0.100361 122.852 9.08796 122.852 20.1747V40.0483H142.725C153.812 40.0483 162.8 31.0607 162.8 19.974Z"
                            fill="#91A4AE" />
                        <path
                            d="M154.168 20.0743C154.168 13.5886 148.91 8.33081 142.424 8.33081C135.938 8.33081 130.681 13.5886 130.681 20.0743V31.8178L142.424 31.8178C148.91 31.8178 154.168 26.5601 154.168 20.0743Z"
                            fill="#38474F" />
                        <path
                            d="M162.8 7.98954V-5.14984e-05H154.81C148.191 -5.14984e-05 142.826 5.36554 142.826 11.9843V19.9739L150.815 19.9739C157.434 19.9739 162.8 14.6083 162.8 7.98954Z"
                            fill="#DEE2E6" />
                        <path
                            d="M162.8 60.1227V79.9963H142.926C131.839 79.9963 122.852 71.0087 122.852 59.922V40.0483H142.725C153.812 40.0483 162.8 49.0359 162.8 60.1227Z"
                            fill="#ADB5BD" />
                        <path
                            d="M154.168 60.0223C154.168 66.5081 148.91 71.7658 142.424 71.7658C135.938 71.7658 130.681 66.5081 130.681 60.0223V48.2788L142.424 48.2788C148.91 48.2788 154.168 53.5366 154.168 60.0223Z"
                            fill="#38474F" />
                        <path
                            d="M162.8 72.1071V80.0967H154.81C148.191 80.0967 142.826 74.7311 142.826 68.1123V60.1227H150.815C157.434 60.1227 162.8 65.4883 162.8 72.1071Z"
                            fill="#DEE2E6" />
                        <path
                            d="M82.9041 19.974L82.9041 0.100361L102.778 0.100361C113.864 0.100361 122.852 9.08796 122.852 20.1747V40.0483H102.978C91.8917 40.0483 82.9041 31.0607 82.9041 19.974Z"
                            fill="#ADB5BD" />
                        <path
                            d="M91.5361 20.0743C91.5361 13.5886 96.7939 8.33081 103.28 8.33081C109.765 8.33081 115.023 13.5886 115.023 20.0743V31.8178L103.28 31.8178C96.7939 31.8178 91.5361 26.5601 91.5361 20.0743Z"
                            fill="#38474F" />
                        <path
                            d="M82.9041 7.98954V-5.14984e-05H90.8936C97.5124 -5.14984e-05 102.878 5.36554 102.878 11.9843V19.9739L94.8884 19.9739C88.2696 19.9739 82.9041 14.6083 82.9041 7.98954Z"
                            fill="#DEE2E6" />
                        <path
                            d="M102.878 160C113.909 160 122.852 151.057 122.852 140.026C122.852 128.995 113.909 120.052 102.878 120.052C91.8467 120.052 82.9041 128.995 82.9041 140.026C82.9041 151.057 91.8467 160 102.878 160Z"
                            fill="#91A4AE" />
                        <path
                            d="M102.976 151.952C109.617 151.952 115 146.568 115 139.928C115 133.287 109.617 127.904 102.976 127.904C96.3356 127.904 90.9524 133.287 90.9524 139.928C90.9524 146.568 96.3356 151.952 102.976 151.952Z"
                            fill="#F8F9FA" />
                        <path
                            d="M103.173 146.161C106.723 146.161 109.602 143.282 109.602 139.732C109.602 136.181 106.723 133.303 103.173 133.303C99.622 133.303 96.7437 136.181 96.7437 139.732C96.7437 143.282 99.622 146.161 103.173 146.161Z"
                            fill="#38474F" />
                        <path d="M122.852 144.296V120.052H98.6086C98.6086 133.441 109.463 144.296 122.852 144.296Z"
                            fill="#ADB5BD" />
                        <path
                            d="M142.826 80.1041C131.794 80.1041 122.852 89.0467 122.852 100.078C122.852 111.109 131.794 120.052 142.826 120.052C153.857 120.052 162.8 111.109 162.8 100.078C162.8 89.0467 153.857 80.1041 142.826 80.1041Z"
                            fill="#91A4AE" />
                        <path
                            d="M142.728 88.1526C136.087 88.1526 130.704 93.5358 130.704 100.176C130.704 106.817 136.087 112.2 142.728 112.2C149.368 112.2 154.751 106.817 154.751 100.176C154.751 93.5358 149.368 88.1526 142.728 88.1526Z"
                            fill="#F8F9FA" />
                        <path
                            d="M142.531 93.9435C138.981 93.9435 136.102 96.8219 136.102 100.373C136.102 103.923 138.981 106.801 142.531 106.801C146.082 106.801 148.96 103.923 148.96 100.373C148.96 96.8219 146.082 93.9435 142.531 93.9435Z"
                            fill="#38474F" />
                        <path d="M122.852 95.8085V120.052H147.095C147.095 106.663 136.241 95.8085 122.852 95.8085Z"
                            fill="#ADB5BD" />
                        <path
                            d="M142.826 160C153.857 160 162.8 151.057 162.8 140.026C162.8 128.995 153.857 120.052 142.826 120.052H122.852L122.852 140.026C122.852 151.057 131.794 160 142.826 160Z"
                            fill="#F8F9FA" />
                        <path
                            d="M134.796 143.94C141.393 143.94 146.74 138.593 146.74 131.996C146.74 125.4 141.393 120.052 134.796 120.052H122.852V131.996C122.852 138.593 128.199 143.94 134.796 143.94Z"
                            fill="#38474F" />
                        <path
                            d="M142.826 152.422C149.561 152.422 155.021 146.962 155.021 140.227C155.021 133.491 149.561 128.032 142.826 128.032C136.091 128.032 130.631 133.491 130.631 140.227C130.631 146.962 136.091 152.422 142.826 152.422Z"
                            fill="#91A4AE" />
                        <path
                            d="M142.826 147.366C146.769 147.366 149.965 144.169 149.965 140.227C149.965 136.284 146.769 133.088 142.826 133.088C138.883 133.088 135.687 136.284 135.687 140.227C135.687 144.169 138.883 147.366 142.826 147.366Z"
                            fill="#38474F" />
                        <path
                            d="M102.878 80.1041C91.8467 80.1041 82.9041 89.0467 82.9041 100.078C82.9041 111.109 91.8467 120.052 102.878 120.052H122.852L122.852 100.078C122.852 89.0467 113.909 80.1041 102.878 80.1041Z"
                            fill="#F8F9FA" />
                        <path
                            d="M110.908 96.1636C104.311 96.1636 98.9636 101.511 98.9636 108.108C98.9636 114.704 104.311 120.052 110.908 120.052H122.852V108.108C122.852 101.511 117.504 96.1636 110.908 96.1636Z"
                            fill="#38474F" />
                        <path
                            d="M102.878 87.6821C96.1429 87.6821 90.6829 93.1421 90.6829 99.8773C90.6829 106.613 96.1429 112.072 102.878 112.072C109.613 112.072 115.073 106.613 115.073 99.8773C115.073 93.1421 109.613 87.6821 102.878 87.6821Z"
                            fill="#91A4AE" />
                        <path
                            d="M102.878 92.7384C98.9354 92.7384 95.7392 95.9346 95.7392 99.8773C95.7392 103.82 98.9354 107.016 102.878 107.016C106.821 107.016 110.017 103.82 110.017 99.8773C110.017 95.9346 106.821 92.7384 102.878 92.7384Z"
                            fill="#38474F" />
                        <path
                            d="M16.4526 164.141C22.7605 170.434 32.9758 170.422 39.269 164.114C45.5622 157.806 45.5502 147.591 39.2422 141.297C32.9342 135.004 22.7189 135.016 16.4257 141.324C10.1326 147.632 10.1446 157.847 16.4526 164.141Z"
                            fill="#F8F9FA" />
                        <path
                            d="M13.823 165.976C6.5348 158.705 6.52093 146.903 13.792 139.614L14.187 139.219L14.5829 139.613C21.8711 146.885 21.885 158.687 14.6139 165.975L14.2189 166.371L13.823 165.976Z"
                            fill="#ADB5BD" />
                        <path
                            d="M40.976 165.945L41.3719 166.339L40.977 166.735C33.7059 174.024 21.9032 174.037 14.6149 166.766L14.2191 166.371L14.614 165.975C21.8851 158.687 33.6878 158.673 40.976 165.945Z"
                            fill="#91A4AE" />
                        <path
                            d="M28.1752 153.174L27.7794 152.779L28.1743 152.383C35.4454 145.095 47.2481 145.081 54.5363 152.352L54.9322 152.747L54.5373 153.143C47.2662 160.431 35.4635 160.445 28.1752 153.174Z"
                            fill="#ADB5BD" />
                        <path
                            d="M28.1435 126.021C35.4317 133.292 35.4455 145.095 28.1744 152.383L27.7795 152.779L27.3836 152.384C20.0953 145.113 20.0815 133.31 27.3526 126.022L27.7476 125.626L28.1435 126.021Z"
                            fill="#91A4AE" />
                        <path
                            d="M69.5563 133.489C75.8569 127.189 75.8592 116.976 69.5616 110.678C63.264 104.38 53.0511 104.383 46.7505 110.683C40.4499 116.984 40.4475 127.197 46.7452 133.494C53.0428 139.792 63.2557 139.79 69.5563 133.489Z"
                            fill="#F8F9FA" />
                        <path
                            d="M58.1534 95.0001C65.6145 102.461 65.6294 114.543 58.1866 121.986C50.7254 114.525 50.7106 102.443 58.1534 95.0001Z"
                            fill="#ADB5BD" />
                        <path
                            d="M57.5929 121.793L57.9864 122.186L57.5939 122.579C50.3678 129.805 38.6377 129.79 31.3939 122.546L31.0004 122.153L31.3929 121.76C38.619 114.534 50.3491 114.549 57.5929 121.793Z"
                            fill="#91A4AE" />
                        <path
                            d="M57.7277 122.712L58.1202 122.32L58.5137 122.713C65.7575 129.957 65.7719 141.687 58.5459 148.913L58.1534 149.306L57.7599 148.912C50.5161 141.669 50.5016 129.938 57.7277 122.712Z"
                            fill="#ADB5BD" />
                        <path
                            d="M84.9127 121.76L85.3062 122.153L84.9137 122.546C77.6877 129.772 65.9575 129.757 58.7137 122.513L58.3203 122.12L58.7128 121.727C65.9388 114.501 77.6689 114.516 84.9127 121.76Z"
                            fill="#91A4AE" />
                        <path
                            d="M73.3425 140L69.1712 144.974C66.8675 147.721 67.2378 151.825 69.9983 154.14C72.7588 156.455 76.8642 156.105 79.168 153.358C81.4717 150.61 81.1014 146.507 78.3409 144.192L73.3425 140Z"
                            fill="#91A4AE" />
                        <path
                            d="M85.406 39.1855L80.8183 34.5928C78.2846 32.0563 74.1643 32.064 71.6154 34.6102C69.0664 37.1563 69.054 41.2766 71.5878 43.8131C74.1215 46.3496 78.2418 46.3418 80.7907 43.7957L85.406 39.1855Z"
                            fill="#91A4AE" />
                    </g>
                </svg>
            </div>

            <!-- agenda -->
            <div id="agenda-container"
                class="flex-1 max-h-screen px-4 pt-4 pb-4 space-y-3 overflow-y-auto md:px-5 md:space-y-4 md:max-h-full no-scrollbar">

                @if ($agenda->isNotEmpty())

                    {{-- daftar agenda --}}
                    @foreach ($agenda as $item)
                        @php
                            $tglMulai = \Carbon\Carbon::parse($item->tgl_mulai);
                            $tglSelesai = \Carbon\Carbon::parse($item->tgl_selesai);
                            $isFuture = $tglMulai->isFuture();
                        @endphp

                        <div
                            class="agenda-card bg-white rounded-lg shadow-sm px-4 py-3 border-l-4 {{ $isFuture ? 'border-blue-400' : 'border-green-500' }}">

                            <h3 class="flex-1 mb-1 text-base font-semibold text-gray-800 line-clamp-3">
                                {{ $item->judul }}
                            </h3>

                            @if (!empty($item->deskripsi))
                                <p class="mb-3 text-xs text-gray-600">
                                    {{ $item->deskripsi }}
                                </p>
                            @endif

                            <div class="flex flex-wrap items-center justify-between gap-2 text-xs text-gray-500">
                                <!-- Tanggal -->
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>
                                        {{ $tglMulai->translatedFormat('d M Y') }} -
                                        {{ $tglSelesai->translatedFormat('d M Y') }}
                                    </span>
                                </div>

                                <!-- Badge -->
                                <div class="flex-shrink-0">
                                    @if ($isFuture)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-md">
                                            Segera
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs text-green-800 bg-green-100 rounded-md">
                                            Berlangsung
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    {{-- TIDAK ADA AGENDA (KHUSUS MOBILE) --}}
                    <div class="flex items-center justify-center h-full sm:hidden">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium text-gray-600">Tidak ada agenda</p>
                            <p class="mt-1 text-sm text-gray-500">Agenda akan ditampilkan di sini</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- footer -->
            <div class="px-6 py-2 border-t bg-gray-50">
                <p class="text-xs text-center text-gray-400">IF23B - Relia & Restisya UHN Sugriwa</p>
            </div>
        </div>

    </div>

    <script>
        // JAM
        function updateClock() {
            const now = new Date();
            const time = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;

            document.querySelectorAll('.clock').forEach(el => {
                el.textContent = time;
            });
        }

        function updateDate() {
            const d = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

            const dateText = `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;

            document.querySelectorAll('.date').forEach(el => {
                el.textContent = dateText;
            });
        }

        updateClock();
        updateDate();
        setInterval(updateClock, 1000);
        setInterval(updateDate, 60000);

        // MARQUEE DUPLICATE
        const marquee = document.querySelector('.animate-marquee');
        if (marquee) marquee.innerHTML += marquee.innerHTML;

        // SLIDESHOW
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        function showNextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
            setupTimer();
        }

        function setupTimer() {
            const slide = slides[currentSlide];
            const type = slide.dataset.tipe;
            const durasi = parseInt(slide.dataset.durasi) || 5;

            if (type === 'video') {
                const video = slide.querySelector('video');
                video.currentTime = 0;
                video.play().catch(() => {});
                video.onended = () => setTimeout(showNextSlide, 500);
            } else {
                setTimeout(showNextSlide, durasi * 1000);
            }
        }

        if (slides.length) setupTimer();


        // AUTO REFRESH
        let displayVersion = null;

        async function checkDisplayUpdate() {
            try {
                const response = await fetch('/display/version', {
                    cache: 'no-store'
                });
                const data = await response.json();

                if (displayVersion === null) {
                    displayVersion = data.version;
                } else if (data.version !== displayVersion) {
                    location.reload();
                }
            } catch (e) {
                console.error('Display check failed', e);
            }
        }

        setInterval(checkDisplayUpdate, 10000);


        // AUTO SCROLL AGENDA
        const container = document.getElementById('agenda-container');
        const cards = container?.querySelectorAll('.agenda-card');

        let currentIndex = 0;
        let scrollInterval = null;

        function scrollToCard(index) {
            if (!cards.length) return;

            container.scrollTo({
                top: cards[index].offsetTop - container.offsetTop - 14,
                behavior: 'smooth'
            });
        }

        function startAgendaScroll() {
            if (!cards || cards.length <= 1) return;

            scrollInterval = setInterval(() => {
                currentIndex++;

                if (currentIndex >= cards.length) {
                    currentIndex = 0;

                    // jeda sebentar lalu balik ke atas
                    container.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } else {
                    scrollToCard(currentIndex);
                }
            }, 15000); // lama waktu slide agenda
        }

        // tunggu DOM siap & layout stabil
        setTimeout(startAgendaScroll, 1500);
    </script>

</body>

</html>
