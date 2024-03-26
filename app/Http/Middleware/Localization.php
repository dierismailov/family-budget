<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang =$request->header('App-Locale');
        if ($lang !== null) {
            App::setLocale($lang);
        }
        return $next($request);
    }
}
