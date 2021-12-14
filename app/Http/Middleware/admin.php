<?php

namespace App\Http\Middleware;

use App\Models\users_roles;
use Closure;
use Illuminate\Http\Request;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(users_roles::find(auth()->id())->role->name === "Admin"){ // he/she is admin
            return $next($request);
        }
        return redirect(404);
    }
}
