<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
	public function index($lang)
	{
		if (array_key_exists($lang, Config::get('app.available_locales')))
		{
			App::setLocale($lang);
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

	public function verify($token)
	{
		$user = User::where('email_verification_token', $token)->first();

		if (isset($user))
		{
			$user->email_verified_at = Carbon::now();
			$user->save();
		}

		return redirect(route('login', [App::getLocale()]));
	}

	public function verifyShow()
	{
		return view('forms.login');
	}
}
