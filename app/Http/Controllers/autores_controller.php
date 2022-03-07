<?php

namespace App\Http\Controllers;

use App\Models\autores;
use Illuminate\Http\Request;

class autores_controller extends Controller
{
    public function index(){
        return view('pages.autores');
    }
    public function listar(){
        return autores::all();
    }
    public function eliminar(Request $request){
        $autor = autores::find($request->id);
        $autor->delete();
    }
    public function guardar(Request $request){
        $reglas =[
            'codigo'=>'required',
            'nombre'=>'required|min:3'
        ];
        $mensajes =[
            'codigo.required' => "El campo ISBN no puede estar vacio.",
            'nombre.required' => "El campo NOMBRE no puede estar vacio.",
            'nombre.min' => "El campo NOMBRE requiere por lo minimo tres caracteres."
        ];
        $this->validate($request,$reglas,$mensajes);

        if($request->id == null || $request->id == 0){
            $autor = new autores();
        }else{
            $autor = autores::find($request->id);
        }

        $autor->codigo = $request->codigo;
        $autor->nombre =$request->nombre;

        $autor->save();
    }
}
