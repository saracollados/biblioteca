<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PrestamosController extends Controller {
    public function mostrarPrestamos() {
        $prestamos = Prestamo::getAll();
        return view('biblioteca/prestamos/mostrarPrestamos', compact('prestamos'));
    }

    public function crearPrestamoForm() {
        $libros = Libro::getAll();
        $usuarios = User::getAll();
        return view('biblioteca/prestamos/crearPrestamoForm', compact('libros', 'usuarios'));
    }

    public function crearPrestamoLibroForm($id) {
        $libro = Libro::buscarLibroId($id);
        $usuarios = User::getAll();
        // Comprobación de que el libro está disponible
        if($libro['disponible'] == 1) {
            return view('biblioteca/prestamos/crearPrestamoForm', compact('libro', 'usuarios'));
        } else {
            $error = true;
            $libros = Libro::getAll();
            return view('biblioteca/libros/mostrarLibros', compact('error', 'libros'));
        }
    }

    public function crearPrestamo(Request $request) {
        $libro = Libro::buscarLibroId($request['id_libro']);
        $fecha_prestamo = date('Y-m-d', strtotime($request->input('fecha_prestamo')));
        $usuario = $request->input('id_user');
        $hoy = date('Y-m-d');

        if ($libro['disponible'] == 0 ) { // Comprobacion de que el libro está disponible
            $errorMessage = 'Ese libro no está disponible';
            $libros = Libro::getAll();
            $usuarios = User::getAll();
            return view('biblioteca/prestamos/crearPrestamoForm', compact('errorMessage', 'libros', 'usuarios'));
        } elseif($fecha_prestamo > $hoy) { // Comprobación de que no se ha introducido una fecha de préstamo futura
            $errorMessage = 'No se pueden crear préstamos con fecha futura';
            $libros = Libro::getAll();
            $usuarios = User::getAll();
            return view('biblioteca/prestamos/crearPrestamoForm', compact('errorMessage', 'libros', 'usuarios'));
        } elseif(auth()->user() == null) { // Comprobación para que solo los usuarios autenticados puedan crear préstamos
            $errorMessage = 'Tienes que autenticarte para crear un préstamo';
            $libros = Libro::getAll();
            $usuarios = User::getAll();
            return view('biblioteca/prestamos/crearPrestamoForm', compact('errorMessage', 'libros', 'usuarios'));
        } elseif(auth()->user()->role == 'user' && $usuario != auth()->user()->id) { // Comprobación para que un usuario que no es administrados no pueda crear préstamos a otros usuarios
            $errorMessage = 'No puedes crear un préstamo a otro usuario';
            $libros = Libro::getAll();
            $usuarios = User::getAll();
            return view('biblioteca/prestamos/crearPrestamoForm', compact('errorMessage', 'libros', 'usuarios'));
        } else {
            $id_prestamo = Prestamo::create($request);
            Libro::prestamoLibro($request['id_libro']);
            return Redirect::to('/mostrarPrestamos');
        }
    }

    public function detallesPrestamo($id) {
        $prestamo = Prestamo::buscarPrestamoId($id);
        return view('biblioteca/Prestamos/detallesPrestamo', compact('prestamo'));
    }

    public function cerrarPrestamo($id) {
        $prestamo = Prestamo::buscarPrestamoId($id);
        if(auth()->user() == null) { // Comprobación para que solo los usuarios autenticados puedan cerrar préstamos
            $errorMessage = 'Tienes que autenticarte para cerrar un préstamo';
            $usuarios = User::getAll();
            return view('biblioteca/prestamos/detallesPrestamo', compact('errorMessage', 'prestamo'));
        } elseif(auth()->user()->role == 'user' && $prestamo->user_id != auth()->user()->id) { // Comprobación para que un usuario que no es administrados no pueda crear préstamos a otros usuarios
            $errorMessage = 'No puedes cerrar un préstamo de otro usuario';
            $usuarios = User::getAll();
            return view('biblioteca/prestamos/detallesPrestamo', compact('errorMessage', 'prestamo'));
        } else {
            Prestamo::cerrarPrestamo($id);
            $prestamo = Prestamo::buscarPrestamoId($id);
            $libro_id = $prestamo->libro_id;
            Libro::devolucionLibro($libro_id);
            return Redirect::to('/mostrarPrestamos');
        }

    }

    public function filtrarPrestamos(Request $request) {
        $prestamos = Prestamo::filtrarPrestamos($request);
        return view('biblioteca/prestamos/mostrarPrestamos', compact('prestamos', 'request'));
    }
}
