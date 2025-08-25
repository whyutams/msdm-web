<footer id="contact" class="bg-gray-100 pt-16 pb-10">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:space-x-12">

            <div>
                <div class="mb-4">
                    <a href="/#">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-primary">{{ config('app.name') }}</h1>
                        </div>
                    </a>
                </div>
                <p class="text-lg text-gray-600 text-justify">
                    Aplikasi Moving Stories adalah media digital yang menyampaikan pesan edukasi melalui kisah nyata
                    dalam bentuk animasi atau video pendek. Dengan visual bergerak dan alur cerita yang menyentuh,
                    aplikasi ini membantu masyarakat lebih mudah memahami informasi, terinspirasi, serta terdorong untuk
                    melakukan perubahan positif dalam kehidupan sehari-hari </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:space-x-2">
                <div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{url('/cerita')}}"
                                class="text-gray-700 hover:text-primary transition-colors">Cerita</a>
                        </li>
                        <li><a href="{{url('/kelas-sebaya')}}"
                                class="text-gray-700 hover:text-primary transition-colors">Kelas Sebaya</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Contact Us</h4>
                    <p class="text-gray-600 mb-4">Email: msdm2025@gmail.com</p>
                    <div class="flex justify-start space-x-5">
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22 12a10 10 0 10-11.5 9.95v-7.05h-2.4v-2.9h2.4V9.35c0-2.4 1.43-3.75 3.63-3.75 1.05 0 2.14.19 2.14.19v2.35h-1.21c-1.19 0-1.56.74-1.56 1.5v1.8h2.66l-.43 2.9h-2.23V22A10 10 0 0022 12z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.46 7.37c.01.15.01.29.01.44 0 4.5-3.43 9.68-9.7 9.68a9.66 9.66 0 01-5.23-1.54 6.91 6.91 0 005.08-1.42 3.41 3.41 0 01-3.18-2.36 3.4 3.4 0 001.54-.06 3.4 3.4 0 01-2.73-3.34v-.04a3.42 3.42 0 001.54.42A3.4 3.4 0 014.8 6.8a9.64 9.64 0 007 3.55A3.85 3.85 0 0111 9.5a3.41 3.41 0 016.03-2.33 6.68 6.68 0 002.16-.82 3.43 3.43 0 01-1.5 1.89 6.68 6.68 0 001.96-.54 7.13 7.13 0 01-1.7 1.67z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-2a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t-2 border-gray-200 mt-12 pt-6 text-center">
            <p class="text-gray-600 text-lg">
                &copy; TIM BIMA 2025. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>


<script>

    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }

    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.add('hidden');
        });
    });
</script>