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

		//search user
		$user = User::where('email', $request->email)->first();

		if (!$user)
		{
			return back()->with('failed', 'Failed! email is not registered.');
		}

		$token = Str::random(60);

		$user['token'] = $token;
		$user['is_verified'] = 0;
		$user->save();

		Mail::to($request->email)->send(new ResetPassword($user->name, $token));

		if (Mail::failures() != 0)
		{
			return view('forms.send-email');
		}
		return back()->with('failed', 'Failed! there is some issue with email provider');
	}

	public function verify($token)
	{
		$user = User::where('token', $token)->where('is_verified', 0)->first();
		if ($user)
		{
			$email = $user->email;
			return view('forms.recover-password', compact('email'));
		}
		return route('reset.password', App::getLocale());
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
		return redirect()->route('forgot-password')->with('failed', 'Failed! something went wrong');
	}
}
