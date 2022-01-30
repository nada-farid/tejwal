<?php

namespace App\Http\Middleware;

use Closure;

class ChangeCurrency
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
  
        if(isset($request->currency_type) && $request->currency_type == 'EGP'){
            config(['app.Currency' => 'EGP']);
        }
        elseif  
        (isset($request->currency_type) && $request->currency_type == 'USD'){
            config(['app.Currency' => 'USD']);
        }  

        return $next($request);
    }
}