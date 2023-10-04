<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    *{
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }
    .cart-btn{
        width: 35px;
        height:35px;
        padding: 5px;
    }
    .cart-btn:hover{
        background-color: rgb(207, 207, 207);
        cursor:pointer;
        transform: scale(1.1);
        transition: transform 0.5s;
        border-radius: 50%;
    }

    .app{
        overflow: hidden;
    }
</style>
<body>
    <div id="app" class="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ 'Marketplace' }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <div style="display: flex; align-items:center; gap: 10px;">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                <img src="{{Auth::user()->photo}}" alt="" style="
                                    border-radius: 50%;
                                    margin-top:-3px;
                                    width: 50px;
                                    height:30px;">

                                    {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @role('admin')
                                    <a class="dropdown-item" href="{{ route('users.index') }}">
                                        {{ __('Users') }}
                                    </a>
                                    @endrole

                                    @role('admin')
                                    <a class="dropdown-item" href="{{ route('categories.index') }}">
                                        {{ __('Categories') }}
                                    </a>
                                    @endrole
                                    
                                    @role('admin')
                                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                        {{ __('Products') }}
                                    </a>
                                    @endrole


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <a href="/cart">
                                <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" alt=""
                                     class="cart-btn">
                                </div>
                            </a>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
