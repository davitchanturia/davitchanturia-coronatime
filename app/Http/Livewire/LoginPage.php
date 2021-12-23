<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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

			return redirect()->route('home');
		}
	}

	public function render()
	{
		return view('livewire.login-page');
	}
}
