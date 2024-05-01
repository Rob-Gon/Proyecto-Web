@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <form action="{{ route('word.update', ['word' => $word->id]) }}" method="post" id="wordUpdateForm">
            @csrf
            @method('patch')

            <h2 class="mb-3 text-center"><b>TRADUCCIÓN</b></h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="word" name="word" value="{{ $word->word }}"
                    placeholder="..." required>
                <label for="word">Palabra</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="example" id="example" placeholder="..." style="height:100px" required>{{ $word->example }}</textarea>
                <label for="example">Frase de ejemplo</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="category_id" name="category_id" required>
                    <option style="color: {{ $wordCategory->color }};" value="{{ $wordCategory->id }}" selected>
                        {{ $wordCategory->category }}</option>
                    @foreach ($categories as $category)
                        @if ($category->language_id === session('selected_language_id'))
                            <option style="color:{{ $category->color }};" value="{{ $category->id }}">
                                {{ $category->category }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <label for="category_id" class="form-label">Categoría</label>
            </div>

            <h3 class="mb-3"><b>Traducciones:</b></h3>
            @foreach ($translations as $key => $translation)
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="translations[{{ $translation->id }}]"
                        value="{{ $translation->translation }}" required>
                    <label for="translation[{{ $translation->id }}]">Traducción {{ $key + 1 }}</label>
                </div>
            @endforeach

            @error('word')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('translation')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('category_id')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <button type="button" class="btn btn-primary mt-3" onclick="validateWordUpdate()">Actualizar traducción</button>
        </form>
    </section>
@endsection
