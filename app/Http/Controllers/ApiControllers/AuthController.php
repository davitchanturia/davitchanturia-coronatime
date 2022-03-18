<?php

namespace App\Http\Controllers\ApiControllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ApiRequests\RegisterRequest;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$attrs = $request->validated();

		$user = User::create([
			'username'                          => $attrs['username'],
			'email'                             => $attrs['email'],
			'password'                          => $attrs['password'],
			'email_verification_token'          => Str::random(64),
		]);

		Mail::to($user->email)
			->queue(new VerificationEmail($user));

		return response(200);
	}

	public function verifyEmail($token)
	{
		$user = User::where('email_verification_token', $token)->first();

		if (!isset($user))
		{
			return response(404);
		}

		$user->email_verified_at = Carbon::now();
		$user->save();

		return response()->json(['success' => 'email verified successfuly']);
	}

	public function checkLoggedIn()
	{
		if (Auth::check())
		{
			return response()->json(['isLoggedIn' => 'true']);
		}
		else
		{
			return response()->json(['isLoggedIn' => 'false']);
		}
	}
}
