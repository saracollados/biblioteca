<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LibrosController extends Controller {
    public function mostrarLibros() {
        $libros = Libro::getAll();
        return view('biblioteca/libros/mostrarLibros', compact('libros'));
    }

    public function crearLibroForm() {
        return view('biblioteca/libros/crearLibroForm');
    }
    
    public function crearLibro(Request $request) {
        $year = $request->input('año_publicacion');
        // Comprobación de que el año introducido es correcto
        if (is_int($year) && Str::lenght($year) == 4) {
            $id_libro = Libro::create($request);
            return Redirect::to('/mostrarLibros');
        } else {
            $error = 'year';
            return view('biblioteca/libros/crearLibroForm', compact('error'));
        }
    }

    public function detallesLibro($id) {
        $libro = Libro::buscarLibroId($id);
        return view('biblioteca/libros/detallesLibro', compact('libro'));
    }

    public function editarLibroForm($id) {
        $libro = Libro::buscarLibroId($id);
        Session::put('id', $id);
        return view('biblioteca/libros/editarLibroForm', compact('libro'));
    }

    public function editarLibro(Request $request) {
        $id = Session::get('id');
        Libro::editarLibro($id, $request);
        return Redirect::to('/mostrarLibros');
    }

    public function eliminarLibro($id) {
        Libro::eliminarLibro($id);
        return Redirect::to('/mostrarLibros');
    }

    public function filtrarLibros(Request $request) {
        $libros = Libro::filtrarLibros($request);
        return view('biblioteca/libros/mostrarLibros', compact('libros', 'request'));
    }
}
