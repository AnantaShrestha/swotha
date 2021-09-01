<?php

namespace App\Http\Middleware;

use App\TripDates;
use Closure;

class CheckHoldDate
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
        $trip   = TripDates::find($request->id);

        if(strtotime($trip->start_date) < strtotime('-1 month ago')){
            return redirect()->back();
        }
        return $next($request);


    }
}
