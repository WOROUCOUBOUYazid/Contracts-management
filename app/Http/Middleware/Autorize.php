<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//include auth facade
use Illuminate\Support\Facades\Auth;

class Autorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth::user();
       foreach ( $user->role->ressources as $index => $ressource) {
            if($request->route()->uri == $ressource->uri && in_array($ressource->http_method ,$request->route()->methods)) {
                return $next($request);
            }
        }
        abort(403);
    }
}
