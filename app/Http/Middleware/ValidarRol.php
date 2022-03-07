<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $id)
    {
        if($request->user()->id_tipo_usuario != $id){
            abort(403, 'Acceso Denengado!!');
            //return redirect()->to('/');
        }
        return $next($request);
    }
}
