@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <form action="{{ route('language.select') }}" method="post">
            @csrf
            <h2 class="mb-3 text-center"><b>LENGUAJES</b></h2>
            <div class="form-floating mb-3">
                <select class="form-select" name="language_id">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" required> {{ $language->language }} </option>
                    @endforeach
                </select>
                <label for="language_id" class="form-label">Lenguajes</label>
            </div>
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            <button type="submit" class="btn btn-primary mt-3">Seleccionar</button>
        </form>
    </section>
@endsection
