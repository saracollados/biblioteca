@extends('app')

@section('title', 'Listado libros')

@section('content')
    <div class="mb-28 flex justify-between">
        <div>
            <a href="/crearLibroForm">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  mr-4">
                    <i class="fa fa-plus mr-2" aria-hidden="true"></i>Añadir libro
                </button>
            </a>
            <a href="/mostrarPrestamos">
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    </i>Ver Préstamos
                </button>
            </a>
        </div>
        <div>
            <a href="/mostrarLibros">
                <button class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-times mr-2" aria-hidden="true"></i>Eliminar filtros
                </button>
            </a>
        </div>
    </div>

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