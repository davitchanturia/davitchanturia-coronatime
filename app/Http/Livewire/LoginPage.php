<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginPage extends Component
{
	public $username;

	public $password;

	public $remember;

	protected $rules = [
		'username'              => 'required|min:3|exists:users',
		'password'              => 'required',
	];

	public function updated($property)
	{
		$this->validateOnly($property);
	}

	public function loginUser()
	{
		$credentials = $this->validate();

		$username = $credentials['username'];
		$verifyed = User::where('username', $username)->first();

		if ($verifyed)
		{
			if ($verifyed->email_verified_at)
			{
				if (Auth::attempt($credentials))
				{
					return redirect(route('home', App::getLocale()));
				}
				else
				{
					throw ValidationException::withMessages([
						'notFound' => 'your provided credentials could not be found',
					]);
				}
			}
			else
			{
				return redirect(route('send.email', App::getLocale()));
			}
		}
		else
		{
			throw ValidationException::withMessages([
				'notFound' => 'your provided credentials could not be found',
			]);
		}
	}

	public function render()
	{
		return view('livewire.login-page');
	}
}
