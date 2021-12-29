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
		'username'              => 'required|min:4',
		'password'              => 'required|min:6',
	];

	public function updated($property)
	{
		$this->validateOnly($property);
	}

	public function loginUser()
	{
		$credentials = $this->validate();

		if (Auth::attempt($credentials))
		{
			$username = array_shift($credentials);
			$verifyed = User::where('username', $username)->first();

			if ($verifyed->email_verified_at)
			{
				session()->regenerate();

				return redirect(route('home', App::getLocale()));
			}
			else
			{
				return redirect(route('verification.notice'));
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
