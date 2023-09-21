@extends('app')

@section('title', 'Añadir préstamo')

@section('content')

    <div class="mb-28">
        <a href="/mostrarPrestamos" class="w-1/4">
            <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded flex">
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

    <form action="{{route('crearPrestamo')}}" method="POST" autocomplete='off'>
        @csrf
        
        <div class="flex justify-between mb-6">
            <div class="w-3/4">
                <label for="id_libro" class="block mb-2 text-sm font-medium text-gray-900">Libro:</label>
                @if (isset($libros))
                    <select name="id_libro" id="id_libro" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
                        {{-- Los libros que no están disponibles están deshabilitados, a parte se ha hecho la comprobación también en el back en la función crearPrestamo --}}
                        <option value="" selected disabled>Seleccione un libro</option>
                        @foreach ($libros as $libro)
                            <option value="{{$libro->id}}" {{$libro->disponible == 0 ? 'disabled' : ''}}>{{$libro->titulo}}</option>
                        @endforeach
                    </select>
                @elseif (isset($libro))
                    <input name="titulo" type="text" id="titulo_text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$libro->titulo}}" disabled>
                    <input name="id_libro" type="hidden" id="id_libro" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{$libro->id}}">
                @endif
            </div>
            <div class="w-1/6">
                <label for="fecha_prestamo" class="block mb-2 text-sm font-medium text-gray-900">Fecha préstamo:</label>
                {{-- Debido a que al devolver un préstamo se asigna directamente la fecha actual, no se permiten crear préstamos con fecha futura para evitar tener préstamos con
                    una fecha de devolución menor que fecha de apertura, esta comprobación también se hace en el back en la función crearPrestamo --}}
                <input name="fecha_prestamo" type="date" id="fecha_prestamo" max="{{date('Y-m-d')}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
            </div>
        </div>
        <div class="flex justify-between mb-6">
            <div class="w-3/4">
                <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900">Usuario:</label>
                @if (auth()->user() != null && auth()->user()->role == 'admin')
                    <select name="id_user" id="id_user" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50" required>
                        {{-- Los libros que no están disponibles están deshabilitados, a parte se ha hecho la comprobación también en el back en la función crearPrestamo --}}
                        <option value="" selected disabled>Seleccione un usuario</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{$usuario->id}}" >{{$usuario->name}}</option>
                        @endforeach
                    </select>
                @elseif (auth()->user() != null && auth()->user()->role == 'user')
                    <input name="user" type="text" id="user_text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{auth()->user()->name}}" disabled>
                    <input name="id_user" type="hidden" id="id_user" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 disabled:bg-slate-200" value="{{auth()->user()->id}}">
                @endif
            </div>
        </div>

        <div class="mt-10 text-center">
            <button type="submit" class=" bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Añadir préstamo
            </button>
        </div>
    </form>
@endsection