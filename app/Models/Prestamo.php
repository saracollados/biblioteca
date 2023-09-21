<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\User;

class Prestamo extends Model {
    use HasFactory;

    public function libro() {
        return $this->belongsTo(Libro::class, 'book_id');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAll() {
        $prestamos = DB::table('prestamos')
                        ->join('libros', 'libros.id', '=', 'prestamos.book_id')
                        ->join('users', 'users.id', '=', 'prestamos.user_id')
                        ->select('prestamos.id', 'libros.id as libro_id', 'libros.titulo', 'users.id as user_id', 'users.name as user_name', 'prestamos.fecha_prestamo', 'prestamos.fecha_devolucion')
                        ->get();
        return $prestamos;
    }

    public static function create(Request $request) {
        $prestamo = new Prestamo();
        $prestamo->book_id = $request->input('id_libro');
        $prestamo->fecha_prestamo = date('Y-m-d', strtotime($request->input('fecha_prestamo'))); 
        $prestamo->user_id = $request->input('id_user');
        $prestamo->save(); 

        return $prestamo->id;
    }

    public static function buscarPrestamoId($id) {
        $prestamo = DB::table('prestamos')
                        ->join('libros', 'libros.id', '=', 'prestamos.book_id')
                        ->join('users', 'users.id', '=', 'prestamos.user_id')
                        ->where('prestamos.id', '=', $id)
                        ->select('prestamos.id', 'libros.id as libro_id', 'libros.titulo', 'users.id as user_id', 'users.name as user_name', 'prestamos.fecha_prestamo', 'prestamos.fecha_devolucion')
                        ->get();

        return $prestamo[0];
    }
    
    public static function cerrarPrestamo($id) {
        $prestamo = Prestamo::find($id);
        $prestamo->fecha_devolucion = date('Y-m-d'); ;
        $prestamo->save();
    }

    public static function filtrarPrestamos($request) {
        $titulo = $request->input('titulo');
        $usuario = $request->input('usuario');
        $fecha_prestamo_desde = $request->input('fecha_prestamo_desde');
        $fecha_prestamo_hasta = $request->input('fecha_prestamo_hasta');
        $devuelto = $request->input('devuelto');

        $query = DB::table('prestamos')
                ->join('libros', 'libros.id', '=', 'prestamos.book_id')
                ->join('users', 'users.id', '=', 'prestamos.user_id')
                ->select('prestamos.id', 'libros.id as libro_id', 'libros.titulo', 'users.id as user_id', 'users.name as user_name', 'prestamos.fecha_prestamo', 'prestamos.fecha_devolucion');

        if ($titulo) {
            $query->where('libros.titulo', 'LIKE', '%'.$titulo.'%');
        }
        if ($usuario) {
            $query->where('prestamos.user_id', 'LIKE', '%'.$usuario.'%'); // REVISAR
        }
        if ($fecha_prestamo_desde) {
            $fecha_desde = strtotime($fecha_prestamo_desde);
            $fecha_desde = date('Y-m-d', $fecha_desde);
            $query->where('prestamos.fecha_prestamo', '>=', $fecha_desde);
        }
        if ($fecha_prestamo_hasta) {
            $fecha_hasta = strtotime($fecha_prestamo_hasta);
            $fecha_hasta = date('Y-m-d', $fecha_hasta);
            $query->where('prestamos.fecha_prestamo', '<=', $fecha_hasta);
        }
        if ($devuelto) {
            if ($devuelto == "si") {
                $query->where('prestamos.fecha_devolucion', '!=', null);
            } elseif ($devuelto == "no") {
                $query->where('prestamos.fecha_devolucion', '=', null);
            }
        }

        return $query->get();
    }
}
