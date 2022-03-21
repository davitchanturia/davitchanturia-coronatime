<?php

namespace App\Http\Controllers\ApiControllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\LoginRequest;
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

	public function login(LoginRequest $request)
	{
		$attributes = $request->validated();

		$fieldType = filter_var($attributes['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if ($fieldType === 'username')
		{
			$user = User::where('username', $attributes['username'])->first();

			if ($user)
			{
				if ($user->email_verified_at)
				{
					if (Auth::attempt(['username' => $attributes['username'], 'password' => $attributes['password']], $attributes['remember']))
					{
						return response(204);
					}
					else
					{
						return response()->json(['message' => 'your provided credentials not found'], 401);
					}
				}
				else
				{
					return response()->json(['message' => 'please verify your email'], 401);
				}
			}
			else
			{
				return response()->json(['message' => 'your provided credentials not found'], 401);
			}
		}
		else
		{
			$user = User::where('email', $attributes['username'])->first();

			if ($user)
			{
				if ($user->email_verified_at)
				{
					if (Auth::attempt(['email' => $attributes['username'], 'password' => $attributes['password']], $attributes['remember']))
					{
						return response(204);
					}
					else
					{
						return response()->json(['message' => 'your provided credentials not found'], 401);
					}
				}
				else
				{
					return response()->json(['message' => 'please verify your email'], 401);
				}
			}
			else
			{
				return response()->json(['message' => 'your provided credentials not found'], 401);
			}
		}
	}

	public function logout()
	{
		Auth::logout();

		return response(200);
	}

	public function verifyEmail($token)
	{
		$user = User::where('email_verification_token', $token)->first();

		if (!isset($user))
		{
			return response(404)->json(['message' => 'not found']);
		}

		$user->email_verified_at = Carbon::now();
		$user->save();

		return response()->json(['success' => 'email verified successfuly']);
	}

	public function checkLoggedIn($page)
	{
		if (Auth::check())
		{
			return response()->json(['isLoggedIn' => 'true', 'page' => $page, 'user' => Auth::user()]);
		}
		else
		{
			return response()->json(['isLoggedIn' => 'false', 'page' => $page]);
		}
	}
}
