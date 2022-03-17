<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\RegisterRequest;
use Illuminate\Support\Str;

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

		return response(200);
	}
}
