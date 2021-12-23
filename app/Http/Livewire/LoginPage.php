<?php

namespace App\Http\Livewire;

use Livewire\Component;
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
			session()->regenerate();

			return redirect(route('home'));
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
