<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class OnlineUser
{

    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $expireAt = now()->addMinutes(2); // Using addMinutes instead of addMinute
            $userCacheKey = 'user-is-online-' . Auth::id(); // Adding a unique identifier to the cache key
            Cache::put($userCacheKey, true, $expireAt); // Storing in cache with a unique key

            User::where('id', Auth::id())->update(['last_login' => now()]);
        }

        return $next($request);
    }

}
