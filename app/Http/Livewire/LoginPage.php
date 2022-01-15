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
		'username'              => 'required|min:3',
		'password'              => 'required',
	];

	public function updated($property)
	{
		$this->validateOnly($property);
	}

	public function loginUser()
	{
		$credentials = $this->validate();

		//checking input type email or username
		$fieldType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if ($fieldType === 'email')
		{
			//checking if user exists
			$username = $credentials['username'];
			$ifExistsInDatabase = User::where('email', $username)->first();

			if ($ifExistsInDatabase)
			{
				if ($ifExistsInDatabase->email_verified_at)
				{
					$this->login('email');
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
		else
		{
			//checking if user exists
			$username = $credentials['username'];
			$ifExistsInDatabase = User::where('username', $username)->first();

			if ($ifExistsInDatabase)
			{
				if ($ifExistsInDatabase->email_verified_at)
				{
					$this->login('username');
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
	}

	public function login($type)
	{
		if (Auth::attempt([$type => $this->username, 'password' => $this->password], $this->remember))
		{
			return redirect(route('home', App::getLocale()));
		}
		else
		{
			throw ValidationException::withMessages([
				'notFound' => 'your provided credentials is incorrect',
			]);
		}
	}

	public function render()
	{
		return view('livewire.login-page');
	}
}
