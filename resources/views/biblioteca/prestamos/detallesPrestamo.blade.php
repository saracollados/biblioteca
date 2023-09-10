@extends('app')

@section('title', 'Detalles libro')

@section('content')
    <div class="mb-28 flex justify-between">
        <div>
            <a href="/mostrarPrestamos" class="">
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Atrás
                </button>
            </a>
        </div>
        @if (!isset($prestamo->fecha_devolucion))
            <div>
                <a href="/cerrarPrestamo/{{$prestamo->id}}">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fa fa-times mr-2" aria-hidden="true"></i>Cerrar
                    </button>
                </a>
            </div>
        @endif
    </div>

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
            <input name="usuario" type="text" id="usuario" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->user}}" disabled>
        </div>
        @if (isset($prestamo->fecha_devolucion))
            <div class="w-1/6">
                <label for="fecha_prestamo" class="block mb-2 text-sm font-medium text-gray-900">Fecha devolución:</label>
                <input name="fecha_prestamo" type="date" id="fecha_prestamo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$prestamo->fecha_devolucion}}" disabled>
            </div>
        @endif
    </div>
@endsection