<?php

namespace Tests\Feature\api\authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_enter_email_where_token_generates_succesfuly()
	{
		User::factory()->create([
			'username'                 => 'boria',
			'email'                    => 'boria@test.ge',
			'password'                 => 'password',
			'email_verification_token' => 'token',
		]);

		$response = $this->post(route('send.reset-password.email', [
			'email' => 'boria@test.ge',
		]));

		$response->assertJsonFragment(['message' => 'email was sent successfuly']);
	}

	public function test_if_provided_email_not_found_when_reseting_password_response_contains_error_message()
	{
		User::factory()->create([
			'username'                 => 'boria',
			'email'                    => 'boria@test.ge',
			'password'                 => 'password',
			'email_verification_token' => 'token',
		]);

		$response = $this->post(route('send.reset-password.email', [
			'email' => 'wrongemail@test.ge',
		]));

		$response->assertJsonFragment(['message' => 'your provided email not found!']);
	}

	public function test_if_token_is_same_in_request_password_changes_succesfully()
	{
		User::factory()->create([
			'username'                 => 'boria',
			'email'                    => 'boria@test.ge',
			'password'                 => 'password',
			'email_verification_token' => 'token',
			'token'                    => 'boriastokeni',
		]);

		$response = $this->post(route('update.reset-password', [
			'password'                    => 'newpassword',
			'repeatPassword'              => 'newpassword',
			'token'                       => 'boriastokeni',
		]));

		$response->assertJsonFragment(['message' => 'password was changed successfuly']);
	}

	public function test_if_token_is_different_in_request_error_message_will_appear()
	{
		User::factory()->create([
			'username'                 => 'boria',
			'email'                    => 'boria@test.ge',
			'password'                 => 'password',
			'email_verification_token' => 'token',
			'token'                    => 'boriastokeni',
		]);

		$response = $this->post(route('update.reset-password', [
			'password'                    => 'newpassword',
			'repeatPassword'              => 'newpassword',
			'token'                       => 'sxvatokeni',
		]));

		$response->assertStatus(404);
	}
}
