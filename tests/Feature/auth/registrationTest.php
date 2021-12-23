<?php

namespace Tests\Feature\auth;

use App\Http\Livewire\RegisterPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class registrationTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_renders_correctly()
	{
		$response = $this->get(route('register'));

		$response->assertStatus(200);
	}

	public function test_user_can_registrate()
	{
		Livewire::test(RegisterPage::class)
			->set('username', 'dato')
			->set('email', 'dato@test.ge')
			->set('password', 'password')
			->set('password_confirmation', 'password')
			->call('registerUser')
			->assertRedirect(route('home'));
	}

	public function test_validation_works_for_registration()
	{
		Livewire::test(RegisterPage::class)
			->set('username', 'dat')
			->set('email', 'dato@test.ge')
			->set('password', 'password')
			->set('password_confirmation', 'password')
			->call('registerUser')
			->assertSee('The username must be at least 4 characters.');

		Livewire::test(RegisterPage::class)
			->set('username', 'dato')
			->set('email', 'dato')
			->set('password', 'password')
			->set('password_confirmation', 'password')
			->call('registerUser')
			->assertSee('The email must be a valid email address.');

		Livewire::test(RegisterPage::class)
			->set('username', 'dato')
			->set('email', 'dato@test.ge')
			->set('password', 'password')
			->set('password_confirmation', 'password2')
			->call('registerUser')
			->assertSee('The password confirmation and password must match.');
	}
}
