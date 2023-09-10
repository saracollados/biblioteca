@extends('app')

@section('title', 'Listado préstamos')

@section('content')
    <div class="mb-28 flex justify-between">
        <div>
            <a href="/crearPrestamoForm">
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded mr-4">
                    <i class="fa fa-plus mr-2" aria-hidden="true"></i>Añadir Préstamo
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
                <button class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-times mr-2" aria-hidden="true"></i>Eliminar filtros
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