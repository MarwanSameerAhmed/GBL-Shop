<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
    ];

    /**
     * Route middleware groups.
     */
   protected $middlewareGroups = [
    'web' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\LocaleMiddleware::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,   // هنا
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],



        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware aliases.
     */
    protected $routeMiddleware = [
        'locale' => \App\Http\Middleware\LocaleMiddleware::class,
        // يمكنك إضافة المزيد هنا إن لزم
    ];
}
