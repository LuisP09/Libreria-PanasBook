<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;

class categorias_controller extends Controller
{
    public function index(){
        return view ('pages.categorias');
    }

    public function listar(){
        return categorias::all();
    }
    public function eliminar(Request $request){
        $categoria = categorias::find($request->id);
        $categoria->delete();
    }
    public function guardar(Request $request){
        $reglas =[
            'codigo'=>'required',
            'nombre'=>'required|min:3',
            'descripcion'=>'required|min:3',
        ];
        $mensajes =[
            'codigo.required' => "El campo codigo no puede estar vacio.",
            'nombre.required' => "El campo nombre no puede estar vacio.",
            'descripcion.required' => "El campo descripción no puede estar vacio."
        ];
        $this->validate($request,$reglas,$mensajes);

        if($request->id == null || $request->id == 0){
            $categoria = new categorias();
        }else{
            $categoria = categorias::find($request->id);
        }

        $categoria->codigo = $request->codigo;
        $categoria->nombre =$request->nombre;
        $categoria->descripcion =$request->descripcion;

        $categoria->save();
    }
}
