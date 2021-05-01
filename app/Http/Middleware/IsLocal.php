<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class IsLocal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            if (Auth::user()->isAdminLocal())
            {
                $expiresAt = Carbon::now()->addMinutes(1);
                Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);

                return $next($request);
            }
        }
        return redirect(404);
    }
}
