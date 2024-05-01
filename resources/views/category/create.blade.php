@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="row mx-auto">
            <form action="{{ route('category.store') }}" method="post" id="categoryForm">
                @csrf
                <h2 class="mb-3 text-center"><b>NUEVA CATEGORÍA</b></h2>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="category" name="category" placeholder="...">
                    <label for="category">Categoría</label>
                </div>
                <div class="form-control mb-3">
                    <label for="color" class="form-label pt-2">Color</label>
                    <input type="color" class="form-control" id="color" name="color">
                </div>

                <input type="hidden" name="language_id" value="{{ session('selected_language_id') }}">

                @if (session('store_success'))
                    <h6 class="alert alert-success">{{ session('store_success') }}</h6>
                @endif
                @error('category')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror

                <button type="button" class="btn btn-primary" onclick="validateCategory()">Crear categoría</button>
            </form>
        </div>
    </section>
@endsection
