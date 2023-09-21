@extends('app')

@section('title', 'Detalles libro')

@section('content')
    <div class="mb-28 flex justify-between">
        <div>
            <a href="/mostrarPrestamos" class="">
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded flex">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                    Atrás
                </button>
            </a>
        </div>
        @if (!isset($prestamo->fecha_devolucion))
            <div>
                <a href="/cerrarPrestamo/{{$prestamo->id}}">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded flex">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                        Cerrar
                    </button>
                </a>
            </div>
        @endif
    </div>

    @if (isset($errorMessage))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-10" role="alert">
            <span class="block sm:inline">{{$errorMessage}}</span>
        </div>
    @endif

    <div class="flex justify-between mb-6">
        <div class="w-3/4">
            <label for="id_libro" class="block mb-2 text-sm font-medium text-gray-900">Libro:</label>
            <input name="titulo" type="text" id="titulo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->titulo}}" disabled>
        </div>
        <div class="w-1/6">
            <label for="fecha_prestamo" class="block mb-2 text-sm font-medium text-gray-900">Fecha préstamo:</label>
            <input name="fecha_prestamo" type="date" id="fecha_prestamo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->fecha_prestamo}}" disabled>
        </div>
    </div>
    <div class="flex justify-between mb-6">
        <div class="w-3/4">
            <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900">Usuario:</label>
            <input name="usuario" type="text" id="usuario" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->user_name}}" disabled>
            <input name="user_id" type="hidden" id="iser_id" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->user_id}}" disabled>
        </div>
        @if (isset($prestamo->fecha_devolucion))
            <div class="w-1/6">
                <label for="fecha_prestamo" class="block mb-2 text-sm font-medium text-gray-900">Fecha devolución:</label>
                <input name="fecha_prestamo" type="date" id="fecha_prestamo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->fecha_devolucion}}" disabled>
            </div>
        @endif
    </div>
@endsection