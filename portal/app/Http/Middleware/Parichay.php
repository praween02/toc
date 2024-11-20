<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

use Auth;

use App\Http\Controllers\ParichayController;

class Parichay
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
        {
            if ("parichay" == session('login_mode')) {
                $response = (new ParichayController())->is_token_valid($request);
                if ("failure" == $response) {
                    auth()->guard('web')->logout();
                    return redirect()->route('login');
                }
            }
                    return $next($request);
        }
}
