<?php

namespace Tests\Feature\auth;

use Tests\TestCase;
use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
	use RefreshDatabase;

	public function test_reset_password_view_shows_correctly()
	{
		$response = $this->get(route('reset.password', ['lang' => App::getLocale()]));

		$response->assertStatus(200);
	}

	public function test_after_entering_wrong_email_app_redirects_on_login()
	{
		$user = User::factory()->create([
			'email' => 'test@test.com',
		]);

		$response = $this->post(route('send.reset.password', [
			'lang'  => App::getLocale(),
			'email' => 'sad@test.ge',
		]));

		$response->assertRedirect(route('home', App::getLocale()));
	}

	public function test_after_entering_correct_email_app_sends_mail()
	{
		$user = User::factory()->create([
			'email'             => 'shavdia@mail.ru',
		]);

		$this->post(route('send.reset.password', [
			App::getLocale(),
			'email' => 'shavdia@mail.ru',
		]));

		$token = Str::random(60);

		Mail::fake();

		Mail::to($user->email)->queue(new ResetPassword($user->name, $token));

		Mail::assertQueued(ResetPassword::class);
	}

	public function test_when_reset_password_email_is_send_user_gets_correct_route_with_token()
	{
		$user = User::factory()->create([
			'email'                    => 'shavdia@mail.ru',
			'token'                    => Str::random(60),
			'is_verified'              => 0,
		]);

		$response = $this->get(route('password.reset', $user->token));

		$response->assertSee('New password');
	}

	public function test_when_reset_password_email_is_send_user_gets_invalid_token_redirects_to_start_page()
	{
		$user = User::factory()->create([
			'email'                    => 'shavdia@mail.ru',
		]);

		$response = $this->get(route('password.reset', ['token' => Str::random(60)]));

		$response->assertRedirect(route('reset.password', App::getLocale()));
	}

	public function test_if_user_does_not_exists_redirects_to_reset_password_route()
	{
		$user = User::factory()->create([
			'email'                    => 'shavdia@mail.ru',
			'is_verified'              => 1,
			'token'                    => Str::random(60),
		]);

		$response = $this->put(route('update.password', [
			'email'                 => 'test@test.ge',
			'password'              => 'password',
			'password_confirmation' => 'password',
			App::getLocale(),
		]));

		$response->assertSee('New Password');
	}

	public function test_when_user_changes_password_app_saves()
	{
		$user = User::factory()->create([
			'email'                    => 'shavdia@mail.ru',
			'is_verified'              => 1,
			'token'                    => Str::random(60),
		]);

		$response = $this->put(route('update.password', [
			'email'                    => 'shavdia@mail.ru',
			'password'                 => 'password',
			'password_confirmation'    => 'password',
			App::getLocale(),
		]));

		$response->assertRedirect(route('login', App::getLocale()));
	}

	public function test_validation_for_reseting_password_works_well()
	{
		$user = User::factory()->create([
			'email'                    => 'shavdia@mail.ru',
			'token'                    => Str::random(60),
		]);

		$response = $this->post(route('update.password', [
			App::getLocale(),
			'email'                 => $user->email,
			'password'              => 'test',
			'password_confirmation' => 'test123',
		]));

		$response->assertSee('New password');
	}
}
