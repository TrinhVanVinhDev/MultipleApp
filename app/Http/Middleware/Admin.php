<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            return $next($request);
        }
        return response([
            'message' => 'You don\'t have permission to perform this action'
        ], 403);
    }
}
