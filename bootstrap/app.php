<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\SetInertiaRootView::class,
        ]);

        $middleware->trustProxies(
            '*', // Доверяем любому прокси
            Request::HEADER_X_FORWARDED_FOR |
                     Request::HEADER_X_FORWARDED_HOST |
                     Request::HEADER_X_FORWARDED_PORT |
                     Request::HEADER_X_FORWARDED_PROTO |
                     Request::HEADER_X_FORWARDED_AWS_ELB
        );
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->header('X-Inertia')) {
                return Inertia::render('Error/Notfound', [
                    'status' => $e->getStatusCode(),
                ])->toResponse($request)->setStatusCode($e->getStatusCode());
            }
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            if ($request->header('X-Inertia')) {
                $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

                if ($statusCode === 500 && !config('app.debug')) {
                    return Inertia::render('Error/Universal', ['status' => 500])
                           ->toResponse($request)
                           ->setStatusCode(500);
                }
                
                return Inertia::render('Error/Universal', ['status' => $statusCode])
                    ->toResponse($request)
                    ->setStatusCode($statusCode);
            }
        });
    })->create();
