<tr  class="bg-white border-b">
    <td class="px-6 py-4 text-center">{{$item->titulo}}</td>
    <td class="px-6 py-4 text-center">{{$item->autor}}</td>
    <td class="px-6 py-4 text-center">{{$item->año_publicacion}}</td>
    <td class="px-6 py-4 text-center">{{($item->genero == '1' ? 'Suspense' : ($item->genero == '2' ? 'Infantil' : ($item->genero == '3' ? 'Juvenil' : ($item->genero == '4' ? 'Histórica' : 'Poesía'))))}}</td>
    <td class="px-6 py-4 text-center">{{$item->disponible == 1 ? 'Sí' : 'No'}}</td>
    <td class="px-6 py-4 text-center">
        <a href="/detallesLibro/{{$item->id}}">
            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" title="Ver libro">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </button>
        </a>
        @if($item->disponible == 1)
            <a href="/crearPrestamoLibroForm/{{$item->id}}">
                <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded" title="Añadir préstamo">
                    <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
                </button>
            </a>
        @endif
        <a href="/eliminarLibro/{{$item->id}}">
            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" title="Eliminar libro">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
        </a>
    </td>
</tr>

