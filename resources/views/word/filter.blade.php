@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5 mb-3"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div>
            <h2 class="mb-3 text-center"><b>MIS TRADUCCIONES</b></h2>
            @if (session('update_success'))
                <h6 class="alert alert-success">{{ session('update_success') }}</h6>
            @endif

            <div class="row dropdown my-2">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="dropdown-name">{{ $dropdownName }}</span>
                </button>
                <ul class="dropdown-menu">
                    <form action="{{ route('word.index') }}" method="get">
                        <li class="dropdown-item" data-category-id="0" style="color: gray">
                            <button class="btn">Todas las categorías</button>
                        </li>
                    </form>
                    @foreach ($categories as $category)
                        @if ($category->language_id === session('selected_language_id'))
                            <form action="{{ route('word.filter', ['category' => $category->id]) }}" method="post">
                                @csrf
                                <li class="dropdown-item" data-category-id="{{ $category->id }}"
                                    style="color:{{ $category->color }}">
                                    <button class="btn">{{ $category->category }}</button>
                                </li>
                            </form>
                        @endif
                    @endforeach
                </ul>
            </div>

            @foreach ($words as $word)
                @if ($word->language_id === session('selected_language_id'))
                    <div class="row py-3 px-2" style="background-color: white; border-radius:4px">
                        <div class="col-md-9 d-flex align-items-center">
                            <a class="style-link-index" href="{{ route('word.show', ['word' => $word->id]) }}">{{ $word->word }}</a>
                        </div>

                        <div class="modal fade" id="modal-{{ $word->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar palabra</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar la palabra <b>{{ $word->word }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('word.destroy', [$word->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $word->id }}">Eliminar</button>
                        </div>

                        <div class="col-md-9 d-flex justify-content-start pt-2">
                            <div class="text-muted">{{ $word->example }}</div>
                        </div>
                        @foreach ($categories as $category)
                            @if ($category->id === $word->category_id)
                                <div class="col-md-9 d-flex align-items-center pt-2">
                                    <p class="d-flex align-items-center gap-2">Categoría:
                                        <span class="color-container"
                                            style="background-color: {{ $category->color }}; border-radius: 100%; width: 20px; height: 20px;"></span>{{ $category->category }}
                                    </p>
                                </div>
                            @endif
                        @endforeach

                        <div class="col-md-9 d-flex align-items-center pt-2">
                            <p class="d-flex align-items-center gap-2">Traducciones:</p>
                            <ul>
                                @foreach ($translations as $translation)
                                    @if ($translation->word_id === $word->id)
                                        <li>{{ $translation->translation }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
