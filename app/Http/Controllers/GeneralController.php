<?php

namespace App\Http\Controllers;

class GeneralController extends Controller
{

    public function changeLang($locale): \Illuminate\Http\RedirectResponse
    {
        try {
            if (array_key_exists($locale, config('locale.languages'))) {
                session(['locale' => $locale]);
                app()->setLocale($locale);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
