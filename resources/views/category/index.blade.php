@extends('app')

@section('content')
    <section class="container w-25 border p-4 mt-5"
        style="border-radius: 4px; background-color:whitesmoke; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div>
            <h2 class="mb-3 text-center"><b>CATEGORÍAS</b></h2>
            @if (session('update_success'))
                <h6 class="alert alert-success">{{ session('update_success') }}</h6>
            @endif
            @foreach ($categories as $category)
                @if ($category->language_id === session('selected_language_id'))
                    <div class="row py-3 px-2" style="background-color: white; border-radius:4px">
                        <div class="col-md-9 d-flex align-items-center">
                            <a class="d-flex align-items-center gap-2 style-link-index"
                                href="{{ route('category.show', ['category' => $category->id]) }}">
                                <span class="color-container"
                                    style="background-color: {{ $category->color }}; border-radius: 100%; width: 15px; height: 15px;"></span>{{ $category->category }}
                            </a>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $category->id }}">Eliminar</button>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-{{ $category->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar categoria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de eliminar la categoría <b>{{ $category->category }}</b>? Todas las
                                    palabras
                                    asociadas a la categoría se eliminaran.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('category.destroy', [$category->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
