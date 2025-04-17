<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->email !== 'admin@gmail.com') {
            return redirect()->route('logs.my');
        }

        return $next($request);
    }
} 