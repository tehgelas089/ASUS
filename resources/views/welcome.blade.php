<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
</head>

<style>
    @media (max-width: 992px) {
        .row.g-0 {
            position: relative;
        }

        .row.g-0 .col-8 {
            width: 100%;
        }

        .row.g-0 .col-8 img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            filter: brightness(0.6);
        }

        .row.g-0 .col-4 {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: none;
            width: 100%;
            height: 100%;
            padding: 20px;
        }

        .row.g-0 .col-4>.d-flex {
            /* Warna pink transparan — beneran tembus gambar */
            background-color: rgba(247, 39, 152, 0.4) !important;
            padding: 30px 25px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 8px 25px;
            backdrop-filter: blur(2px);
            /* biar ada efek kaca bening */
        }

        .row.g-0 .col-4 .w-100 {
            max-width: 100%;
        }

        .control {
            width: 100%;
        }
    }
</style>
</head>

<body class="m-0 p-0">
    <div class="row g-0 h-screen">

        <!-- Gambar -->
        <div class="col-8 p-0">
            <img src="{{ asset('img/Makan.jpg') }}" alt="Perpustakaan"
                class="w-full h-screen object-cover align-middle">
        </div>

        <!-- Form -->
        <div class="col-4 p-0">
            <div class="d-flex flex-col justify-center items-center text-white h-screen w-full bg-[#F72798]">

                <div class="w-full px-12">
                    <p class="text-center text-2xl font-extrabold mb-6">Masuk Ke ASUS</p>

                    <div class="text-center mb-6">
                        <img src="{{ asset('img/ASUS_logo.png') }}" alt="Logo"
                            class="mx-auto block w-[250px] h-[250px] object-contain">
                    </div>

                    <div class="bar">
                        {{-- ✅ tampilkan pesan error jika ada --}}
                        @if ($errors->any())
                        <div class="bg-red-600 text-white p-2 mb-3 rounded text-center">
                            {{ $errors->first() }}
                        </div>
                        @endif

                        {{-- ✅ arahkan ke route login.process --}}
                        <form action="{{ route('login.process') }}" method="post">
                            @csrf
                            <input name="name" type="text"
                                class="form-control mb-3 p-3 rounded-lg border border-gray-300 placeholder-gray-500 focus:border-[#e9ad01] focus:ring-[#e9ad01] focus:ring-2 outline-none"
                                placeholder="Nama Pengguna">

                            <div class="input-group mb-4 flex">
                                <input id="passwordInput" name="password" type="password"
                                    class="form-control w-full p-3 rounded-l-lg border border-gray-300 placeholder-gray-500 focus:border-[#e9ad01] focus:ring-[#e9ad01] focus:ring-2 outline-none"
                                    placeholder="Kata Sandi">
                                <button type="button" id="togglePassword"
                                    class="bg-white border border-gray-300 rounded-r-lg px-3 flex items-center justify-center">
                                    <i class="bi bi-eye-slash text-gray-700" id="toggleIcon"></i>
                                </button>
                            </div>

                            <button type="submit"
                                class="control w-full bg-yellow-500 hover:bg-yellow-600 text-black/60 font-semibold py-3 rounded-lg transition fs-5 fw-bold">
                                Masuk
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            toggleIcon.classList.toggle('bi-eye-slash');
            toggleIcon.classList.toggle('bi-eye');
        });
    </script>
</body>

</html>