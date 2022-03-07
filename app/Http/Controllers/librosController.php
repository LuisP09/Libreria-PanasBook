<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class librosController extends Controller
{
    public function index(){
        return view ('pages.libros');
    }

    public function listar(){
        $libros = DB::table('libros')
                    ->join('categorias', 'categorias.id','=','libros.id_categoria')
                    ->join('editorial', 'editorial.id','=','libros.id_editorial')
                    ->select('libros.*','categorias.nombre as nombre_cat','editorial.nombre as nombre_edit')
                    ->get();
        return $libros;
    }
    public function listarAutor(){
        $libros = DB::table('libros')
                    ->join('autor', 'autor.id','=','libros.id_autor')
                    ->select('libros.*','categorias.nombre as nombre_cat','autor.nombre as nombre_aut')
                    ->get();
        return $libros;
    }


    public function eliminar(Request $request){
        $libro = Libros::find($request->id);
        $libro->delete();
    }
    public function guardar(Request $request){
        $reglas =[
             //'isbn' => 'required|unique:libros,isbn|alpha_dash|min:13|max:15',
             //'anio' => 'required|numeric|digits:4',
             //'no_pagina'=>'required|numeric|min:2|max:10',
             //'url_imagen'=>'required',
             'id_categoria'=>'required|integer|not_in:0',
             'id_autor'=>'required|integer|not_in:0',
             'id_editorial'=>'required|integer|not_in:0'

            //'nombre' => 'required|min:2|max:150',
            //'descripcion'=>'required|min:1|max:1000',
            //'precio'=>'required|numeric|min:2',
            
        ];
        $mensajes =[
            'isbn.required' => "El campo ISBN no puede estar vacio.",
            'isbn.unique' => "El campo ISBN Ya esxite ",
            'isbn.alpha_dash' => "El campo ISBN puede contener numeros y guiones ",
            'isbn.min' => "El campo ISBN debe contener entre 13 y 15 caracteres ",
            'isbn.max' => "El campo ISBN no debe contener más de 15 caracteres ",

            'nombre.required' => "El campo nombre no puede estar vacio.",
            'nombre.min' => "El campo nombre requiere minimo 2 caracteres.",
            'nombre.max' => "El campo nombre no debe contener más de 150 caracteres.",
            
            'anio.required' => "El campo año no puede estar vacio.",
            'anio.numeric' => "El campo año debe ser numerico.",
            'anio.digits' => "El campo año debe contener 4 digitos.",
            
            'no_pagina.required' => "El campo número de páginas no puede estar vacio.",
            'no_pagina.numeric' => "El campo número de páginas debe de ser numerico.",
            'no_pagina.min' => "El campo número de páginas debe de tener minimo 2 digitos.",
            'no_pagina.max' => "El campo número de páginas no debe contener más de 10 digitos.",

            'descripcion.required' => "El campo descripción no puede estar vacio.",
            'descripcion.min' => "El campo descripcion debe tener minimo 2 caracteres.",
            'descripcion.max' => "El campo descripcion no debe tener más de 1000 caracteres.",

            'url_imagen.required' => "El campo imagen no puede estar vacio.",

            'precio.required' => "El campo precio no puede estar vacio.",
            'precio.numeric' => "El campo precio debe ser numerico.",
            'precio.min' => "El campo precio debe de tener minimo 2 digitos.",
            'precio.max' => "El campo precio no debe de tener más de 10 digitos.",
            
            'id_categoria.required' => "El campo categoria no puede estar vacio.",
            'id_categoria.integer' => "Seleccione una categoria."
        ];
        $this->validate($request,$reglas,$mensajes);

        if($request->id == null || $request->id == 0){
            $libro = new Libros();
        }else{
            $libro = Libros::find($request->id);
        }

        $libro->isbn = $request->isbn;
        $libro->anio =$request->anio;
        $libro->no_pagina =$request->no_pagina;
        $libro->nombre =$request->nombre;
        $libro->descripcion =$request->descripcion;
        $libro->precio =$request->precio;
        $libro->id_autor = $request->id_autor;;
        $libro->id_categoria =$request->id_categoria;
        $libro->id_editorial = $request->id_editorial;

        //$libro->url_imagen =$request->file("url_imagen")->store('imagenes','public');

         try{
             if($request->file("url_imagen")){
                 $libro->url_imagen =$request->file("url_imagen")->store('imagenes','public');

             }
        // $libro->url_imagen =$request-> url_imagen;
        //$libro->url_imagen ="imagen";
        }catch(Exception $e){}
            $libro->save();
    }
}
