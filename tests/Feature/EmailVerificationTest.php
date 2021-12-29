<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Mail\VerificationEmail;
use App\Http\Livewire\LoginPage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailVerificationTest extends TestCase
{
	use RefreshDatabase;

	public function test_email_verification_screen_can_be_rendered()
	{
		$user = User::factory()->create([
			'email_verified_at' => null,
		]);

		$response = $this->actingAs($user)->get(route('send.email', [App::getLocale()]));

		$response->assertSee('We have sent you a confirmation email');
	}

	public function test_verification_email_can_be_sent()
	{
		$user = User::factory()->create([
			'email'             => 'shavdia@mail.ru',
			'email_verified_at' => null,
		]);

		Mail::fake();
		Mail::send(new VerificationEmail($user));

		Mail::assertSent(VerificationEmail::class, function (VerificationEmail $email) use ($user) {
			return $email->subject === 'Email Verification';
			return $email->from === 'hello@email.com';
			return $email->markdown === 'email.verification';
		});
	}

	public function test_when_verification_email_is_send_user_gets_correct_route_with_token()
	{
		$user = User::factory()->create([
			'email'                    => 'shavdia@mail.ru',
			'email_verified_at'        => null,
		]);

		$response = $this->actingAs($user)
			->get(route('verify.email', $user->email_verification_token));

		$this->assertDatabaseHas('users', [
			'email_verification_token' => $user->email_verification_token,
		]);

		$this->get(route('login', [App::getLocale()]))
			->assertStatus(302);
	}

	public function test_verificated_user_can_log_in()
	{
		$user = User::factory()->create([
			'username'          => 'gela',
			'password'          => 'gela123',
			'email_verified_at' => now(),
		]);

		Livewire::test(LoginPage::class)
			->set('username', 'gela')
			->set('password', 'gela123')
			->call('loginUser')
			->assertRedirect(route('home', ['lang' => App::getLocale()]));

		$this->assertAuthenticated();
	}
}
