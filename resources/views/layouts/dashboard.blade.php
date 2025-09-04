<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} Admin - @yield('title')</title>

    @vite('resources/css/app.css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body class="bg-gray-50">
    @include('components/sidebar-dashboard')
    <!-- Mobile menu overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Header -->
        @include('components/header-dashboard')

        <!-- Main Content Area -->
        <main class="p-6">

            @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // // Navigation link active state
        // const navLinks = document.querySelectorAll('.nav-link');
        // navLinks.forEach(link => {
        //     link.addEventListener('click', (e) => {
        //         e.preventDefault();

        //         // Remove active class from all links
        //         navLinks.forEach(l => l.classList.remove('active', 'bg-blue-600'));

        //         // Add active class to clicked link
        //         link.classList.add('active', 'bg-blue-600');

        //         // Update header title based on selected nav
        //         const headerTitle = document.querySelector('header h2');
        //         const linkText = link.textContent.trim();
        //         headerTitle.textContent = linkText;
        //     });
        // });

        // // Add active styling
        // document.addEventListener('DOMContentLoaded', () => {
        //     const activeLink = document.querySelector('.nav-link.active');
        //     if (activeLink) {
        //         activeLink.classList.add('bg-blue-600');
        //     }
        // });
    </script>

    <style>
        .nav-link.active {
            background-color: rgba(59, 130, 246, 0.8);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
    <script>
        $(function () {
            // Summernote
            const summernote_ids = ['summernote', 'summernote2'];

            summernote_ids.forEach((id, i) => {
                $(`#${id}`).summernote({
                    height: 350,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ol', 'ul', 'paragraph', 'height']],
                        ['view', ['undo', 'redo', 'fullscreen']]
                    ],
                    callbacks: {}
                });
            })
        }); 
    </script>

</html>