<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet" /> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-bounding-box text-primary fw-bold fs-3"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item ">
                                    <a class="nav-link text-primary" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <ul class="nav">
                                <li class="nav-item me-2 ">
                                    <a href="#" class="nav-link" aria-current="true">
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item me-2">
                                    <a href="{{ route('income.index') }}" class="nav-link {{request()->is('income*') ? 'active' : ''}}">
                                        <span>Income</span>
                                    </a>
                                </li>
                                <li class="nav-item me-2">
                                    <a href="{{ route('expense.index') }}" class="nav-link {{request()->is('expense*') ? 'active' : ''}}">
                                        <span>Expense</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <div role="button" class="dropdown-toggle btn btn-outline-primary"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-check fs-5 me-1"></i>
                                        <span>{{ Auth::user()->name }}</span>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-primary" href="#">
                                                <i class="bi bi-pencil me-2"></i>
                                                <span>Edit Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-left me-2"></i>
                                                <span>{{ __('Logout') }}</span>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @auth
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                @yield('content')
            @endauth

        </main>
    </div>
    @stack('script')
    <script>
        @if (session('message'))
            window.alert("{{ session('message') }}")
        @endif
    </script>


</body>

</html>
