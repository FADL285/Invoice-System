<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (config('locale.status')) {
            if (session()->has('locale') && array_key_exists(session('locale'), config('locale.languages'))) {
                app()->setLocale(session('locale'));
            } else {
               $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguages as $userLanguage) {
                    if (array_key_exists($userLanguage, config('locale.languages'))){
                        app()->setLocale($userLanguage);
                        setlocale(LC_TIME, config('locale.languages')[$userLanguage][1]);
                        Carbon::setLocale(config('locale.languages')[$userLanguage][0]);
                        if (config('locale.languages')[$userLanguage][2]) {
                            session(['lang_rtl' => true]);
                        } else {
                            session()->forget('lang_rtl');
                        }
                    }
               }
            }
        }

        return $next($request);
    }
}
