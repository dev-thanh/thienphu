<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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
        $langrq = ($request->lang == 'vi' || $request->lang =='en') ? $request->lang : '';

        if($langrq !=''){
            session(['lang' => $langrq]);
        }
        
        $route = $request->route()->getName();
        
        if (strpos($route, '_en') !== false) {
            session(['lang' => 'en']);
        }

        if (strpos($route, '_vi') !== false) {
            session(['lang' => 'vi']);
        }
        $language = \Session::get('lang', config('app.locale'));

        \App::setLocale($language);

        return $next($request);
    }
}
