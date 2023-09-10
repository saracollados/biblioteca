@extends('app')

@section('title', 'Detalles libro')

@section('content')
    <div class="mb-28 flex justify-between">
        <div>
            <a href="/mostrarLibros" class="">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Atrás
                </button>
            </a>
        </div>
        <div>
            <a href="/editarLibroForm/{{$libro->id}}" class="">
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-4">
                    <i class="fa fa-pencil mr-2" aria-hidden="true"></i>Editar
                </button>
            </a>

            <a href="/eliminarLibro/{{$libro->id}}">
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar
                </button>
            </a>
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