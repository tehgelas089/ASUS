<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Menu Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-900">
  <body class="h-full">
  ```
-->
    <style>
        :root {
            --warna-utama: {
                    {
                    session('warna_utama', '#007bff')
                }
            }

            ;

            --warna-sekunder: {
                    {
                    session('warna_sekunder', '#6c757d')
                }
            }

            ;
        }

        .btn-primary {
            background-color: var(--warna-sekunder);
            border-color: var(--warna-sekunder);
        }

        .btn-primary:hover {
            background-color: #fff;
            color: var(--warna-sekunder);
        }
    </style>

    <div class="min-h-full">
        <x-navbar></x-navbar>

        <x-header>{{$title}}</x-header>

        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="{{ asset('js/theme.js') }}"></script>

</body>

</html>