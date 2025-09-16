<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function switchLang($locale){
        if (!in_array($locale, ['vi', 'en'])) {
            $locale = config('app.fallback_locale');
        }

        Cookie::queue('locale', $locale, 60 * 24 * 30);

        App::setLocale($locale);

        return redirect()->back();
    }
}
