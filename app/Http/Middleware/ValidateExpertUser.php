<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

use App\Models\AskExpertDetail;

class ValidateExpertUser
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
        {
            $check_record_exist = AskExpertDetail::where('user_id', current_user_id())->count();
            if ($check_record_exist) {
                return redirect()->route('expert_user.index');
            }
                return $next($request);
        }
}
