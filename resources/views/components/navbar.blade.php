<!-- navbar -->
<style>
    a {
        text-decoration: none !important;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch #input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #2196f3;
        -webkit-transition: 0.4s;
        transition: 0.4s;
        z-index: 0;
        overflow: hidden;
    }

    .sun-moon {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: yellow;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    #input:checked+.slider {
        background-color: black;
    }

    #input:focus+.slider {
        box-shadow: 0 0 1px #2196f3;
    }

    #input:checked+.slider .sun-moon {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        background-color: white;
        -webkit-animation: rotate-center 0.6s ease-in-out both;
        animation: rotate-center 0.6s ease-in-out both;
    }

    .moon-dot {
        opacity: 0;
        transition: 0.4s;
        fill: gray;
    }

    #input:checked+.slider .sun-moon .moon-dot {
        opacity: 1;
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round .sun-moon {
        border-radius: 50%;
    }

    #moon-dot-1 {
        left: 10px;
        top: 3px;
        position: absolute;
        width: 6px;
        height: 6px;
        z-index: 4;
    }

    #moon-dot-2 {
        left: 2px;
        top: 10px;
        position: absolute;
        width: 10px;
        height: 10px;
        z-index: 4;
    }

    #moon-dot-3 {
        left: 16px;
        top: 18px;
        position: absolute;
        width: 3px;
        height: 3px;
        z-index: 4;
    }

    #light-ray-1 {
        left: -8px;
        top: -8px;
        position: absolute;
        width: 43px;
        height: 43px;
        z-index: -1;
        fill: white;
        opacity: 10%;
    }

    #light-ray-2 {
        left: -50%;
        top: -50%;
        position: absolute;
        width: 55px;
        height: 55px;
        z-index: -1;
        fill: white;
        opacity: 10%;
    }

    #light-ray-3 {
        left: -18px;
        top: -18px;
        position: absolute;
        width: 60px;
        height: 60px;
        z-index: -1;
        fill: white;
        opacity: 10%;
    }

    .cloud-light {
        position: absolute;
        fill: #eee;
        animation-name: cloud-move;
        animation-duration: 6s;
        animation-iteration-count: infinite;
    }

    .cloud-dark {
        position: absolute;
        fill: #ccc;
        animation-name: cloud-move;
        animation-duration: 6s;
        animation-iteration-count: infinite;
        animation-delay: 1s;
    }

    #cloud-1 {
        left: 30px;
        top: 15px;
        width: 40px;
    }

    #cloud-2 {
        left: 44px;
        top: 10px;
        width: 20px;
    }

    #cloud-3 {
        left: 18px;
        top: 24px;
        width: 30px;
    }

    #cloud-4 {
        left: 36px;
        top: 18px;
        width: 40px;
    }

    #cloud-5 {
        left: 48px;
        top: 14px;
        width: 20px;
    }

    #cloud-6 {
        left: 22px;
        top: 26px;
        width: 30px;
    }

    @keyframes cloud-move {
        0% {
            transform: translateX(0px);
        }

        40% {
            transform: translateX(4px);
        }

        80% {
            transform: translateX(-4px);
        }

        100% {
            transform: translateX(0px);
        }
    }

    .stars {
        transform: translateY(-32px);
        opacity: 0;
        transition: 0.4s;
    }

    .star {
        fill: white;
        position: absolute;
        -webkit-transition: 0.4s;
        transition: 0.4s;
        animation-name: star-twinkle;
        animation-duration: 2s;
        animation-iteration-count: infinite;
    }

    #input:checked+.slider .stars {
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
        opacity: 1;
    }

    #star-1 {
        width: 20px;
        top: 2px;
        left: 3px;
        animation-delay: 0.3s;
    }

    #star-2 {
        width: 6px;
        top: 16px;
        left: 3px;
    }

    #star-3 {
        width: 12px;
        top: 20px;
        left: 10px;
        animation-delay: 0.6s;
    }

    #star-4 {
        width: 18px;
        top: 0px;
        left: 18px;
        animation-delay: 1.3s;
    }

    @keyframes star-twinkle {
        0% {
            transform: scale(1);
        }

        40% {
            transform: scale(1.2);
        }

        80% {
            transform: scale(0.8);
        }

        100% {
            transform: scale(1);
        }
    }
</style>

<script>
    // ambil warna dari sessionStorage dan terapkan
    const savedColor = sessionStorage.getItem('themeColor');
    if (savedColor) {
        const colorElement = document.getElementById('color');
        if (colorElement) {
            colorElement.style.backgroundColor = savedColor;
        }
    }
</script>
<!-- navbar -->
<nav class=" sticky top-0 z-50" id="color" style="background-color: #F72798;">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img src="{{ asset('img/ASUS_logo.png')}}"
                        alt="Your Company" class="size-16 " />
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/landing"
                            class="rounded-md hover:bg-gray-800 px-3 py-2 text-sm font-medium text-white">Dashboard</a>
                        <a href="/kelola"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-800 hover:text-white">Kelola menu</a>

                        <a href="/pendapatan"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-800 hover:text-white">Pendapatan</a>



                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">


                    <!-- Profile dropdown -->
                    <div class="relative ml-3 flex gap-4">
                        <!-- mode -->
                        <label class="switch">
                            <input id="input" type="checkbox" checked="darkTheme" class="toggle" />
                            <div class="slider round">
                                <div class="sun-moon">
                                    <svg id="moon-dot-1" class="moon-dot" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="moon-dot-2" class="moon-dot" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="moon-dot-3" class="moon-dot" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="light-ray-1" class="light-ray" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="light-ray-2" class="light-ray" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="light-ray-3" class="light-ray" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>

                                    <svg id="cloud-1" class="cloud-dark" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="cloud-2" class="cloud-dark" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="cloud-3" class="cloud-dark" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="cloud-4" class="cloud-light" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="cloud-5" class="cloud-light" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                    <svg id="cloud-6" class="cloud-light" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="50"></circle>
                                    </svg>
                                </div>
                                <div class="stars">
                                    <svg id="star-1" class="star" viewBox="0 0 20 20">
                                        <path
                                            d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
                                    </svg>
                                    <svg id="star-2" class="star" viewBox="0 0 20 20">
                                        <path
                                            d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
                                    </svg>
                                    <svg id="star-3" class="star" viewBox="0 0 20 20">
                                        <path
                                            d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
                                    </svg>
                                    <svg id="star-4" class="star" viewBox="0 0 20 20">
                                        <path
                                            d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
                                    </svg>
                                </div>
                            </div>
                        </label>
                        <!-- akun -->
                        <button id="profile-button"
                            class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                            <img src="{{ asset ('img/naruto.jpeg')}}"
                                alt="" class="size-9 rounded-full outline -outline-offset-1 outline-white/10 hover:bg-primary" />
                        </button>

                        <div id="profile-menu"
                            class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline-1 outline-black/5">
                            <a href="/akun"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Akun</a>
                            <a href="/test"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log-out</a>

                            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button id="mobile-menu-button" type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-black/30  focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                    <span class="sr-only">Open main menu</span>
                    <svg id="icon-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg id="icon-close" clas viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        aria-hidden="true" class="hidden size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="/landing" class="block rounded-md hover:bg-gray-800 px-3 py-2 text-base font-medium text-white">Dashboard</a>
            <a href="/kelola"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white">Kelola menu</a>

            <a href="/pendapatan"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white">Pendapatan</a>

        </div>
        <div class="border-t border-white/10 pt-4 pb-3">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                    <img src="{{ asset ('img/naruto.jpeg')}}"
                        alt="" class="size-10 rounded-full outline -outline-offset-1 outline-white/10" />
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-white">Dyonn</div>
                    <div class="text-sm font-medium text-gray-400">Penjual@example.com</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="/akun"
                    class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white">Akun</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white">Settings</a>
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                    class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white ">Log-out</a>

                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</nav>



<script>
    // --- Toggle profile menu ---
    const profileButton = document.getElementById('profile-button');
    const profileMenu = document.getElementById('profile-menu');

    profileButton.addEventListener('click', () => {
        profileMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!profileButton.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
    });

    // --- Toggle mobile menu ---
    const mobileButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    mobileButton.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    });
</script>
</body>

</html>