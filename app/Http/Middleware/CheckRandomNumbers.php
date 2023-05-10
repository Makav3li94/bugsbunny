<?php

namespace App\Http\Middleware;

use Closure;

class CheckRandomNumbers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $a = intval($request['a']);
        $b = intval($request['b']);
        $operator = $request['operator'];
        $res = intval($request['result']);
        switch ($operator) {
            case '-':
                $result = $a - $b;
                break;
            case '+':
                $result = $a + $b;
                break;
        }
        if ($result === $res) {
            return $next($request);
        } else {
            return back()->withInput()->with(['result'=>'incorrect','url'=>$request->url()]);
        }
    }
}
