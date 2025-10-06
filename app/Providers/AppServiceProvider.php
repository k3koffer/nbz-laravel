<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use JunaidiAR\ImageKitAdapter\ImageKitAdapter;
use ImageKit\ImageKit;
use Illuminate\Filesystem\FilesystemAdapter;

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

            Storage::extend('imagekit', function ($app, $config) {
        $adapter = new ImageKitAdapter(
            new ImageKit(
                $config['key'],
                $config['secret'],
                $config['endpoint_url']
            )
        );

        return new FilesystemAdapter(
            new Filesystem($adapter, $config),
            $adapter,
            $config
        );
    });
    }
}
