<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Jobs\VerifyUser;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

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
		'password'              => 'min:6|required',
		'password_confirmation' => 'min:6|required_with:password|same:password',
	];

	public function updated($property)
	{
		$this->validateOnly($property);
	}

	public function registerUser()
	{
		$this->validate();

		$user = User::create([
			'username'                          => $this->username,
			'email'                             => $this->email,
			'password'                          => $this->password,
			'email_verification_token'          => Str::random(64),
		]);

		// auth()->login($user);

		//send email
		// VerifyUser::dispatch($user);
		Mail::to($user->email)
			->queue(new VerificationEmail($user));

		return redirect(route('send.email', [App::getLocale()]));
	}

	public function render()
	{
		return view('livewire.register-page');
	}
}
