<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(! Auth::guard('admin')->check()){
            return redirect()->route('admin.login');
        }
        $response = $next($request);
        return $response->header('Cache-Control','nocache, no-store,max-age=0,must-revalidate')
        ->header('Pragma','no-cache')
        ->header('Expires', 'Sat,01 Jan 1990 00:00:00 GMT');
    }
}