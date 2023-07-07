<?php

namespace App\Http\Controllers\Front;

class FrontController
{
    public function index()
    {
        if (session()->get('locale') == '') {
            session()->put('locale', 'ru');
            app()->setLocale('ru');
        } else {
            app()->setLocale(session()->get('locale'));
        }
        $lang = session()->get('locale');
        return view('front.welcome', compact('lang'));
    }
}
