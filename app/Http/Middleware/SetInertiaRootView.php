<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

class SetInertiaRootView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getHost() === 'blog.neboisyaznat.ru') {
            // Если это домен блога, используем шаблон blog.blade.php
            Inertia::setRootView('blog');
        } else {
            // Для всех остальных случаев (включая основной сайт) используем app.blade.php
            Inertia::setRootView('app');
        }
        return $next($request);
    }
}
