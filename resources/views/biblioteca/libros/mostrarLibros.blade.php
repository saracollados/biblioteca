@extends('app')

@section('title', 'Listado libros')

@section('content')
    <div class="mb-28 flex justify-between">
        <div class="flex">
            @auth          
                @if (auth()->user() != null && auth()->user()->role == 'admin')
                    <a href="/crearLibroForm">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                            Añadir libro
                        </button>
                    </a>
                @endif
                <a href="/mostrarPrestamos">
                    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        </i>Ver Préstamos
                    </button>
                </a>
            @endauth
        </div>
        <div>
            <a href="/mostrarLibros">
                <button class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded flex">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    Eliminar filtros
                </button>
            </a>
        </div>
    </div>

    @if (isset($errorMessage))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-10" role="alert">
            <span class="block sm:inline">{{$errorMessage}}</span>
        </div>
    @endif

    <div class="mb-12">
        <form action="{{route('filtrarLibros')}}" method="post" autocomplete="off">
            @csrf
            <div class="flex justify-between">
                <input type="text" name="titulo" placeholder="Título" value="{{isset($request->titulo) ? $request->titulo : ''}}" class="block w-1/6 p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" >
                <input type="text" name="autor" placeholder="Autor" value="{{isset($request->autor) ? $request->autor : ''}}" class="block w-1/6 p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                <input type="text" name="año_publicacion" value="{{isset($request->año_publicacion) ? $request->año_publicacion : ''}}" placeholder="Año publicación" class="block w-1/6 p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                <select name="genero" id="genero" class="block w-1/6 p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                    <option value="" selected disabled>Género</option>
                    <option value="1" {{(isset($request->genero) && $request->genero == '1') ? 'selected' : ''}}>Suspense</option>
                    <option value="2" {{(isset($request->genero) && $request->genero == '2') ? 'selected' : ''}}>Infantil</option>
                    <option value="3" {{(isset($request->genero) && $request->genero == '3') ? 'selected' : ''}}>Juvenil</option>
                    <option value="4" {{(isset($request->genero) && $request->genero == '4') ? 'selected' : ''}}>Histórica</option>
                    <option value="5" {{(isset($request->genero) && $request->genero == '5') ? 'selected' : ''}}>Poesía</option>
                </select>
                <select name="disponible" id="disponible" class="block w-1/6 p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                    <option value="" selected disabled>Disponibilidad</option>
                    <option value="si" {{(isset($request->disponible) && $request->disponible == 'si') ? 'selected' : ''}}>Disponible</option>
                    <option value="no" {{(isset($request->disponible) && $request->disponible == 'no') ? 'selected' : ''}}>No disponible</option>
                </select>
                <button type="submit" class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    @if (isset($error))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-10" role="alert">
            <span class="block sm:inline">Ese libro no está disponible</span>
        </div>
    @endif

    @if ($libros->isEmpty())
        <div class="text-center">
            <p >No hay libros</p>
        </div>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded">
            <table class="w-full text-sm text-centre text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-blue-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Título</th>
                        <th scope="col" class="px-6 py-3">Autor</th>
                        <th scope="col" class="px-6 py-3">Año de publicación</th>
                        <th scope="col" class="px-6 py-3">Género</th>
                        <th scope="col" class="px-6 py-3">Disponible</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @each('components/tableLibros', $libros, 'item')
                </tbody>
            </table>
        </div>
    @endif

@endsection