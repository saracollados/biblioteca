<tr  class="bg-white border-b">
    <td class="px-6 py-4 text-center">{{$item->titulo}}</td>
    <td class="px-6 py-4 text-center">{{$item->user}}</td>
    <td class="px-6 py-4 text-center">{{$item->fecha_prestamo}}</td>
    <td class="px-6 py-4 text-center">{{$item->fecha_devolucion ? $item->fecha_devolucion : ''}}</td>
    <td class="px-6 py-4 text-center">
        <a href="/detallesPrestamo/{{$item->id}}">
            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" title="Ver préstamo">
                <i class="fa fa-eye" aria-hidden="true"></i></i>
            </button>
        </a>
        @if(!$item->fecha_devolucion)
            <a href="/cerrarPrestamo/{{$item->id}}">
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" title="Cerrar préstamo">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </a>
        @endif
    </td>
</tr>