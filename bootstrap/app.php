<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $trustedProxies = env('TRUSTED_PROXIES');
        if ($trustedProxies === '*') {
            $middleware->trustProxies(at: '*');
        } elseif (is_string($trustedProxies) && $trustedProxies !== '') {
            $middleware->trustProxies(at: array_map('trim', explode(',', $trustedProxies)));
        }

        $middleware->web(append: [
            \App\Http\Middleware\TrackOnlineUsers::class,
        ]);

        $middleware->alias([
            'prevent-back-history' => \App\Http\Middleware\disableBackBtn::class,
        ]);

        $middleware->trimStrings(except: [
            'current_password',
            'password',
            'password_confirmation',
        ]);

        $middleware->redirectGuestsTo(fn () => route('login'));

        $middleware->redirectUsersTo('/home');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontFlash([
            'current_password',
            'password',
            'password_confirmation',
        ]);
    })
    ->create();

// config/helper.php calls asset() at config load time, which needs the URL
// generator -- and the URL generator needs a Request binding. Bind one now
// so config can load cleanly in CLI as well as HTTP.
if (! $app->bound('request')) {
    $app->instance('request', Request::capture());
}

return $app;
