<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPermissionCheck
{
    protected $allowedIps = [
        '127.0.0.1',
        '192.250.230.83',
        '83.215.234.49',
        '31.135.33.119'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userIp = $request->ip();
        if (!in_array($userIp, $this->allowedIps)) {
            abort(403, 'У вас нет доступа к этому разделу.');
        }
        
        return $next($request);
    }
}
