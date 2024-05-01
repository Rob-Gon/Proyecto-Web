@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <form action="{{ route('word.store') }}" method="post" id="wordCreateForm">
            @csrf
            <h2 class="mb-3 text-center"><b>NUEVA TRADUCCIÓN</b></h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="word" id="word" placeholder="..." required>
                <label for="word">Palabra</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="example" id="example" placeholder="..." style="height:100px" required></textarea>
                <label for="example">Frase de ejemplo</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="category_id" id="category_id" required>
                    @foreach ($categories as $category)
                        @if ($category->language_id === session('selected_language_id'))
                            <option style="color: {{ $category->color }};" value="{{ $category->id }}">
                                {{ $category->category }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <label for="category_id" class="form-label">Categoría</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="translation" id="translation" placeholder="..." required>
                <label for="translation">Traducción</label>
            </div>

            <input type="hidden" name="language_id" value="{{ session('selected_language_id') }}">

            @if (session('store_success'))
                <h6 class="alert alert-success">{{ session('store_success') }}</h6>
            @endif

            @error('word')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('translation')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('category_id')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <button type="button" class="btn btn-primary mt-3" onclick="validateWordCreate()">Crear traducción</button>
        </form>
    </section>
@endsection
