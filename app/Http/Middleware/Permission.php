<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(Auth::user()->role == $role){
            return $next($request);
        }

        if(Auth::user()->role == 'mahasiswa'){
            return redirect('mahasiswa/dashboard');
        } else if (Auth::user()->role == 'staff'){
            return redirect('staff/dashboard');
        } else {
            return redirect('admin/dashboard');
        }
    }
}
