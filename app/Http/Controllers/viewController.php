<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class viewController extends Controller
{
	public function index($lang)
	{
		if (array_key_exists($lang, Config::get('app.available_locales')))
		{
			App::setLocale($lang);
			Session::put('applocale', $lang);
		}

		// return redirect()->route('home', $lang);
		return view('home', [$lang]);
	}
}
