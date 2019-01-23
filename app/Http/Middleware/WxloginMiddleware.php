<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;

class WxloginMiddleware
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
        $key = config('app.key');
        $t = Input::get('t');
        $s = Input::get('s');
        $curtime = time();
        /*echo $curtime;
        echo $key.$t.'   ';
        echo sha1($key.$t);*/
        if (!empty($t) && !empty($s) && $curtime-$t < 300 && sha1($key.$t) == $s) {
            return $next($request);
        }
        else {
            echo "{'success':false}";
        }
    }
}
