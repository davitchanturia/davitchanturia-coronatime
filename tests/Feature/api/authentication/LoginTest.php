<?php

namespace Tests\Feature\api\authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_login_with_username()
	{
		User::factory()->create([
			'username'              => 'boria',
			'password'              => 'password',
		]);

		$response = $this->post(route('login.user', [
			'username'              => 'boria',
			'password'              => 'password',
			'remember'              => false,
		]));

		$response->assertStatus(200);
	}

	public function test_user_can_login_with_email()
	{
		User::factory()->create([
			'username'              => 'boria',
			'email'                 => 'boria@test.ge',
			'password'              => 'password',
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'boria@test.ge',
			'password'                 => 'password',
			'remember'                 => false,
		]));

		$response->assertStatus(200);
	}

	public function test_if_user_provides_wrong_data_with_email_log_in_does_not_perform()
	{
		User::factory()->create([
			'username'              => 'boria',
			'email'                 => 'boria@test.ge',
			'password'              => 'password',
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'wrongEmail@test.ge',
			'password'                 => 'password',
			'remember'                 => false,
		]));

		$response->assertStatus(401);
	}

	public function test_if_user_provides_wrong_data_with_username_log_in_does_not_perform()
	{
		User::factory()->create([
			'username'              => 'boria',
			'password'              => 'password',
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'wrongusername',
			'password'                 => 'password',
			'remember'                 => false,
		]));

		$response->assertStatus(401);
	}

	public function test_unverified_user_can_not_log_in_with_username()
	{
		User::factory()->create([
			'username'              => 'boria',
			'password'              => 'password',
			'email_verified_at'     => null,
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'boria',
			'password'                 => 'password',
			'remember'                 => false,
		]));

		$response->assertStatus(401);
	}

	public function test_unverified_user_can_not_log_in_with_email()
	{
		User::factory()->create([
			'username'              => 'boria',
			'email'                 => 'boria@test.ge',
			'password'              => 'password',
			'email_verified_at'     => null,
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'boria@test.ge',
			'password'                 => 'password',
			'remember'                 => false,
		]));

		$response->assertStatus(401);
	}

	public function test_if_provided_data_with_username_is_incorrect_response_is_relevant()
	{
		User::factory()->create([
			'username'              => 'boria',
			'email'                 => 'boria@test.ge',
			'password'              => 'password',
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'boria',
			'password'                 => 'wrongpassword',
			'remember'                 => false,
		]));

		$response->assertStatus(401);
	}

	public function test_if_provided_data_with_email_is_incorrect_response_is_relevant()
	{
		User::factory()->create([
			'username'              => 'boria',
			'email'                 => 'boria@test.ge',
			'password'              => 'password',
		]);

		$response = $this->post(route('login.user', [
			'username'                 => 'boria@test.ge',
			'password'                 => 'wrongpassword',
			'remember'                 => false,
		]));

		$response->assertStatus(401);
	}

	public function test_after_check_user_is_logged_in()
	{
		$user = User::factory()->create([
			'username'              => 'avtia',
			'email'                 => 'avtia@test.ge',
			'password'              => 'password',
		]);

		$this->be($user);

		$response = $this->get(route('is.authenticated', [
			'page'                 => 'register',
		]));

		$response->assertJsonFragment(['isLoggedIn' => 'true']);
	}

	public function test_after_check_user_is_not_logged_in()
	{
		$user = User::factory()->create([
			'username'              => 'avtia',
			'email'                 => 'avtia@test.ge',
			'password'              => 'password',
		]);

		$response = $this->get(route('is.authenticated', [
			'page'                 => 'register',
		]));

		$response->assertJsonFragment(['isLoggedIn' => 'false']);
	}
}
