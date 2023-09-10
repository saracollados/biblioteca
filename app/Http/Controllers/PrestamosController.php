<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Libro;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PrestamosController extends Controller {
    public function mostrarPrestamos() {
        $prestamos = Prestamo::getAll();
        return view('biblioteca/prestamos/mostrarPrestamos', compact('prestamos'));
    }

    public function crearPrestamoForm() {
        $libros = Libro::getAll();
        return view('biblioteca/prestamos/crearPrestamoForm', compact('libros'));
    }

    public function crearPrestamoLibroForm($id) {
        $libro = Libro::buscarLibroId($id);
        // Comprobación de que el libro está disponible
        if($libro['disponible'] == 1) {
            return view('biblioteca/prestamos/crearPrestamoForm', compact('libro'));
        } else {
            $error = true;
            $libros = Libro::getAll();
            return view('biblioteca/libros/mostrarLibros', compact('error', 'libros'));
        }
    }

    public function crearPrestamo(Request $request) {
        $libro = Libro::buscarLibroId($request['id_libro']);
        $fecha_prestamo = date('Y-m-d', strtotime($request->input('fecha_prestamo')));
        $hoy = date('Y-m-d');
        // Comprobación de que no se ha introducido una fecha de préstamo futura y de que el libro está disponible
        if ($libro['disponible'] == 0 ) {
            $error = 'disponibilidad';
            $libros = Libro::getAll();
            return view('biblioteca/prestamos/crearPrestamoForm', compact('error', 'libros'));
        } elseif($fecha_prestamo > $hoy) {
            $error = 'fecha';
            $libros = Libro::getAll();
            return view('biblioteca/prestamos/crearPrestamoForm', compact('error', 'libros'));
        }else {
            $id_prestamo = Prestamo::create($request);
            Libro::prestamoLibro($request['id_libro']);
            return Redirect::to('/mostrarPrestamos');
        }
    }

    public function detallesPrestamo($id) {
        $prestamo = Prestamo::buscarPrestamoId($id);
        return view('biblioteca/Prestamos/detallesPrestamo', compact('prestamo'));
    }

    public function editarPrestamoForm($id) {
        $prestamo = Prestamo::buscarPrestamoId($id);
        $libros = Libro::getAll();
        Session::put('id', $id);
        return view('biblioteca/prestamos/editarPrestamoForm', compact('prestamo', 'libros'));
    }

    public function cerrarPrestamo($id) {
        Prestamo::cerrarPrestamo($id);
        $prestamo = Prestamo::buscarPrestamoId($id);
        $libro_id = $prestamo->libro_id;
        Libro::devolucionLibro($libro_id);
        return Redirect::to('/mostrarPrestamos');
    }

    public function filtrarPrestamos(Request $request) {
        $prestamos = Prestamo::filtrarPrestamos($request);
        return view('biblioteca/prestamos/mostrarPrestamos', compact('prestamos', 'request'));
    }
}
