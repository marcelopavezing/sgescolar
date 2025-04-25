<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string $rol)
    {  
        
        if ( !auth()->user()->tieneRol($rol)) {
            abort(403, 'No tienes permiso para acceder.');
        }

        return $next($request);
    }
}
