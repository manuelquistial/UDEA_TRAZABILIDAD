<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public $directorio = "presolicitud/apoyo_economico/";
    public $path = "/public/presolicitud/apoyo_economico"; 

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = 2;
        $opcion = 'documentos';
        $files = '';
        $apoyo_economico = Storage::disk('public')->files($this->directorio);

        return view('configuration/documentosView', compact('opcion','general','files','apoyo_economico'));
    }

    public function store(Request $request){
        $general = 2;
        $opcion = 'documentos';
        $files = '';
        $apoyo_economico = Storage::disk('public')->files($this->directorio);

        $this->uploadFile($request, $this->path);

        return redirect('/documentos');
    }

    public function downloads(Request $request){
        return response()->file(storage_path('app/public/'.$request->path));
    }

    public function uploadFile($request, $path){
        if($request->hasFile('anexos')) {
            foreach($request['anexos'] as $file) {
                info($request);
                $file_name = str_replace(' ', '_', $file->getClientOriginalName());
                $path = $file->storeAs($path . '/', $file_name);
            }
        }
    }

    public function delete(Request $request){
        Storage::disk('public')->delete($request->path);
        
        return response()->json(['data'=>true]);
    }
}
