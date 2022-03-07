<?php

namespace App\Http\Controllers;

use App\Models\venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class venta_controller extends Controller
{
    public function index(){
        return view('pages.venta');
    }
    public function listar(){
            $libros = DB::table('detalle_venta')
                        ->join('libros', 'libros.id','=','libros.id_libro')
                        ->select('detalle_venta.*','libros.nombre as nombre_lib')
                        ->get();
            return $libros;   
    }
    public function eliminar(Request $request){
        $venta = venta::find($request->id);
        $venta->delete();
    }
    public function guardar(Request $request){

 

        if($request->id == null || $request->id == 0){
            $venta = new venta();
        }else{
            $venta = venta::find($request->id);
        }

        $venta->cantidad = $request->cantidad;
        $venta->precio =$request->precio;
        $venta->total =$request->total;
        $venta->id_libro =$request->id_libro;


        $venta->save();
    }
}
