<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekLogin
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
        if(!Session::get('login')){
            return redirect('/')->with('message', '<div class="alert alert-danger">Maaf! anda sudah Logut. Silahkan Login kembali</div>');
        }

        return $next($request);
    }
}
