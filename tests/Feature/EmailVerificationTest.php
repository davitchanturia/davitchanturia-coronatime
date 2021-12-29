<?php

namespace Tests\Feature;

use App\Mail\VerificationEmail;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class EmailVerificationTest extends TestCase
{
	use RefreshDatabase;

	public function test_email_verification_screen_can_be_rendered()
	{
		$user = User::factory()->create([
			'email_verified_at' => null,
		]);

		$response = $this->actingAs($user)->get(route('verify.email', $user->email_verification_token));

		$response->assertRedirect(route('login', [App::getLocale()]));
	}

	public function test_email_verification_email_can_be_sent()
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
}
