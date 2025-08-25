@extends('layouts.home')

@section('title', 'Beranda')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-100"></div>
        <div class="absolute top-40 left-20 w-48 h-48 bg-secondary/8 rounded-full blur-3xl"></div>
        <div class="absolute bottom-40 right-20 w-64 h-64 bg-primary/8 rounded-full blur-3xl"></div>

        @auth
            {{-- Reminder --}}
            <div class="absolute max-w-6xl mx-auto top-12 left-0 right-0 px-6 sm:px-8 lg:px-12">
                <div
                    class="max-w-6xl mx-auto bg-gray-50 border border-slate-400 shadow-md rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <div class="relative w-16 h-16">
                            <svg class="w-16 h-16 transform -rotate-90">
                                <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="6" fill="transparent" />
                                <circle id="progressCircle" cx="32" cy="32" r="28" stroke="#4a67f7" stroke-width="6"
                                    fill="transparent" stroke-dasharray="176" stroke-dashoffset="176" stroke-linecap="round" />
                            </svg>
                            <span id="progressText"
                                class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-700">
                                0%
                            </span>
                        </div>
                    </div>

                    <div class="flex-1 px-4">
                        <p class="text-gray-800 font-medium"><span class="font-bold">[1/2]</span> Anda belum menyelesaikan tugas
                            minggu ke-x.</p>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ url('/mytask') }}" class="text-secondary font-semibold hover:underline whitespace-nowrap">
                            Selesaikan Tugas
                        </a>
                    </div>
                </div>
            </div>

            <script>
                function easeOutQuad(t) {
                    return t * (2 - t);
                }

                $(document).ready(function () {
                    const $circle = $("#progressCircle");
                    const $text = $("#progressText");
                    const target = 50;
                    const duration = 1000;
                    const circumference = 176;
                    const startTime = performance.now();

                    function animate() {
                        const now = performance.now();
                        let progress = (now - startTime) / duration;
                        if (progress > 1) progress = 1;

                        let eased = easeOutQuad(progress);
                        let value = Math.floor(target * eased);

                        $circle.attr("stroke-dashoffset", circumference - (circumference * value / 100));
                        $text.text(value + "%");

                        if (progress < 1) {
                            requestAnimationFrame(animate);
                        }
                    }

                    requestAnimationFrame(animate);
                });
            </script>
            {{-- Reminder END --}}
        @endauth
        <div class="relative z-10 max-w-6xl mx-auto text-center px-6 sm:px-8 lg:px-12 mt-8 lg:mt-0">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-12 leading-tight">
                Moving Stories
                <span class="text-secondary block mt-6">Belajar dari Kisah Nyata, Terinspirasi untuk Berubah</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-700 mb-16 max-w-5xl mx-auto leading-relaxed font-medium">
                Melalui cerita nyata dalam bentuk animasi dan video pendek, kami menghadirkan edukasi yang lebih mudah
                dipahami, dan mendorong perubahan positif dalam kehidupan sehari-hari.
            </p>

            @guest
                <a href="{{url('/register')}}"
                    class="bg-primary text-white px-16 py-5 rounded-2xl text-xl font-semibold hover:bg-blue-800 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                    Daftar
                </a>
            @endguest
        </div>
    </section>

    <section class="pt-24 bg-white text-gray-600">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 lg:space-x-8">
            <div class="mb-8 p-4">
                <img class="rounded-lg shadow border border-slate-500 bg-gray-100"
                    src="{{ asset('img/Mengenal Diabetes Melitus_fix.jpg') }}" alt="">
            </div>
            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Mengenal Diabetes Melitus
                </h2>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Apa itu Diabetes Melitus?
                    </h3>

                    <p class="mb-4">
                        Diabetes Melitus (DM) atau Kencing Manis adalah penyakit menahun dimana kadar gula darah melebihi
                        batas
                        nilai normal.
                    </p>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Normal Gula Darah Sewaktu (GDS) / tanpa puasa: < 200 mg/dL</li>
                        <li>Normal Gula Darah Puasa (GDP): < 126 mg/dL</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Faktor Risiko Diabetes Melitus
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Genetik (Keturunan)</li>
                        <li>Kegemukan (Obesitas)</li>
                        <li>Kolesterol yang tinggi (Dislipidemia)</li>
                        <li>Mempunyai riwayat penyakit jantung</li>
                        <li>Mempunyai tekanan darah tinggi (Hipertensi)</li>
                        <li>Mengonsumsi makanan dan minuman manis secara berlebihan</li>
                        <li>Kurangnya aktivitas dan olahraga</li>
                        <li>Usia lebih dari 40 tahun</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Tanda dan Gejala Diabetes Melitus
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Banyak buang air kecil (Poliuria)</li>
                        <li>Sering haus (Polidipsia)</li>
                        <li>Cepat merasa lapar (Polifagia)</li>
                        <li>Penurunan berat badan dan rasa lemas</li>
                        <li>Sering berkeringat</li>
                        <li>Kadar gula darah melebihi 200 mg/dL (hiperglikemia)</li>
                        <li>Kadar gula darah di bawah 70 mg/dL (hipoglikemia)</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Komplikasi Diabetes Melitus
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Urat saraf otak pecah / Stroke</li>
                        <li>Urat saraf mata pecah / Buta</li>
                        <li>Penyakit jantung</li>
                        <li>Kerusakan ginjal</li>
                        <li>Luka lama sembuh</li>
                        <li>Kebal pada rasa sakit terutama luka</li>
                        <li>Amputasi</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Tips Mencegah Diabetes Melitus
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Jaga berat badan normal dan olahraga 30 menit per hari</li>
                        <li>Rutin cek gula darah</li>
                        <li>Makan buah dan sayur</li>
                        <li>Hindari alkohol dan rokok</li>
                        <li>Jaga pola makan dan diet</li>
                        <li>Patuhi anjuran dokter dalam pengobatan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-8">
        <div class="w-full border-t border-slate-300 max-w-7xl mx-auto py-12"></div>
    </div>

    <section class=" bg-white text-gray-600">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 lg:space-x-8">
            <div class="mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Tips Mengontrol Gula Darah
                </h2>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <ul class="list-decimal list-inside space-y-2 text-lg mb-4">
                        <li>Makan sehat dan bergizi seimbang</li>
                        <li>Rutin berolahraga</li>
                        <li>Kurangi stres agar tidak depresi</li>
                        <li>Berhenti merokok</li>
                        <li>Batasi konsumsi gula darah</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Kriteria Pengendalian Diabetes Melitus
                    </h3>

                    <p class="mb-4">Glukosa darah puasa (mg/dl):</p>
                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Baik : 80 - < 100</li>
                        <li>Sedang : 100 - 125</li>
                        <li>Buruk : ≥126</li>
                    </ul>

                    <p class="mb-4">Glukosa darah 2 jam (mg/dl):</p>
                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Baik : 80 - 144</li>
                        <li>Sedang : 145 - 179</li>
                        <li>Buruk : ≥180</li>
                    </ul>

                    <p class="mb-4">A1C (%):</p>
                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Baik : 80 - <100< /li>
                        <li>Sedang : 100 - 125</li>
                        <li>Buruk : ≥126</li>
                    </ul>
                </div>
            </div>
            <div class="mb-20 p-4">
                <img class="rounded-lg shadow border border-slate-500 bg-gray-100"
                    src="{{ asset('img/Tips Mengontrol Gula Darah  (1).jpg') }}" alt="">
            </div>
        </div>
    </section>

    <div class="mx-8">
        <div class="w-full border-t border-slate-300 max-w-7xl mx-auto py-12"></div>
    </div>

    <section class=" bg-white text-gray-600 mb-8">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 lg:space-x-8">
            <div class="mb-8 p-4">
                <img class="rounded-lg shadow border border-slate-500 bg-gray-100"
                    src="{{ asset('img/Olahraga untuk penyandang diabetes melitus.jpg') }}" alt="">
            </div>
            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Olahraga / Latihan Fisik Penyandang Diabetes Melitus
                </h2>

                <p class="mb-4 text-lg md:text-xl">
                    Ayo, latihan fisik & olahraga dengan prinsip BBTT
                    (Baik, Benar, Teratur, Terukur)
                </p>

                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Jenis Olahraga
                    </h3>

                    <ul class="list-decimal list-inside space-y-2 text-lg mb-4">
                        <li>Jalan cepat</li>
                        <li>Senam</li>
                        <li>Berenang</li>
                        <li>Bersepeda</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Dosis Olahraga
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li><span class="font-medium">Frekuensi:</span> 3-5 kali per minggu</li>
                        <li><span class="font-medium">Intensitas:</span> Denyut Nadi Latihan (DNL) = 65-80%</li>
                        <li><span class="font-medium">Waktu:</span> Minimal 30 menit per sesi latihan atau 150 menit per
                            minggu (direkomendasikan 45 menit per sesi)</li>
                        <li><span class="font-medium">Tipe:</span> Disarankan olahraga yang bersifat aerobik (jalan cepat,
                            bersepeda, berenang)</li>
                    </ul>
                </div>
                <p class="text-lg md:text-xl"><span class="font-bold text-primary">Ingat!</span> Penderita Diabetes Melitus
                    nggak boleh
                    mager, harus gerak!</p>
            </div>
        </div>
    </section>

    <div class="mx-8">
        <div class="w-full border-t border-slate-300 max-w-7xl mx-auto py-12"></div>
    </div>

    <section class=" bg-white text-gray-600">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 lg:space-x-8">
            <div class="mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Pengobatan Diabetes Melitus
                </h2>

                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Bagaimana Cara Mengobati DM?
                    </h3>

                    <ul class="list-decimal list-inside space-y-2 text-lg mb-4">
                        <li>Membersihkan luka</li>
                        <li>Memeriksa kadar gula darah secara rutin</li>
                        <li>Tidak mengonsumsi makanan dan minuman manis yang tidak sehat</li>
                        <li>Menjalani pola hidup sehat</li>
                        <li>Mengikuti aturan pengobatan Diabetes Melitus</li>
                    </ul>
                </div>
                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Terapi dengan Obat
                    </h3>

                    <ul class="list-decimal list-inside space-y-2 text-lg mb-4">
                        <li>Insulin <br>Disuntikkan ke bagian tubuh yang banyak lemak seperti perut, paha, dan lengan atas
                            tangan.</li>
                        <li>Obat-obatan
                            <br>Obat Antidiabetik (ORADO) seperti: <br>
                            <ul class="list-disc list-inside space-y-2 text-lg mb-4 ml-2">
                                <li>Metformin</li>
                                <li>Glibenclamide</li>
                                <li>Glimepiride</li>
                                <li>dan lain-lain</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <p class="text-lg md:text-xl"><span class="font-bold text-primary">Ingat!</span> Diabetes belum bisa
                    disembuhkan sampai
                    dengan saat ini.
                    Deteksi dini diabetes, pola hidup sehat, dan kepatuhan dalam pengobatan menjadi kunci tercapainya
                    kualitas hidup yang baik bagi pasien diabetes.</p>
            </div>
            <div class="mb-20 p-4">
                <img class="rounded-lg shadow border border-slate-500 bg-gray-100"
                    src="{{ asset('img/Pengobatan pada penderita Diabetes Melitus.jpg') }}" alt="">
            </div>
        </div>
    </section>

    <div class="mx-8">
        <div class="w-full border-t border-slate-300 max-w-7xl mx-auto py-12"></div>
    </div>

    <section class=" bg-white text-gray-600">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 lg:space-x-8">
            <div class="mb-8 p-4">
                <img class="rounded-lg shadow border border-slate-500 bg-gray-100"
                    src="{{ asset('img/Perawatan Kaki DM.png') }}" alt="">
            </div>
            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Bagaimana Cara Perawatan Kaki Diabetes?
                </h2>

                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">

                    <ul class="list-decimal list-inside space-y-2 text-lg mb-4">
                        <li>Bersihkan Kaki <br> Bersihkan kaki setiap hari dengan air bersih dan sabun mandi.</li>
                        <li>Gunakan Pelembab / Lotion pada Kaki Kering <br> Agar kulit tidak menjadi retak, tetapi jangan di
                            sela-sela jari kaki karena akan lembab dan dapat menimbulkan jamur.</li>
                        <li>Gunting Kuku Kaki Lurus Sesuai Bentuk Normal Jari Kaki <br> Tidak terlalu dekat dengan kulit,
                            kemudian kikir agar kuku tidak tajam.</li>
                        <li>Gunakan Alas Kaki <br> Pakai sepatu atau sandal untuk melindungi kaki agar tidak terjadi luka.
                        </li>
                        <li>Gunakan Sepatu dan Sandal yang Nyaman <br> Sesuai dengan ukuran dan nyaman di kaki, dengan ruang
                            yang cukup untuk jari-jari.</li>
                        <li>Periksa Sepatu Sebelum Dipakai <br> Memastikan bahwa tidak ada kerikil, benda tajam, seperti
                            jarum dan duri di dalam sepatu.</li>
                        <li>Obati Luka <br> Bila ada luka kecil, obati luka dan tutup dengan kain atau kassa bersih.</li>
                        <li>Periksa Tanda Radang <br> Segera ke dokter bila kaki mengalami luka.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-8">
        <div class="w-full border-t border-slate-300 max-w-7xl mx-auto py-12"></div>
    </div>

    <section class=" bg-white text-gray-600">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 lg:space-x-8">
            <div class="mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Diet Diabetes Melitus
                </h2>

                <p class="mb-4 text-lg md:text-xl">
                    Diet DM dengan Aturan Tiga J: Jumlah, Jenis, Jadwal Makan
                </p>

                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Pola Makan Seorang Diabetes Melitus
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Jumlah: Ukur kadar kalori yang masuk ke dalam tubuh dengan batas maksimum 1500 kkal/hari</li>
                        <li>Jenis: Utamakan makanan rendah kolesterol, tinggi serat namun rendah Glikemik Indeks (GI).
                            Hindari makanan yang mengandung gula maupun karbohidrat sederhana.</li>
                        <li>Jadwal: Jadwal makan 3x sehari serta selingan 2x snack rendah GI untuk menjaga kestabilan gula
                            darah.</li>
                    </ul>
                </div>

                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Contoh Menu Makanan
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Karbohidrat: Nasi merah, beras basmati, ubi merah, oat, kentang, ubi jalar, dll.</li>
                        <li>Protein: Ikan, tempe, dada ayam tanpa kulit, putih telur, dll.</li>
                        <li>Sayur: Bayam, sawi hijau, selada, caisim, wortel, dll.</li>
                    </ul>
                </div>

                <div class="text-lg md:text-xl max-w-4xl leading-relaxed mb-8">
                    <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                        Komposisi Makanan yang Dianjurkan
                    </h3>

                    <ul class="list-disc list-inside space-y-2 text-lg mb-4">
                        <li>Karbohidrat: 60-70%</li>
                        <li>Protein: 10-15%</li>
                        <li>Lemak: 20-25%</li>
                        <li>Serat: 25% g/hari (utamakan serat larut)</li>
                        <li>Kolesterol: kurang dari 300 mg/hari</li>
                        <li>Kurangi konsumsi garam</li>
                        <li>Jumlah kalori disesuaikan dengan pertumbuhan</li>
                    </ul>
                </div>
            </div>
            <div class="mb-20 p-4">
                <img class="rounded-lg shadow border border-slate-500 bg-gray-100"
                    src="{{ asset('img/Diet Diabetes Melitus (1).jpg') }}" alt="">
            </div>
        </div>
    </section>

    <div class="mx-8">
        <div class="w-full border-t border-slate-300 max-w-7xl mx-auto py-12"></div>
    </div>

    <!-- Cerita Section -->
    @if ($ceritas->count() > 0)
        <section id="stories" class="pb-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                        Cerita Pengalaman
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                        Kisah nyata para penyandang Diabetes Melitus membantu kita memahami perjuangan mereka.
                        Dari pengalaman ini, kita bisa belajar, termotivasi, dan saling menguatkan untuk hidup lebih sehat. </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    @foreach($ceritas as $index => $cerita)
                        <div
                            class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                            <div class="flex items-center mb-8">
                                <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                                    @if($cerita->user->photo_profile)
                                        <img src="{{ asset(path: 'storage/' . $cerita->user->photo_profile) }}" alt="Profile"
                                            class="w-full h-full object-cover">
                                    @else
                                        <span
                                            class="text-white font-bold text-4xl bg-primary w-full h-full flex items-center justify-center rounded-full">
                                            {{ strtoupper(substr($cerita->user->callname, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="ml-6">
                                    <h3 class="font-semibold text-gray-800 text-xl">{{ $cerita->user->callname }}</h3>
                                    <h6 class="font-semibold text-gray-600 mb-2 text-base">{{ $cerita->user->fullname }}</h6>
                                    <p class="text-base text-gray-600">Tipe {{ $cerita->user->diabetes_type }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-2 text-justify">
                                {{ strip_tags($cerita->cerita) }}
                            </p>
                            <a href="{{url('/cerita/' . $cerita->id)}}"
                                class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                                Lihat Selengkapnya
                            </a>
                        </div>

                    @endforeach
                </div>

                <div class="flex justify-center mt-20">
                    <a href="{{url("/cerita")}}"
                        class="bg-primary text-white px-16 py-5 rounded-2xl text-lg font-semibold hover:bg-blue-800 hover:shadow-xl transform transition-all duration-300 shadow">
                        Lihat Semua Cerita
                    </a>
                </div>
            </div>
            </div>
        </section>
    @endif

@endsection