<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SetDomainContext
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
        // Получаем хост (домен) из текущего HTTP-запроса
        $host = $request->getHost();

        // Формируем корневой URL, используя схему (http/https) и хост запроса
        $rootUrl = $request->getScheme() . '://' . $host;

        // Принудительно устанавливаем этот URL как базовый для всего приложения
        // Это переопределит значение из закешированного конфига на время обработки запроса
        URL::forceRootUrl($rootUrl);

        // Также можно принудительно установить схему, что особенно полезно за прокси-серверами
        if ($request->isSecure()) {
            URL::forceScheme('https');
        }

        return $next($request);
    }
}