<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class RegisterPage extends Component
{
	public $username;

	public $email;

	public $password;

	public $password_confirmation;

	public $remember;

	protected $rules = [
		'username'              => 'required|min:4',
		'email'                 => 'required|email',
		'password'              => 'required|min:6|confirmed',
	];

	public function updated($property)
	{
		$this->validateOnly($property);
	}

	public function registerUser()
	{
		$this->validate();

		$user = User::create([
			'username' => $this->username,
			'email'    => $this->email,
			'password' => $this->password,
		]);

		auth()->login($user);

		return redirect(route('home'));
	}

	public function render()
	{
		return view('livewire.register-page');
	}
}
