<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
	public function index($lang)
	{
		if (array_key_exists($lang, Config::get('app.available_locales')))
		{
			Session::put('applocale', $lang);
		}

		return view('forms.register');
	}

	public function show($lang)
	{
		if (array_key_exists($lang, Config::get('app.available_locales')))
		{
			Session::put('applocale', $lang);
		}

		return view('forms.send-email', [App::getLocale()]);
	}
}
