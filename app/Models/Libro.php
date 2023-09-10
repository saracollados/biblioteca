<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Libro extends Model {
    use HasFactory;

    public static function getAll() {
        return Libro::orderBy('titulo')->get();
    }

    public static function create(Request $request) {
        $libro = new Libro();
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor'); 
        $libro->año_publicacion = $request->input('año_publicacion');
        $libro->genero = $request->input('genero');
        $libro->disponible = 1; // El libro se crea automáticamente como disponible
        $libro->save(); 

        return $libro->id;
    }

    public static function buscarLibroId($id) {
        return Libro::find($id);
    }
    
    public static function editarLibro($id, Request $request) {
        $libro = Libro::find($id);
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor'); 
        $libro->año_publicacion = $request->input('año_publicacion');
        $libro->genero = $request->input('genero');
        $libro->save(); 
    }
    
    public static function eliminarLibro($id) {
        $libro = Libro::find($id);
        $libro->delete();
    }

    public static function prestamoLibro($id) {
        $libro = Libro::find($id);
        $libro->disponible = 0;
        $libro->save(); 
    }

    public static function devolucionLibro($id) {
        $libro = Libro::find($id);
        $libro->disponible = 1;
        $libro->save(); 
    }

    public static function filtrarLibros($request) {
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $año_publicacion = $request->input('año_publicacion');
        $genero = $request->input('genero');
        $disponible = $request->input('disponible');

        $query = DB::table('libros');

        if ($titulo) {
            $query->where('libros.titulo', 'LIKE', '%'.$titulo.'%');
        }
        if ($autor) {
            $query->where('libros.autor', 'LIKE', '%'.$autor.'%');
        }
        if ($año_publicacion) {
            $query->where('libros.año_publicacion', '=', $año_publicacion);
        }
        if ($genero) {
            $query->where('libros.genero', '=', $genero);
        }
        if ($disponible) {
            if ($disponible == "si") {
                $query->where('libros.disponible', '=', 1);
            } elseif ($disponible == "no") {
                $query->where('libros.disponible', '=', 0);
            }
        }

        return $query->get();
    }
}
