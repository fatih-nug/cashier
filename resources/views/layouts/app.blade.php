<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        .navbar-nav .nav-link,
        .main-menu .menu-item a {
            position: relative;
            transition: color 0.3s ease, transform 0.2s ease;
            padding: 8px 15px;
            margin: 0 2px;
            border-radius: 4px;
        }
        
        .navbar-nav .nav-link:hover,
        .main-menu .menu-item a:hover {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .navbar-nav .nav-link::after,
        .main-menu .menu-item a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #007bff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .navbar-nav .nav-link:hover::after,
        .main-menu .menu-item a:hover::after {
            width: 80%;
        }
        
        .navbar-nav .nav-link:active,
        .main-menu .menu-item a:active {
            transform: scale(0.95);
            background-color: rgba(0, 123, 255, 0.2);
        }
        
        .dropdown-menu {
            transform-origin: top center;
            animation: dropdownAnimation 0.3s ease forwards;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border: none;
            border-radius: 8px;
        }
        
        @keyframes dropdownAnimation {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            transition: all 0.2s ease;
            padding: 8px 20px;
        }
        
        .dropdown-item:hover {
            background-color: rgba(0, 123, 255, 0.1);
            padding-left: 25px;
        }
    </style>
</head>

<body>
    @if (!Route::is('login') && !Route::is('register') && !Route::is('password.request'))
    <header class="site-header mb-4">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div class="site-branding">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h1 class="fs-4 fw-bold text-primary m-0">{{ config('app.name', 'SistemKu') }}</h1>
                    </a>
                </div>
                
                <button class="menu-toggle btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#mainNavigation">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="collapse d-md-block" id="mainNavigation">
                    <div class="d-md-flex">
                        <!-- Menu Utama -->
                        <ul class="main-menu list-unstyled d-flex mb-0 me-4">
                            <li class="menu-item px-2"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                            <li class="menu-item px-2"><a href="{{ route('kategori.index') }}" class="text-decoration-none">Kategori</a></li>
                            <li class="menu-item px-2"><a href="{{ route('produk.index') }}" class="text-decoration-none">Produk</a></li>
                            <li class="menu-item px-2"><a href="{{ route('cart.index') }}" class="text-decoration-none">Keranjang</a></li>
                            <li class="menu-item px-2"><a href="{{ route('histori.index') }}" class="text-decoration-none">Riwayat</a></li>
                        </ul>
                        
                        <!-- User Menu -->
                        <div class="user-menu ms-auto">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary me-2">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Daftar</a>
                                @endif
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                                                Keluar
                                            </a>
                                            <form id="form-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @endif

    <main class="site-content py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>

