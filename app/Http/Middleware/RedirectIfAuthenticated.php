<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем, авторизован ли пользователь
        if (Auth::check()) {
            // Если текущий маршрут не является маршрутом 'tweets.index', перенаправляем на 'tweets.index'
            if (!$request->routeIs('tweets.index')) {
                return redirect()->route('tweets.index');
            }
        }
        return $next($request);
    }
}
