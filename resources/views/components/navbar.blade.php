<!-- navbar -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    a {
        text-decoration: none !important;
    }

    .action_has {
        --color: 0 0% 60%;
        --color-has: 211deg 100% 48%;
        --sz: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        height: calc(var(--sz) * 2.5);
        width: calc(var(--sz) * 2.5);
        padding: 0.4rem 0.5rem;
        border-radius: 0.375rem;
        border: 0.0625rem solid hsl(var(--color));
    }

    .has_saved:hover {
        border-color: hsl(var(--color-has));
    }

    .has_liked:hover svg,
    .has_saved:hover svg {
        color: hsl(var(--color-has));
    }

    .has_liked svg,
    .has_saved svg {
        overflow: visible;
        height: calc(var(--sz) * 1.75);
        width: calc(var(--sz) * 1.75);
        --ease: cubic-bezier(0.5, 0, 0.25, 1);
        --zoom-from: 1.75;
        --zoom-via: 0.75;
        --zoom-to: 1;
        --duration: 1s;
    }

    .has_saved:hover path[data-path="box"] {
        transition: all 0.3s var(--ease);
        animation: has-saved var(--duration) var(--ease) forwards;
        fill: hsl(var(--color-has) / 0.35);
    }

    .has_saved:hover path[data-path="line-top"] {
        animation: has-saved-line-top var(--duration) var(--ease) forwards;
    }

    .has_saved:hover path[data-path="line-bottom"] {
        animation: has-saved-line-bottom var(--duration) var(--ease) forwards,
            has-saved-line-bottom-2 calc(var(--duration) * 1) var(--ease) calc(var(--duration) * 0.75);
    }

    @keyframes has-saved-line-top {
        33.333% {
            transform: rotate(0deg) translate(1px, 2px) scale(var(--zoom-from));
            d: path("M 3 5 L 3 8 L 3 8");
        }

        66.666% {
            transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
        }

        99.999% {
            transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
        }
    }

    @keyframes has-saved-line-bottom {
        33.333% {
            transform: rotate(0deg) translate(1px, 2px) scale(var(--zoom-from));
            d: path("M 17 20 L 17 13 L 7 13 L 7 20");
        }

        66.666% {
            transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
        }

        99.999% {
            transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
            d: path("M 17 21 L 17 21 L 7 21 L 7 21");
        }
    }

    @keyframes has-saved-line-bottom-2 {
        from {
            d: path("M 17 21 L 17 21 L 7 21 L 7 21");
        }

        to {
            transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
            d: path("M 17 20 L 17 13 L 7 13 L 7 20");
            fill: white;
        }
    }

    @keyframes has-saved {
        33.333% {
            transform: rotate(0deg) translate(1px, 2px) scale(var(--zoom-from));
        }

        66.666% {
            transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
        }

        99.999% {
            transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
        }
    }
</style>

<script>
    const savedColor = sessionStorage.getItem('themeColor');
    if (savedColor) {
        const colorElement = document.getElementById('color');
        if (colorElement) {
            colorElement.style.backgroundColor = savedColor;
        }
    }
</script>

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
                            class="rounded-md hover:bg-gray-800 px-3 py-2 text-sm font-medium text-white">Menu</a>
                        <a href="/kelola"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-800 hover:text-white">Kelola menu</a>

                        <a href="/pendapatan"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-800 hover:text-white">Pendapatan</a>



                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">


                    <div class="relative ml-3 flex gap-4">


                        <button class="action_has has_saved" aria-label="save" type="button" id="profile-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />

                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"
                                    stroke-linejoin="round"
                                    stroke-linecap="round"
                                    data-path="box"></path>
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"
                                    stroke-linejoin="round"
                                    stroke-linecap="round"
                                    data-path="line-top"></path>
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"
                                    stroke-linejoin="round"
                                    stroke-linecap="round"></path>
                            </svg>
                        </button>



                        <div id="profile-menu"
                            class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline-1 outline-black/5">
                            <a href="/akun"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300">Akun</a>
                            <!-- <a href="/test"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a> -->
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                class="block px-4 py-2 text-sm text-red-700 hover:bg-red-300"><i class="bi bi-box-arrow-left text-danger"></i>Keluar</a>

                            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>

                        </div>
                    </div>
                </div>
            </div>

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
            <a href="/landing" class="block rounded-md hover:bg-gray-800 px-3 py-2 text-base font-medium text-white">Menu</a>
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
                <!-- <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white">Settings</a> -->
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                    class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 hover:text-white"> <i class="bi bi-box-arrow-left text-white"></i>Keluar</a>

                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</nav>



<script>
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