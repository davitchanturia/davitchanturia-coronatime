<?php

namespace Tests\Feature\api\auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_register()
	{
		$response = $this->post(route('registration', [
			'username'                          => 'boria',
			'email'                             => 'boria@mail.ru',
			'password'                          => 'password',
			'repeatPassword'                    => 'password',
			'email_verification_token'          => 'token',
			'remember'                          => 'false',
		]));

		$response->assertStatus(200);
	}

	public function test_user_can_logout()
	{
		$user = User::factory()->create();

		$this->be($user);

		$response = $this->actingAs($user)->post(route('logout.user'));

		$response->assertStatus(200);
	}
}
