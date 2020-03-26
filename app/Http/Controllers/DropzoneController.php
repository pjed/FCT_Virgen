<?php
   
namespace App\Http\Controllers;
   
use App\Http\Requests;
use Illuminate\Http\Request;
   
class DropzoneController extends Controller
{
   
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('dropzone-view');
    }
    
    /**
     * Método que almacena los archivos .sql para la bbdd
     *
     * @author Pedro
     */
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
   
        $imageName = $image->getPath().'.sql';
        $image->move(public_path('uploads'),$imageName);
   
        return response()->json(['success'=>$imageName]);
    }
   
}