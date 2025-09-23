<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // Проверяем, что код выполняется не в консоли (например, при выполнении artisan команд)
        if ($this->app->runningInConsole()) {
            return;
        }

        // Получаем хост (домен) из текущего HTTP-запроса
        $host = $this->app['request']->getHost();
        
        // Получаем схему (http или https)
        $scheme = $this->app['request']->getScheme();

        // Принудительно устанавливаем корневой URL для генерации ссылок (asset(), url() и т.д.)
        // Это говорит Laravel: "Для этого запроса считай корневым URL именно этот"
        URL::forceRootUrl($scheme . '://' . $host);
    }
}
