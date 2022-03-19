<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\ResetPasswordRequest;
use App\Http\Requests\ApiRequests\UpdatePasswordRequest;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
	public function send(ResetPasswordRequest $request)
	{
		$attributes = $request->validated();

		$user = User::where('email', $attributes['email'])->first();

		if (!$user)
		{
			return response()->json(['message' => 'your provided email not found!'], 404);
		}

		$token = Str::random(60);

		$user['token'] = $token;
		$user['is_verified'] = 0;
		$user->save();

		Mail::to($attributes['email'])
			->queue(new ResetPassword($user->name, $token));

		return response()->json(['message' => 'email was sent successfuly']);
	}

	public function update(UpdatePasswordRequest $request)
	{
		$attributes = $request->validated();

		$user = User::where('token', $attributes['token'])->where('is_verified', 0)->first();

		if ($user)
		{
			$user['is_verified'] = 0;
			$user['token'] = '';
			$user['password'] = $attributes['password'];
			$user->save();

			return response()->json(['message' => 'password was changed successfuly']);
		}

		return response()->json(['message' => 'Something went wrong! try another time'], 404);
	}
}
