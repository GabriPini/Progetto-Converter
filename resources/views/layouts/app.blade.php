<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container ">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- logo ricavato dal file figma --}}
                        <img src="{{asset('img/logo.png')}}" alt="">
                        <img src="{{asset('img/logo-name.png')}}" alt="">

                    </a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- link per le varie sezioni del sito (al momoento iplementazione solo della Home) --}}
                    <ul class="navbar-nav mx-auto gap-4 ">
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="#">{{ __('About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="#">{{ __('Prezzi') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="#">{{ __('Contatti') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto gap-3">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fw-bold bg-custom rounded" href="{{ route('register') }}">{{ __('Registrati') }}<i class=" fw-bolder ps-1  fa-solid fa-xs  fa-angle-right"></i></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item fw-bold" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-footer">
            <div class="">
                <div class="container pt-5 d-flex justify-content-between">

                    <div class="navbar-brand me-5 ">
                        {{-- logo ricavato dal file figma --}}
                        <img src="{{asset('img/logo2.png')}}" alt="">
                        <img src="{{asset('img/logo-name2.png')}}" alt="">

                        <p class="mt-4"> Converte file, documenti, immagini, video, <br>
                            audio, siti web e altro ancora online.</p>
                            <span>info@convertydocs.com</span>

                    </div>


                        <div class="col d-flex flex-column mt-2">
                            <h6>Navigazione</h6>
                            <a class="mt-4" href="#">Home</a>
                            <a href="#">About</a>
                            <a href="#">Prezzi</a>
                            <a href="#">Contatto</a>
                        </div>
                        <div class="col d-flex flex-column mt-2">
                            <h6>Account</h6>
                            <a class="mt-4" href="#">Account</a>
                            <a href="#">File</a>
                            <a href="#">Registrati</a>
                            <a href="#">Accedi</a>
                            <a href="#">Annulla l'iscrizione</a>
                        </div>
                        <div class="col d-flex flex-column mt-2">
                            <h6>Politiche</h6>
                            <a class="mt-4" href="#">infomativa privacy</a>
                            <a href="#">Condizioni d'uso</a>
                            <a href="#">Impostazioni cookie</a>

                        </div>
                    </div>
                    <div class="container ">
                        <hr >
                        <div class="d-flex justify-content-center">
                            <span class="text-center ms-auto"> © Doc Converter 2022</span>
                            <span class="ms-auto"> <i class="fa-solid fa-globe pe-1"></i>  italiano  <i class="fa-solid fa-sm fa-angle-up ps-1"></i></span>

                        </div>
                    </div>


            </div>
        </footer>
    </div>
</body>
</html>
