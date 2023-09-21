@extends('app')

@section('title', 'Listado préstamos')

@section('content')
    <div class="mb-28 flex justify-between">
        <div class="flex">
            <a href="/crearPrestamoForm">

                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded mr-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                    Añadir préstamo
                </button>
            </a>
            <a href="/mostrarLibros">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    </i>Ver Libros
                </button>
            </a>
        </div>
        <div>
            <a href="/mostrarPrestamos">
                <button class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded flex">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="mt-1 mr-2" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    Eliminar filtros
                </button>
            </a>
        </div>
    </div>

    <div class="mb-12">
        <form action="{{route('filtrarPrestamos')}}" method="post" autocomplete="off">
            @csrf

            <div class="flex justify-between">
                <div class="mr-4 w-1/6">
                    <label for="titulo" class="block mb-2 text-sm font-medium text-transparent">Título:</label>
                    <input type="text" name="titulo" placeholder="Título" value="{{isset($request->titulo) ? $request->titulo : ''}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 mr-4" >
                </div>
                <div class="mr-4 w-1/6">
                    <label for="usuario" class="block mb-2 text-sm font-medium text-transparent">Usuario:</label>
                    <input type="text" name="usuario" placeholder="Usuario" value="{{isset($request->usuario) ? $request->usuario : ''}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                </div>
                <div class="mr-4 w-1/6">
                    <label for="fecha_prestamo_desde" class="block mb-2 text-sm font-medium text-gray-900">Préstamo desde:</label>
                    <input type="date" name="fecha_prestamo_desde" value="{{isset($request->fecha_prestamo_desde) ? $request->fecha_prestamo_desde : ''}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                </div>
                <div class="mr-4 w-1/6">
                    <label for="fecha_prestamo_hasta" class="block mb-2 text-sm font-medium text-gray-900">Préstamo hasta:</label>
                    <input type="date" name="fecha_prestamo_hasta" value="{{isset($request->fecha_prestamo_hasta) ? $request->fecha_prestamo_hasta : ''}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                </div>
                <div class="mr-4 w-1/6">
                    <label for="devuelto" class="block mb-2 text-sm font-medium text-transparent">Devuelto</label>
                    <select name="devuelto" id="devuelto" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50">
                        <option value="" selected disabled>¿Devuelto?</option>
                        <option value="si" {{(isset($request->devuelto) && $request->devuelto == 'si') ? 'selected' : ''}}>Devuelto</option>
                        <option value="no" {{(isset($request->devuelto) && $request->devuelto == 'no') ? 'selected' : ''}}>No devuelto</option>
                    </select>
                </div>
                <div class="">
                    <label for="button" class="block mb-2 text-sm font-medium text-transparent">button</label>
                    <button type="submit" class=" bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if ($prestamos->isEmpty())
        <div class="text-center">
            <p >No hay prestamos</p>
        </div>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded">
            <table class="w-full text-sm text-centre text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-purple-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Libro</th>
                        <th scope="col" class="px-6 py-3">Usuario</th>
                        <th scope="col" class="px-6 py-3">Fecha préstamo</th>
                        <th scope="col" class="px-6 py-3">Fecha devolución</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @each('components/tablePrestamos', $prestamos, 'item')
                </tbody>
            </table>
        </div>
    @endif

@endsection