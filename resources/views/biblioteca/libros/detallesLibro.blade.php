@extends('app')

@section('title', 'Detalles libro')

@section('content')
    <div class="mb-28 flex justify-between">
        <div>
            <a href="/mostrarLibros" class="">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                    Atrás
                </button>
            </a>
        </div>
        <div class="flex">
            @if (auth()->user() != null && auth()->user()->role == 'admin')
                <a href="/editarLibroForm/{{$libro->id}}" class="">
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-4 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
                        Editar
                    </button>
                </a>

                <a href="/eliminarLibro/{{$libro->id}}">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded flex">
                        {{-- <i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                        Eliminar
                    </button>
                </a>
            @endif
        </div>
    </div>

    <div class="flex justify-between mb-6">
        <div class="w-3/4">
            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Título:</label>
            <input name="titulo" type="text" id="titulo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$libro->titulo}}" disabled>
        </div>
        <div class="w-1/6">
            <label for="año_publicacion" class="block mb-2 text-sm font-medium text-gray-900">Año de publicación:</label>
            <input name="año_publicacion" type="text" id="año_publicacion" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$libro->año_publicacion}}" disabled>
        </div>
    </div>
    <div class="flex justify-between mb-6">
        <div class="w-3/4">
            <label for="autor" class="block mb-2 text-sm font-medium text-gray-900">Autor:</label>
            <input name="autor" type="text" id="autor" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$libro->autor}}" disabled>
        </div>
        <div class="w-1/6">
            <label for="genero" class="block mb-2 text-sm font-medium text-gray-900">Género:</label>
            <input name="genero" type="text" id="genero" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{($libro->genero == '1' ? 'Suspense' : ($libro->genero == '2' ? 'Infantil' : ($libro->genero == '3' ? 'Juvenil' : ($libro->genero == '4' ? 'Histórica' : 'Poesía'))))}}" disabled>
        </div>
    </div>
    <div class="flex justify-between">
        <div  class="flex">
            <p class="mr-4 text-sm font-medium text-gray-900">Disponible:</p>
            <div class="flex items-center mr-4">
                <input id="si" type="radio" name="disponible" value=1 class="w-4 h-4 border-gray-300 disabled:bg-slate-200" {{$libro->disponible == 1 ? 'checked' : ''}} disabled>
                <label for="si" class="block ml-2 text-sm font-medium text-gray-900">Sí</label>
            </div>
            <div class="flex items-center">
                <input id="no" type="radio" name="disponible" value=0 class="w-4 h-4 border-gray-300 disabled:bg-slate-200" {{$libro->disponible == 0 ? 'checked' : ''}} disabled>
                <label for="no" class="block ml-2 text-sm font-medium text-gray-900">No</label>
            </div>
        </div>
    </div>
@endsection