<?php

namespace Tests\Feature\auth;

use App\Http\Livewire\LoginPage;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginTest extends TestCase
{
	use RefreshDatabase;

	public function test_login_renders_correctly()
	{
		$response = $this->get(route('login'));

		$response->assertStatus(200);
	}

	public function test_user_can_login()
	{
		$user = User::factory()->create([
			'username' => 'gela',
			'password' => 'gela123',
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela')
			->set('password', 'gela123')
			->call('loginUser')
			->assertRedirect(route('home'));

		$this->assertAuthenticated();
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
		$this->post(route('logout'));

		$this->assertGuest();
	}
}
