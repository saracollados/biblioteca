@extends('app')

@section('title', 'Detalles libro')

@section('content')
    <div class="mb-28 flex justify-between">
        <a href="/mostrarLibros" class="">
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

    <form action="{{route('editarLibro')}}" method="POST" autocomplete='off'>
        @csrf
        <div class="flex justify-between mb-6">
            <div class="w-3/4">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Título:</label>
                <input name="titulo" type="text" id="titulo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" value="{{$libro->titulo}}">
            </div>
            <div class="w-1/6">
                <label for="año_publicacion" class="block mb-2 text-sm font-medium text-gray-900">Año de publicación:</label>
                <input name="año_publicacion" type="text" id="año_publicacion" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" value="{{$libro->año_publicacion}}">
            </div>
        </div>
        <div class="flex justify-between mb-6">
            <div class="w-3/4">
                <label for="autor" class="block mb-2 text-sm font-medium text-gray-900">Autor:</label>
                <input name="autor" type="text" id="autor" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" value="{{$libro->autor}}">
            </div>

            <div class="w-1/6">
                <label for="genero" class="block mb-2 text-sm font-medium text-gray-900">Género:</label>
                <select name="genero" id="genero" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
                    <option value="1" {{$libro->genero == '1' ? 'selected' : ''}}>Suspense</option>
                    <option value="2" {{$libro->genero == '2' ? 'selected' : ''}}>Infantil</option>
                    <option value="3" {{$libro->genero == '3' ? 'selected' : ''}}>Juvenil</option>
                    <option value="4" {{$libro->genero == '4' ? 'selected' : ''}}>Histórica</option>
                    <option value="5" {{$libro->genero == '5' ? 'selected' : ''}}>Poesía</option>
                </select>
            </div>
        </div>
        <div class="flex justify-between">
            <div  class="flex">
                <p class="mr-4 text-sm font-medium text-gray-900">Disponible:</p>
                <div class="flex items-center mr-4">
                    <input id="si" type="radio" name="disponible" value=1 class="w-4 h-4 border-gray-300" {{$libro->disponible == 1 ? 'checked' : ''}} disabled>
                    <label for="si" class="block ml-2 text-sm font-medium text-gray-900">Sí</label>
                </div>
                <div class="flex items-center">
                    <input id="no" type="radio" name="disponible" value=0 class="w-4 h-4 border-gray-300" {{$libro->disponible == 0 ? 'checked' : ''}} disabled>
                    <label for="no" class="block ml-2 text-sm font-medium text-gray-900">No</label>
                </div>
            </div>
        </div>

        <div class="mt-10 text-center">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Actualizar libro
            </button>
        </div>
    </form>
@endsection