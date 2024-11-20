<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

use App\Models\SixGUser;

class ValidateSixG
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
        {
            $check_record_exist = SixGUser::where('user_id', current_user_id())->where('is_form_submit', 1)->count();
            if ($check_record_exist) {
                return redirect()->route('six_g_user.index');
            }
      
            return $next($request);
        }
}
