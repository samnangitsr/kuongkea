<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class TrackOnlineUsers
{
    /**
     * Handle an incoming request.
     */
   public function handle(Request $request, Closure $next)
{
   if ($request->ajax() || $request->wantsJson() || $request->method() !== 'GET') {
        return $next($request);
    }

    $userId = Auth::check() ? Auth::id() : null;
        DB::table('user_onlines')->updateOrInsert(
            [
                'user_id'   => $userId,
                'ip_address'=> $request->ip(),
                //'url'       => $request->fullUrl(), // full URL from browser bar
                //'url'       =>env("APP_URL") . $request->getRequestUri(), // like window.location.pathname
                'url'       =>env("APP_URL") . '/' . $request->path(), // like /dashboard
            ],
            [
                'last_activity' => now(),
            ]
        );

         DB::table('user_onlines')->where('user_id',$userId)->where('url',$request->fullUrl())
            ->where('last_activity', '<', now()->subMinutes(5))
            ->delete();



    return $next($request);

}

}
