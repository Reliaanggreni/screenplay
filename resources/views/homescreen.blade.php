<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UHN Gusti Bagus Sugriwa Denpasar</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            font-family: Poppins;
        }
    </style>
</head>

<body class="overflow-hidden bg-black">
    <div class="relative h-screen">
        <div id="slideshow" class="absolute inset-0 z-0 overflow-hidden">

            @forelse ($media as $index => $item)
                <div class="slide absolute inset-0 {{ $index === 0 ? 'active' : '' }}" data-tipe="{{ $item->tipe }}"
                    data-durasi="{{ $item->tipe === 'gambar' ? $item->durasi ?? 5 : 0 }}">

                    @if ($item->tipe === 'video')
                        <video class="object-cover w-full h-full opacity-80" muted playsinline>
                            <source src="{{ asset('storage/' . $item->file_path) }}">
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $item->file_path) }}"
                            class="object-cover w-full h-full opacity-80" alt="{{ $item->judul }}">
                    @endif
                </div>
            @empty
                <div class="absolute inset-0">
                    <img src="{{ asset('img/bg.jpg') }}" class="object-cover w-full h-full opacity-80">
                </div>
            @endforelse

            {{-- overlay --}}
            <div class="absolute inset-0 bg-gradient-to-tr from-black/40 via-black/10 to-black/40"></div>
        </div>

        <div class="relative z-10 flex flex-col h-full">
            {{-- top --}}
            <div class="flex items-center justify-between px-12 py-8">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('img/uhnlogo.png') }}" alt="Logo UHN" class="object-contain h-24">
                </div>

                <div class="text-right text-white">
                    <div class="flex items-center justify-end space-x-6">
                        {{-- jam --}}
                        <div class="flex flex-col items-end">
                            <div class="text-5xl" id="clock"></div>
                            <div class="hidden text-lg sm:block" id="date">Senin, 1 Des 2025</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- main --}}
            <div class="flex justify-end flex-1 gap-6 px-12 pb-8">

                <div class="w-full sm:w-1/2 md:w-1/3">
                    <div class="relative h-full p-3 overflow-hidden shadow-md bg-white/20 rounded-3xl">
                        <div class="relative bg-[#f5f5f5] rounded-2xl p-4 shadow-md  h-full pb-20 overflow-hidden">
                            <div>
                                {{-- agenda --}}
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 h-16">
                                <div class="absolute inset-0 bg-[#004680]"></div>
                                <div class="absolute top-0 right-0 w-20 h-full pointer-events-none">
                                    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <pattern id="dots-right" x="0" y="0" width="10" height="10"
                                                patternUnits="userSpaceOnUse">
                                                <circle cx="3" cy="3" r="1"
                                                    fill="rgba(255,255,255,0.28)" />
                                            </pattern>
                                        </defs>
                                        <rect width="100%" height="100%" fill="url(#dots-right)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Running Text Bottom -->
            @if ($runningTexts->isNotEmpty())
                <div class="bg-[#f5f5f5] py-1.5 border-t-8 border-[#004680]">
                    <div class="overflow-hidden">
                        <div class="inline-flex text-black whitespace-nowrap text-md">
                            <!-- Copy 1 -->
                            <div class="inline-block animate-marquee">
                                @foreach ($runningTexts as $item)
                                    <span class="inline-block px-12">
                                        {{ $item->isi_teks }}
                                    </span>
                                    <span class="separator"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 25s linear infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .separator {
            border-left: 1.5px solid rgba(112, 112, 112, 0.5);
            height: 20px;
            margin: 0 20px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.2s ease-in-out;
            z-index: 0;
        }

        .slide.active {
            opacity: 1;
            z-index: 1;
        }
    </style>

    <script>
        // Update Jam (Format 24 jam tanpa detik)
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}`;
        }

        // Update Tanggal
        function updateDate() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

            const dayName = days[now.getDay()];
            const day = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            document.getElementById('date').textContent = `${dayName}, ${day} ${month} ${year}`;
        }

        // Inisialisasi jam dan tanggal
        updateClock();
        updateDate();
        setInterval(updateClock, 1000);
        setInterval(updateDate, 60000);

        // Duplicate marquee text untuk seamless loop
        const marquee = document.querySelector('.animate-marquee');
        marquee.innerHTML += marquee.innerHTML;

        // Slideshow logic
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;
        const FADE_DURATION = 1200; // ms (harus sama dengan CSS transition duration)

        function showNextSlide() {
            // Hapus class active dari slide saat ini
            slides[currentSlide].classList.remove('active');

            // Hitung slide berikutnya
            currentSlide = (currentSlide + 1) % slides.length;

            // Tambah class active ke slide berikutnya
            slides[currentSlide].classList.add('active');

            // Setup timer untuk slide berikutnya
            setupSlideTimer();
        }

        function setupSlideTimer() {
            const currentSlideElement = slides[currentSlide];
            const slideType = currentSlideElement.dataset.tipe;
            const slideDuration = parseInt(currentSlideElement.dataset.durasi) || 5; // default 5 detik

            if (slideType === 'video') {
                const video = currentSlideElement.querySelector('video');
                if (video) {
                    video.currentTime = 0;
                    video.play().catch(e => console.log('Video play error:', e));

                    // Jika video punya durasi, gunakan durasi video
                    video.onended = function() {
                        setTimeout(showNextSlide, 500);
                    };

                    // Fallback jika video tidak bisa diputar
                    video.onerror = function() {
                        setTimeout(showNextSlide, slideDuration * 1000);
                    };
                }
            } else {
                // Untuk gambar, gunakan durasi dari data-durasi
                setTimeout(showNextSlide, slideDuration * 1000);
            }
        }

        // Inisialisasi slideshow jika ada slide
        if (slides.length > 0) {
            // Pastikan hanya slide pertama yang aktif
            slides.forEach((slide, index) => {
                if (index !== 0) {
                    slide.classList.remove('active');
                }
            });

            // Mulai slideshow dari slide pertama
            setupSlideTimer();
        }
    </script>
</body>

</html>
