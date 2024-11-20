<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

use App\Models\PocBsnl;

class ValidateBsnl
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
        {
            $check_record_exist = PocBsnl::where('user_id', current_user_id())->count();
            if ($check_record_exist) {
                return redirect()->route('poc_bsnl.index');
            }
      
            return $next($request);
        }
}
