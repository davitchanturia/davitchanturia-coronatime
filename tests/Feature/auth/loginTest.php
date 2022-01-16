<?php

namespace Tests\Feature\auth;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\LoginPage;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginTest extends TestCase
{
	use RefreshDatabase;

	public function test_login_renders_correctly()
	{
		$response = $this->get(route('login', ['lang' => App::getLocale()]));

		$response->assertStatus(200);
	}

	public function test_user_can_login_with_username()
	{
		$user = User::factory()->create([
			'username' => 'gela',
			'password' => 'gela123',
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela')
			->set('password', 'gela123')
			->call('loginUser')
			->assertRedirect(route('home', ['lang' => App::getLocale()]));

		$this->assertAuthenticated();
	}

	public function test_user_can_login_with_email()
	{
		$user = User::factory()->create([
			'email'    => 'gela@test.ge',
			'username' => 'gela',
			'password' => 'gela123',
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela@test.ge')
			->set('password', 'gela123')
			->call('loginUser')
			->assertRedirect(route('home', ['lang' => App::getLocale()]));

		$this->assertAuthenticated();
	}

	public function test_if_user_does_not_exists_message_appeares()
	{
		$user = User::factory()->create([
			'email'    => 'gela@gela.ge',
			'username' => 'gela',
			'password' => 'gela123',
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela')
			->set('password', 'gela1234')
			->call('loginUser')
			->assertSee('your provided credentials is incorrect');
	}

	public function test_if_user_does_not_exists_message_appeares_when_login_with_email()
	{
		$user = User::factory()->create([
			'email'    => 'gela@gela.ge',
			'username' => 'gela',
			'password' => 'gela123',
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela@gela.ge')
			->set('password', 'gela1234')
			->call('loginUser')
			->assertSee('your provided credentials is incorrect');
	}

	public function test_if_user_does_not_exists_after_login_message_appeares()
	{
		$user = User::factory()->create([
			'username' => 'gela',
			'password' => 'gela123',
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'buxutichi')
			->set('password', 'password')
			->call('loginUser')
			->assertSee('your provided credentials could not be found');
	}

	public function test_unveryfied_user_redirects_on_the_message_route()
	{
		$user = User::factory()->create([
			'username'          => 'gela',
			'password'          => 'gela123',
			'email_verified_at' => null,
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela')
			->set('password', 'gela123')
			->call('loginUser')
			->assertRedirect(route('send.email', App::getLocale()));
	}

	public function test_validation_works_for_login()
	{
		$user = User::factory()->create();

		Livewire::actingAs($user)
			->test(LoginPage::class)
			->set('username', 'something')
			->set('password', $user->password)
			->call('loginUser')
			->assertSee('your provided credentials could not be found');
	}

	public function test_logout_form_works()
	{
		$user = User::factory()->create();
		$this->be($user);

		$response = $this->actingAs($user)->post(route('logout'));

		$response->assertRedirect(route('login', App::getLocale()));
	}
}
