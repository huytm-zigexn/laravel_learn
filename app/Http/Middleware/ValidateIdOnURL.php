<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateIdOnURL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        $id = $route?->parameter('id');

        if ($request->is('tasks/*') && (!is_numeric($id) || intval($id) != $id)) {
            abort(400); // Bad request
        }

        return $next($request);
    }
}
