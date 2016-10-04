<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Sentry;
use Illuminate\Support\Facades\Auth;

class HasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $access)
    {
        if (Sentry::check()) {
            if ($access == 'admin') {
                return $next($request);
            } else {
                session()->flash("flash_message_error", "You don't have permission");
                return redirect()->to('/');
            }
        } else {
            session()->flash("flash_message_error", "You don't have permission");
            return redirect()->to('/');
        }

    }
}
