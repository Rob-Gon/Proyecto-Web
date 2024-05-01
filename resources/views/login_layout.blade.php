<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/functions.js') }}" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href={{ asset('css/app.css') }} rel="stylesheet">
    <link href={{ asset('css/login.css') }} rel="stylesheet">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>

<body>

    <nav id="menu" class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex justify-content-center">
            <span class="navbar-brand mb-0 h1 pointer-default">
                <img src="{{ asset('favicon.ico') }}" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                Index
            </span>
        </div>
    </nav>

    @yield('content')

</body>

</html>