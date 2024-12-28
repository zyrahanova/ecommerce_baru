<nav class=" bg-[#454545] w-full z-20 top-0 start-0 border-b border-[#454545]">
    <div class="max-w-screen-xl mx-auto p-4 flex items-center justify-between">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse ">
            <img src="{{ asset('assets/logo/cart.png') }}" class="h-10" alt="Flowbite Logo" />
            <span class="text-center text-white">GoSaint<sup>25</sup></span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <div class="relative">
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" type="button"
                    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 text-center bg-amber-400 hover:bg-blue-700 focus:ring-blue-800">
                    <svg class="w-[24px] h-[24px]  text-white block mx-auto" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
                            clip-rule="evenodd" />
                    </svg>
                    @auth
                        {{ auth()->user()->name }}
                    @else
                        Login/Register
                    @endauth
                </button>
                <div id="dropdownNavbar"
                    class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-700">
                    <ul class="py-2 text-sm text-gray-200" aria-labelledby="dropdownNavbarLink">
                        @auth
                        <li>
                          <button type="button" onclick="window.location.href='/user-cart'"
                              class="block px-4 py-2 hover:bg-gray-600 hover:text-white">
                              Keranjang
                          </button>
                      </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Logout</button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="block px-4 py-2  hover:bg-gray-600 hover:text-white">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden  focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
    </div>
</nav>
