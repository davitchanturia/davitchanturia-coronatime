<?php

namespace Tests\Feature\auth;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\RegisterPage;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\RefreshDatabase;

class registrationTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_renders_correctly()
	{
		$response = $this->get(route('register', ['lang' => App::getLocale()]));

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
			->assertRedirect(route('send.email', ['lang' => App::getLocale()]));
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

	public function test_already_registered_user_can_visit_home_page()
	{
		$user = User::factory()->create();

		$response = $this->actingAs($user)
			->get(route('home', ['lang' => App::getLocale()]));

		$response->assertStatus(200);
	}
}
