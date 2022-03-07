<?php

namespace App\Http\Controllers;

use App\Models\editorial;
use Illuminate\Http\Request;

class editorial_controller extends Controller
{
    public function index(){
        return view('pages.editorial');
    }
    public function listar(){
        return editorial::all();
    }
    public function eliminar(Request $request){
        $edit = editorial::find($request->id);
        $edit->delete();
    }
    public function guardar(Request $request){
        $reglas =[
            'codigo'=>'required',
            'nombre'=>'required|min:3'
        ];
        $mensajes =[
            'codigo.required' => "El campo codigo de editorial no puede estar vacio.",
            'nombre.required' => "El campo nombre no puede estar vacio.",
            'nombre.min' => "El campo nombre requiere por lo minimo tres caracteres."
        ];
        $this->validate($request,$reglas,$mensajes);

        if($request->id == null || $request->id == 0){
            $edit = new editorial();
        }else{
            $edit = editorial::find($request->id);
        }

        $edit->codigo = $request->codigo;
        $edit->nombre =$request->nombre;

        $edit->save();
    }
}
