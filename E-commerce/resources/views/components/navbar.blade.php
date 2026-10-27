<nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
    <div class="container">
        <!-- Brand / Logo -->
        <a class="navbar-brand text-dark d-flex align-items-center gap-2 fw-semibold fs-6" href="{{ url('/') }}">
            <i class="fa-brands fa-xl text-dark"></i>
            <span>AppStore</span>
        </a>

        <!-- Tombol Navbar di Kanan -->
        <div class="d-flex align-items-center gap-2">
            @auth
                <!-- Tampil jika SUDAH LOGIN: Cart & Dashboard/Logout (Opsional) -->
                <a href="{{ url('/cart') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    Cart
                </a>
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-sm rounded-pill px-3">
                    Dashboard
                </a>
            @endauth

            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                        Log in
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-dark btn-sm rounded-pill px-3">
                        Register
                    </a>
                @endif
            @endguest
        </div>
    </div>
</nav>