<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->isActive == false) {
            return response()->json(
                ['message' => 'Your account is not active. Contact your admin for further assistance.'],
                403
            );
        } else  if ($request->user()->role == 'admin' || $request->user()->role == 'teacher') {
            return $next($request);
        }
        return response()->json(
            ['message' => 'unauthorized try again'],
        );
    }
}
