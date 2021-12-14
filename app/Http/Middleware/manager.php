<?php

namespace App\Http\Middleware;

use App\Models\users_roles;
use Closure;
use Illuminate\Http\Request;

class manager
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
        if(users_roles::find(auth()->id())->role->name === "Manager"){ // he/she is Manager
            return $next($request);
        }
        return redirect(404);

    }
}
