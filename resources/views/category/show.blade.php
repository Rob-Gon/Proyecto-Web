@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post" id="categoryForm">
            @csrf
            @method('patch')
            <h2 class="mb-3 text-center"><b>CATEGORÍA</b></h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="category" name="category" value="{{ $category->category }}">
                <label for="category">Categoría</label>
            </div>
            <div class="form-control mb-3">
                <label for="color" class="form-label pt-2">Color</label>
                <input type="color" class="form-control" id="color" name="color" value="{{ $category->color }}">
            </div>

            @error('category')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <button type="button" class="btn btn-primary" onclick="validateCategory()">Actualizar categoría</button>
        </form>
    </section>
@endsection
