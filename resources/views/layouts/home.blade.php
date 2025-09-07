<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>

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
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-white text-gray-800">
    @include('components/header')

    @yield('content')

    @include('components/footer')

    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        $(document).ready(function () {
            // Quill Editor
            const quillEditors = ['summernote', 'summernote2'];
            quillEditors.forEach(id => {
                const quillContainer = document.getElementById(id);

                if (quillContainer) {
                    const parent = quillContainer.parentNode;
                    const quillDiv = document.createElement('div');
                    quillDiv.id = id + '-quill';
                    quillDiv.className = 'bg-white h-64 rounded-lg border';
                    quillDiv.innerHTML = quillContainer.value;
                    parent.replaceChild(quillDiv, quillContainer);

                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = quillContainer.name;
                    hiddenInput.id = quillContainer.id;
                    parent.appendChild(hiddenInput);

                    const quill = new Quill(quillDiv, {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{ 'font': [] }, { 'size': [] }],
                                ['bold', 'italic', 'underline', 'strike'],
                                [{ 'color': [] }, { 'background': [] }],
                                [{ 'script': 'super' }, { 'script': 'sub' }],
                                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                                ['direction', { 'align': [] }],
                                ['link'],
                                ['clean']
                            ]
                        },
                        placeholder: 'Tulis sesuatu...'
                    });

                    // submit form
                    const form = quillDiv.closest('form');
                    form.addEventListener('submit', function () {
                        hiddenInput.value = quill.root.innerHTML;
                    });
                }

                $(`#${id}-form`).on('submit', function () {
                    $(`#${id}-input`).val(quill.root.innerHTML);

                    return false;
                });
            });
        });
    </script>

</html>