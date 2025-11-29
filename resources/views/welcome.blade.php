<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite('resources/css/app.css')
</head>

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

                        @if ($errors->has('first_user_error'))
                        <div class="bg-red-600 text-white p-2 mb-3 rounded text-center">
                            {{ $errors->first('first_user_error') }}
                        </div>
                        @endif

                        @if ($errors->has('input_kosong'))
                        <div class="bg-red-600 text-white p-2 mb-3 rounded text-center">
                            {{ $errors->first('input_kosong') }}
                        </div>
                        @endif


                        @if ($errors->any())
                        <form action="{{ route('reset.users') }}" method="POST" class="text-center mt-2">
                            @csrf
                            <button type="submit"
                                class="bg-sky-500 hover:bg-sky-700 text-white px-4 py-2 rounded-lg text-sm transition w-100">
                                Lupa Kata akun
                            </button>
                        </form>
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

                            <!-- <button type="submit"
                                class="control w-full bg-yellow-500 hover:bg-yellow-600 text-black/60 font-semibold py-3 rounded-lg transition fs-5 fw-bold">
                                Masuk
                            </button> -->

                            <button type="submit" class="group group-hover:before:duration-500 group-hover:after:duration-1000 after:duration-500 hover:border-yellow-300  duration-500 before:duration-500    hover:after:-right-2 hover:before:top-8 hover:before:right-16 hover:after:scale-150 hover:after:blur-none hover:before:-bottom-8 hover:before:blur-none hover:bg-yellow-300   origin-left hover:decoration-2 hover:text-amber-900 relative bg-yellow-500 h-16 w-64 border  p-3 text-gray-50 text-base font-bold rounded-lg  overflow-hidden  before:absolute before:w-12 before:h-12 before:content[''] before:right-1 before:top-1 before:z-10 before:bg-amber-700 before:rounded-full before:blur-lg  after:absolute after:z-10 after:w-20 after:h-20 after:content['']  after:bg-amber-600 after:right-8 after:top-3 after:rounded-full after:blur w-100 text-center">
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