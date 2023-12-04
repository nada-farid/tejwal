<?php

namespace App\Http\Middleware;

use App\Traits\api_return;
use Closure;

class GuideApproved
{
    use api_return;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (! auth()->user()->approved) {
                auth()->user()->currentAccessToken()->delete();
                return $this->returnError('500',trans('global.yourAccountNeedsAdminApproval'));
            }
        }

        return $next($request);
    }
}
