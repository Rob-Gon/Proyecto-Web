@extends('login_layout')

@section('content')
    <section class="container w-25 border p-4 mt-3"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <form onsubmit="return login()" method="post">
            @csrf
            <h2 class="mb-3 text-center"><b>LOGIN</b></h2>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="..." required>
                <label for="user">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="..." required>
                <label for="password">Contraseña</label>
                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" onclick="togglePassword()" id="showPassword">
                    <label class="form-check-label unselectable" for="showPassword" id="showPassword-label"> 
                        <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" id="iconShowPassword" style="display: none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 1 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" id="iconHidePassword" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 1 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        Mostrar contraseña
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 w-100">Iniciar sesión</button>
        </form>
        <a class="d-flex justify-content-center" href="{{ route('register.index') }}"><button class="btn btn-secondary mt-3 w-50 ">Registrarse</button></a>
    </section>
@endsection
