<?php

namespace App\Http\Middleware;

use App\Models\users_roles;
use Closure;
use Illuminate\Http\Request;

class superadmin
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
        if(users_roles::find(auth()->id())->role->name === "Super Admin"){ // he/she is  super admin
            return $next($request);
        }

        return redirect(404);
    }
}
