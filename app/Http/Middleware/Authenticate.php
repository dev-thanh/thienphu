<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

         if(auth()->check()) {

            if (session_id() == '') {
                @session_start();
                /* or Session:start(); */
            }
            $_SESSION['isLoggedIn'] = auth()->check() ? true : false;

            $options = \App\Models\Options::get();

            $colorSetting = $options->where('type','color_setting')->first();
            $devSetting = $options->where('type','dev-config')->first();
            $devSetting = json_decode($devSetting->content);

            view()->share(compact('colorSetting','devSetting'));

            return $next($request);
         }
        
         return route('login');
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

}
