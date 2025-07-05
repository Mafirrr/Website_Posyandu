<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Posyandu Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/icons/tabler-icons/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset(path: 'build/assets/app-BkZyq8oV.css') }}">
    <script src="{{ asset(path: 'build/assets/app-C15Rxuth.js') }}" defer></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="text-gray-800 bg-white">
    <header x-data="{ open: false }"
        class="sticky top-0 z-50 flex justify-between items-center px-6 py-4 shadow-md bg-white">
        <div class="flex items-center gap-2">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="h-14">
            <span class="font-bold text-xl text-blue-900">Posyandu</span>
        </div>

        <nav class="hidden md:flex gap-6 text-base">
            <a href="#beranda" class="hover:text-blue-600">Beranda</a>
            <a href="#layanan" class="hover:text-blue-600">Layanan</a>
            <a href="#profil" class="hover:text-blue-600">Profil</a>
            <a href="#tentang kami" class="hover:text-blue-600">Tentang Kami</a>
            <a href="#kontak" class="hover:text-blue-600">Kontak</a>
        </nav>

        <div class="hidden md:flex gap-2">
            <a href="{{ route('login') }}"
                class="text-white text-sm px-5 py-2 rounded shadow font-medium transition-all hover:bg-gradient-to-r hover:opacity-80"
                style="background: linear-gradient(to right, #0095DE, #A7E2FF);">
                Masuk
            </a>
            <button
                class="flex items-center gap-2 text-[#18A0E3] border border-[#95DDFF] px-5 py-2 rounded shadow text-sm font-medium transition-all hover:bg-[#18A0E3] hover:text-white hover:border-[#18A0E3]">
                Unduh
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                </svg>
            </button>
        </div>

        <button @click="open = !open" class="md:hidden text-blue-900 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div x-show="open" @click.away="open = false"
            class="absolute top-full left-0 w-full bg-white shadow-md border-t mt-2 md:hidden flex flex-col px-6 py-4 space-y-3 z-50">
            <a href="beranda" class="text-base text-blue-900 hover:text-blue-600">Beranda</a>
            <a href="layanan" class="text-base text-blue-900 hover:text-blue-600">Layanan</a>
            <a href="profil" class="text-base text-blue-900 hover:text-blue-600">Profil</a>
            <a href="tentang kami" class="text-base text-blue-900 hover:text-blue-600">Tentang Kami</a>
            <a href="kontak" class="text-base text-blue-900 hover:text-blue-600">Kontak</a>
            <hr />
            <a href="{{ route('login') }}"
                class="block bg-gradient-to-r from-[#0095DE] to-[#A7E2FF] text-white text-center px-5 py-2 rounded shadow text-sm font-medium transition-all hover:opacity-80">
                Masuk
            </a>
            <button
                class="flex justify-center items-center gap-2 text-[#18A0E3] border border-[#95DDFF] px-5 py-2 rounded shadow text-sm font-medium transition-all hover:bg-[#18A0E3] hover:text-white hover:border-[#18A0E3]">
                Unduh
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                </svg>
            </button>

        </div>
    </header>


    <section id="beranda" class="bg-gradient-to-br from-white to-blue-50 py-16" data-aos="fade-up"
        data-aos-once="false" data-aos-delay="300" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-6 md:px-12 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1 space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Posyandu digital,
                    <span
                        style="background: linear-gradient(to right, #88D8FF, #0179B4); -webkit-background-clip: text; color: transparent;">
                        solusi terpercaya
                    </span><br />
                    untuk kesehatan
                </h1>
                <p class="text-base">
                    <span class="text-[#0084D4] font-semibold">Temani setiap langkah kehamilan anda.</span>
                    <span class="text-black">
                        Layanan Posyandu digital siap bantu pantau kesehatan ibu dan janin, langsung dari rumah.
                        Terhubung
                        dengan
                        <span class="text-[#0084D4] font-semibold">bidan</span>, atur jadwal, dan jaga kehamilan lebih
                        mudah.
                        Siap menjaga kehamilan Anda?
                        <span class="text-[#0084D4] font-semibold">Kunjungi Posyandu Terdekat</span> anda sekarang.
                    </span>
                </p>

                <button
                    class="flex items-center gap-2 text-white text-lg px-10 py-4 rounded shadow font-medium transition-all hover:bg-gradient-to-r hover:from-[#0095DE] hover:to-[#A7E2FF] hover:opacity-80"
                    style="background: linear-gradient(to right, #0095DE, #A7E2FF);">
                    Pelajari Lebih Lanjut
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 relative">
                <img src="{{ asset('storage/images/1.png') }}" loading="lazy" alt="Dokter" class="rounded-lg">
            </div>
        </div>
    </section>


    <section id="beranda" data-aos="zoom-in" data-aos-once="false" data-aos-delay="300" data-aos-duration="800"
        class="px-8 py-8 bg-white border border-blue-200 mx-auto max-w-7xl rounded-3xl -mt-10 relative z-10">
        <h2 class="text-[#0069AB] text-2xl text-center font-bold mb-6">
            Pantau Kesehatan Kehamilan dengan Mudah Melalui Smartphone
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-sm">
            <div class="flex items-center gap-2">
                <i class="ti ti-stethoscope text-blue-500 text-2xl"></i>
                <span class="text-base font-normal">Tips Kehamilan</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ti ti-calendar-event text-blue-500 text-2xl"></i>
                <span class="text-base font-normal">Jadwal Posyandu</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ti ti-news text-blue-500 text-2xl"></i>
                <span class="text-base font-normal">Edukasi Ibu Hamil</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ti ti-chart-dots-2 text-blue-500 text-2xl"></i>
                <span class="text-base font-normal">Pemantauan Grafik</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ti ti-bell text-blue-500 text-2xl"></i>
                <span class="text-base font-normal">Notifikasi</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-base">
                    <i class="ti ti-report-medical text-blue-500 text-2xl"></i>
                    <span class="text-base font-normal">Pemantauan Pemeriksaan</span>
                </div>
                <button
                    class="flex items-center gap-2 text-white bg-[#00A4F4] px-5 py-2 rounded-lg text-lg shadow-lg hover:shadow-xl hover:brightness-110 transition duration-300">
                    Unduh<i class="ti ti-download text-lg"></i>
                </button>

            </div>
        </div>
    </section>

    <section id="layanan" class="px-8 py-20 max-w-5xl mx-auto text-center" data-aos="fade-up"
        data-aos-once="false" data-aos-delay="300" data-aos-duration="800">
        <h2 class="text-2xl text-center font-bold mb-6">
            Layanan <span
                style="background: linear-gradient(to right, #88D8FF, #0179B4); -webkit-background-clip: text; color: transparent;">terbaik
                yang</span> kami tawarkan
        </h2>
        <span class="text-sm text-gray-600">
            Di dunia yang serba cepat saat ini, kesehatan Anda layak mendapatkan perhatian dan kemudahan terbaik.
            Itulah sebabnya HealNet menawarkan serangkaian layanan terpadu yang dirancang untuk memenuhi kebutuhan
            perawatan kesehatan Anda secara digital.
        </span>

        <div class="grid md:grid-cols-3 gap-6 mt-10 text-left">
            <div
                class="md:col-span-2 bg-white border border-blue-200 rounded-2xl p-6 shadow hover:shadow-md transition min-h-[50px]">
                <i class="ti ti-heartbeat text-5xl text-blue-600 mb-4"></i>
                <h3 class="text-xl font-semibold text-blue-700 mb-3">Pemantauan Pemeriksaan</h3>
                <p class="text-sm text-gray-600">
                    Pantau perkembangan kehamilan Anda dengan dukungan Posyandu. Cek berkala dan konsultasi dengan
                    tenaga kesehatan terpercaya. Pemeriksaan rutin selama kehamilan sangat penting untuk memastikan
                    kesehatan ibu dan janin tetap
                    terjaga dengan baik.
                </p>
            </div>
            <div
                class="bg-white border border-blue-200 rounded-2xl p-6 shadow hover:shadow-md transition min-h-[250px]">
                <i class="ti ti-calendar-time text-4xl text-blue-600 mb-5"></i>
                <h3 class="text-lg font-semibold text-blue-700 mb-2">Pemantauan Jadwal Posyandu</h3>
                <p class="text-sm text-gray-600">
                    Lihat dan ikuti jadwal Posyandu terdekat, lengkap dengan lokasi dan jenis pemeriksaan.
                </p>
            </div>
            <div class="bg-white border border-blue-200 rounded-2xl p-6 shadow hover:shadow-md transition">
                <i class="ti ti-book text-4xl text-blue-600 mb-5"></i>
                <h3 class="text-lg font-semibold text-blue-700 mb-2">Edukasi</h3>
                <p class="text-sm text-gray-600">
                    Dapatkan informasi seputar kesehatan ibu dan bayi langsung dari tenaga kesehatan terpercaya.
                </p>
            </div>
            <div class="bg-white border border-blue-200 rounded-2xl p-6 shadow hover:shadow-md transition">
                <i class="ti ti-notes text-4xl text-blue-600 mb-5"></i>
                <h3 class="text-lg font-semibold text-blue-700 mb-2">Catatan Medis</h3>
                <p class="text-sm text-gray-600">
                    Dapatkan catatan medis untuk memantau kesehatan kehamilan dengan cepat dan nyaman.
                </p>
            </div>
            <div class="bg-white border border-blue-200 rounded-2xl p-6 shadow hover:shadow-md transition">
                <i class="ti ti-alert-circle text-4xl text-blue-600 mb-5"></i>
                <h3 class="text-lg font-semibold text-blue-700 mb-2">Tips Untuk Ibu Hamil</h3>
                <p class="text-sm text-gray-600">
                    Informasi seputar kesehatan fisik, makanan, dan pola hidup dari sumber terpercaya.
                </p>
            </div>
        </div>
    </section>

    <section id="profil" data-aos="fade-up" data-aos-once="false" data-aos-delay="300" data-aos-duration="800"
        class="bg-blue-50 px-8 py-16">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl text-center font-bold"
                style="background: linear-gradient(to right, #88D8FF, #0179B4); -webkit-background-clip: text; color: transparent;">
                Profile Posyandu:
            </h2>
            <h2 class="text-2xl text-center font-bold mb-8">Lihat Profile tentang Kader dan Bidan di Posyandu Ini.</h2>
            <div class="grid gap-6">
                <div class="bg-white rounded-2xl shadow p-6 flex gap-4 items-center">
                    <img src="{{ asset('storage/images/2.png') }}" loading="lazy" alt="Kader"
                        class="w-32 h-32 md:w-48 md:h-48 object-cover rounded-xl">
                    <div>
                        <h3 class="text-blue-700 font-bold text-lg mb-2">Rani Selvia(Kader Posyandu)</h3>
                        <p class="text-sm text-gray-600 mb-4">Posyandu adalah tempat pelayanan kesehatan dasar bagi ibu
                            hamil, bayi, dan balita. Sebagai kader, saya bertugas menimbang dan memantau pertumbuhan
                            balita, memberi penyuluhan gizi, membantu imunisasi, serta mengajak masyarakat agar rutin
                            datang ke Posyandu untuk menjaga kesehatan keluarga.</p>
                        <a href="#" class="text-sm text-white bg-blue-500 px-4 py-2 rounded">Kader Posyandu</a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 flex gap-4 items-center">
                    <img src="{{ asset('storage/images/2.png') }}" loading="lazy" alt="Bidan"
                        class="w-32 h-32 md:w-48 md:h-48 object-cover rounded-xl">
                    <div>
                        <h3 class="text-blue-700 font-bold text-lg mb-2">Yulia Kusuma Ningrum, A.Md.Keb (Bidan)</h3>
                        <p class="text-sm text-gray-600 mb-4">Posyandu merupakan layanan kesehatan masyarakat berbasis
                            komunitas yang berfokus pada ibu hamil, bayi, dan balita. Sebagai bidan, saya bertugas
                            memberikan pelayanan kesehatan seperti pemeriksaan kehamilan, imunisasi, pemantauan tumbuh
                            kembang anak, serta pembinaan kepada kader dan edukasi kepada masyarakat. Posyandu berperan
                            penting dalam upaya pencegahan stunting dan meningkatkan kualitas kesehatan keluarga.</p>
                        <a href="#" class="text-sm text-white bg-blue-500 px-4 py-2 rounded">Bidan Posyandu</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="profile"data-aos="fade-up" data-aos-once="false" data-aos-delay="300" data-aos-duration="800"
        class="px-8 py-20 max-w-5xl mx-auto">
        <h2 class="text-2xl text-center font-bold mb-6">
            <span
                style="background: linear-gradient(to right, #88D8FF, #0179B4); -webkit-background-clip: text; color: transparent;">Posyandu
                Tapen:</span> Kenali kami lebih dekat
        </h2>
        <div
            class="bg-white rounded-3xl shadow p-8 border border-[#95DDFF] flex flex-col md:flex-row items-center gap-8">
            <img src="{{ asset('storage/images/3.png') }}" loading="lazy" alt="Posyandu Tapen"
                class="w-50 h-50 object-cover">
            <div class="flex-2">
                <p class="text-sm text-gray-600 font-normal mb-8 text-center md:text-left">
                    Posyandu Ibu Hamil di Tapen, Bondowoso bukan sekadar layanan kesehatan—ini adalah wujud nyata
                    kepedulian terhadap ibu dan calon bayi. Didirikan untuk mendekatkan pelayanan kesehatan ke
                    tengah masyarakat, Posyandu ini menjadi tempat aman dan nyaman bagi ibu hamil untuk mendapatkan
                    pemantauan kehamilan, edukasi, serta dukungan langsung dari tenaga kesehatan berpengalaman.
                    Dengan semangat kebersamaan dan gotong royong, Posyandu Tapen mengutamakan pelayanan yang ramah,
                    tepat sasaran, dan penuh kasih, demi terciptanya generasi yang sehat sejak dalam kandungan.
                </p>
                <div class="flex justify-center md:justify-start">
                    <a href="#"
                        class="text-md text-white bg-blue-500 px-6 py-3 rounded-xl shadow transition-all hover:bg-blue-600 hover:shadow-lg">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-50 px-8 py-20 text-center" data-aos="fade-up" data-aos-once="false" data-aos-delay="300"
        data-aos-duration="800">
        <h2 class="text-2xl text-center font-bold mb-6">
            Cara <span
                style="background: linear-gradient(to right, #88D8FF, #0179B4); -webkit-background-clip: text; color: transparent;">Kerja
                Platform</span> Kami
        </h2>
        <span class="text-sm text-gray-600 max-w-2xl mx-auto block mb-10">
            Menavigasi perjalanan perawatan kesehatan Anda dengan Posyandu sangatlah mudah. ​​Cukup ikuti
            langkah-langkah yang disebutkan di bawah ini untuk melanjutkan layanan yang ada. Anda juga dapat melihat
            fitur untuk menginstall aplikasi kami.
        </span>
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-start gap-12 text-left">
            <div class="flex-1 space-y-6">
                <div class="flex items-center gap-4">
                    <span
                        class="shrink-0 w-12 h-12 text-xl text-white bg-blue-500 rounded-full flex items-center justify-center font-bold">1</span>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-700">Kunjungi Posyandu</h4>
                        <p class="text-sm text-gray-600">Kunjungi Posyandu dan daftarkan diri Anda dengan melengkapi
                            data kehamilan secara langsung. Langkah ini penting untuk memastikan Anda mendapatkan
                            pemantauan kesehatan yang tepat selama masa kehamilan.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span
                        class="shrink-0 w-12 h-12 text-xl text-white bg-blue-500 rounded-full flex items-center justify-center font-bold">2</span>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-700">Install Aplikasi Posyandu</h4>
                        <p class="text-sm text-gray-600">Pasang aplikasi Posyandu untuk kemudahan akses layanan
                            kesehatan ibu hamil. Melalui aplikasi ini, ibu hamil bisa mendapatkan informasi jadwal
                            posyandu, monitoring, serta edukasi kesehatan langsung dari tenaga medis terpercaya, semua
                            cukup dari genggaman tangan Anda.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span
                        class="shrink-0 w-12 h-12 text-xl text-white bg-blue-500 rounded-full flex items-center justify-center font-bold">3</span>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-700">Pantau Kesehatan Anda</h4>
                        <p class="text-sm text-gray-600">Pantau hasil pemeriksaan kesehatan Anda secara berkala untuk
                            memastikan kondisi tetap stabil.</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 self-center">
                <img src="{{ asset('storage/images/4.png') }}" loading="lazy" alt="Ilustrasi Langkah-langkah"
                    class="w-full max-w-sm md:ml-auto" />
            </div>
        </div>
    </section>

    <section id="tentang kami" class="px-8 py-20 bg-white" data-aos="zoom-in" data-aos-once="false"
        data-aos-delay="300" data-aos-duration="800">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-2xl text-center font-bold"
                style="background: linear-gradient(to right, #88D8FF, #0179B4); -webkit-background-clip: text; color: transparent;">
                Lokasi Posyandu:
            </h2>
            <h2 class="text-2xl text-center font-bold mb-8">Lihat Lokasi Posyandu Ini.</h2>
            <div class="w-full h-96 rounded-2xl overflow-hidden shadow-lg border-4 border-blue-200">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252862.53910489418!2d113.671357628125!3d-8.001290651557044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6da17c607fc09%3A0x855b90d21051e557!2sKantor%20Kepala%20Desa%20Kalitapen!5e0!3m2!1sen!2sid!4v1746690732870!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer id="kontak" class="text-gray-500 py-8 px-8" data-aos="fade-up" data-aos-once="false"
        data-aos-delay="300" data-aos-duration="800" style="background-color: #F2FAFF;">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-24">
            <div>
                <img src="{{ asset('storage/images/logo.png') }}" loading="lazy" alt="Logo Posyandu"
                    class="w-24 mb-4">
                <h3 class="text-2xl font-bold mb-4" style="color: #0069AB;">Posyandu</h3>
                <p class="text-sm text-gray-500">
                    Platform digital untuk membantu pemantauan kesehatan ibu dan anak serta edukasi masyarakat secara
                    mudah dan efisien.
                </p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4" style="color: #0069AB;">Kontak</h4>
                <div class="space-y-4 text-md">
                    <p class="flex items-start gap-3">
                        <i class="ti ti-map-pin text-xl" style="color: #00A4F4;"></i>
                        Jalan KHR As'ad Syamsul Arifin, Kalitapen, Kabupaten Bondowoso
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="ti ti-mail text-xl" style="color: #00A4F4;"></i>
                        Email: PosyanduTapen@gmail.com
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="ti ti-phone text-xl" style="color: #00A4F4;"></i>
                        Telp: (+62) 8123456789
                    </p>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4 px-2" style="color: #0069AB;">Ikuti Kami</h4>
                <div class="flex gap-4 text-[#00A4F4]">
                    <a href="#" class="hover:text-white transition hover:bg-[#0069AB] hover:rounded-xl px-2">
                        <i class="ti ti-brand-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-white transition hover:bg-[#0069AB] hover:rounded-xl px-2">
                        <i class="ti ti-brand-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-white transition hover:bg-[#0069AB] hover:rounded-xl px-2">
                        <i class="ti ti-brand-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-white transition hover:bg-[#0069AB] hover:rounded-xl px-2">
                        <i class="ti ti-brand-youtube text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,
        });
    </script>


</body>

</html>
