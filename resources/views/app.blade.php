<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Index</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/functions.js') }}" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href={{ asset('css/app.css') }} rel="stylesheet">
    <link href={{ asset('css/links.css') }} rel="stylesheet">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>

<body>
    <nav id="menu" class="navbar navbar-expand-lg " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 1.5px 10px;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 pointer-default">
                <img src="{{ asset('favicon.ico') }}" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                Index
            </span>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <a class="navbar-brand style-link-navbar" href={{ route('word.index') }}>Mis traducciones</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand style-link-navbar" href={{ route('category.index') }}>Mis categorías</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Agregar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href={{ route('word.create') }}>
                                    <svg class="w-[12px] h-[12px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 2 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                    </svg>
                                    Nueva traducción
                                </a> 
                            </li>
                            <li>
                                <a class="dropdown-item" href={{ route('category.create') }}>
                                    <svg class="w-[12px] h-[12px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 2 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                    </svg>
                                    Nueva categoría
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="navbar-nav ml-auto">
                @if (session('user_id'))
                    <div id="navbarNav" class="collapse navbar-collapse pointer-default">
                        @if (session('selected_language_flag'))
                        <a class="navbar-brand style-link-navbar" href={{ route('language.index') }}>
                            <span class="navbar-brand mb-0 h1">
                                <img src="{{ asset('images/flags/'.session('selected_language_flag').'') }}"
                                    alt="Language flag" width="30" height="24"
                                    class="d-inline-block align-text-top"
                                    style="border: 1px solid lightgray; border-radius: 50%">
                                {{ session('selected_language_name') }}
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 2 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16h13M4 16l4-4m-4 4 4 4M20 8H7m13 0-4 4m4-4-4-4"/>
                                </svg>
                            </span>
                        </a>
                        @endif
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <span class="nav-link">Bienvenido, {{ session('user_name') }}</span>
                            </li>
                            <li class="nav-item style-link-index">
                                <a class="nav-link" onclick="return logout()" style="cursor: pointer;">Cerrar sesión</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item style-link-index">
                                <a class="nav-link" href="{{ route('register.index') }}">Registrarse</a>
                            </li>
                            <li class="nav-item style-link-index">
                                <a class="nav-link" href="{{ route('login.index') }}">Iniciar sesión</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>


    @yield('content')

</body>

</html>
