@extends('app')

@section('title', 'Añadir libro')

@section('content')

    <div class="mb-28">
        <a href="/mostrarLibros" class="w-1/4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                Atrás
            </button>
        </a>
    </div>
    @if (isset($errorMessage))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-10" role="alert">
            <span class="block sm:inline">{{$errorMessage}}</span>
        </div>
    @endif
    <form action="{{route('crearLibro')}}" method="POST" autocomplete='off'>
        @csrf
        
        <div class="flex justify-between mb-6">
            <div class="w-3/4">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Título:</label>
                <input name="titulo" type="text" id="titulo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
            </div>
            <div class="w-1/6">
                <label for="año_publicacion" class="block mb-2 text-sm font-medium text-gray-900">Año de publicación:</label>
                <input name="año_publicacion" type="text" id="año_publicacion" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
            </div>
        </div>
        <div class="flex justify-between mb-6">
            <div class="w-3/4">
                <label for="autor" class="block mb-2 text-sm font-medium text-gray-900">Autor:</label>
                <input name="autor" type="text" id="autor" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
            </div>
            <div class="w-1/6">
                <label for="genero" class="block mb-2 text-sm font-medium text-gray-900">Género:</label>
                <select name="genero" id="genero" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
                    <option value="" selected disabled>Seleccione un género</option>
                    <option value="1">Suspense</option>
                    <option value="2">Infantil</option>
                    <option value="3">Juvenil</option>
                    <option value="4">Histórica</option>
                    <option value="5">Poesía</option>
                </select>
            </div>
        </div>

        <div class="mt-10 text-center">
            <button type="submit" class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Añadir libro
            </button>
        </div>
    </form>
@endsection