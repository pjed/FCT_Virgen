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
     * @author Pedro
     */
    public function store(Request $request) {
        $path = public_path() . '/uploads/';
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move($path, $fileName);
    }

    /**
     * Método que permite eliminar el archivo del directorio local uploads
     * @param Request $request
     * @return type
     */
    public function destroy(Request $request) {
        if (Request::ajax()) {
            $fileName = $request->file('file')->getClientOriginalName();
            $path = public_path('uploads/') . $filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        return $fileName;
    }

}
