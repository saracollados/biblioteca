<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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
        
        if (!is_numeric($year) || Str::length($year) != 4) { // Comprobación de que el año introducido es correcto
            $errorMessage = 'El año no es correcto';
            return view('biblioteca/libros/crearLibroForm', compact('errorMessage'));
        } elseif (auth()->user() == null || auth()->user()->role != 'admin') { // Comprobación para que un usuario que no sea administrador no pueda crear un libro
            $errorMessage = 'Debes ser un usuario con permisos de administrador para crear un libro';
            return view('biblioteca/libros/crearLibroForm', compact('errorMessage'));
        } else {
            $id_libro = Libro::create($request);
            return Redirect::to('/mostrarLibros');
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
        if (auth()->user() == null || auth()->user()->role != 'admin') {
            $id = Session::get('id');
            $libro = Libro::buscarLibroId($id);
            $errorMessage = 'Debes ser un usuario con permisos de administrador para editar un libro';
            return view('biblioteca/libros/editarLibroForm', compact('libro', 'errorMessage'));
        } else {
            $id = Session::get('id');
            Libro::editarLibro($id, $request);
            return Redirect::to('/mostrarLibros');
        }
    }

    public function eliminarLibro($id) {
        if (auth()->user() == null || auth()->user()->role != 'admin') { // Comprobación para que solo un usuario administrador pueda eliminar un libro
            $errorMessage = 'Debes ser un usuario con permisos de administrador para eliminar un libro';
            $libros = Libro::getAll();
            return view('biblioteca/libros/mostrarLibros', compact('libros', 'errorMessage'));
        } else {
            Libro::eliminarLibro($id);
            return Redirect::to('/mostrarLibros');
        }
    }

    public function filtrarLibros(Request $request) {
        $libros = Libro::filtrarLibros($request);
        return view('biblioteca/libros/mostrarLibros', compact('libros', 'request'));
    }
}
