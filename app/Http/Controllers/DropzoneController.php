<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class DropzoneController extends Controller {

    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function index() {
        return view('admin/importarDatos');
    }

    /**
     * Método que almacena los archivos .sql para la bbdd
     *
     * @author Pedro
     */
    public function dropzoneStore(Request $request) {
        $path = public_path() . '/uploads/';
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move($path, $fileName);
    }

}
