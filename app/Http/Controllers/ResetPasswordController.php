<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
	public function index()
	{
		return view('forms.resetPassword');
	}

	public function send(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
		]);

		$user = User::where('email', $request->email)->first();

		if (!$user)
		{
			return redirect(route('home', App::getLocale()))->with('failed', 'Failed! email is not registered.');
		}

		$token = Str::random(60);

		$user['token'] = $token;
		$user['is_verified'] = 0;
		$user->save();

		Mail::to($request->email)
			->queue(new ResetPassword($user->name, $token));

		return view('forms.send-email');
	}

	public function verify($token)
	{
		$user = User::where('token', $token)->where('is_verified', 0)->first();
		if ($user)
		{
			$email = $user->email;
			return view('forms.recover-password', compact('email'));
		}
		else
		{
			return redirect(route('reset.password', App::getLocale()));
		}
	}

	public function update(Request $request)
	{
		request()->validate([
			'email'                 => 'required',
			'password'              => 'required|min:3|confirmed',
		]);

		$user = User::where('email', $request->email)->first();
		if ($user)
		{
			$user['is_verified'] = 0;
			$user['token'] = '';
			$user['password'] = request('password');
			$user->save();

			return redirect()->route('login', App::getLocale());
		}
		return redirect(route('password.reset', $user->token));
	}
}
