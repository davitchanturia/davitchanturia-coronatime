<?php

namespace Tests\Feature\api\authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificationTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_verify_email_after_sending_email()
	{
		User::factory()->create([
			'username'                 => 'boria',
			'email'                    => 'boria@test.ge',
			'password'                 => 'password',
			'email_verification_token' => 'token123',
		]);

		$response = $this->post(route('verify', [
			'token' => 'token123',
		]));

		$response->assertStatus(200);
	}

	public function test_user_can_not_verify_email_if_token_was_not_found_or_was_not_provided_or_is_not_correct()
	{
		User::factory()->create([
			'username'                 => 'boria',
			'email'                    => 'boria@test.ge',
			'password'                 => 'password',
			'email_verification_token' => 'token',
		]);

		$response = $this->post(route('verify', [
			'token' => 'token123',
		]));

		$response->assertStatus(404);
	}
}
