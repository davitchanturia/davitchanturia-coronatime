<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageMiddlewareTest extends TestCase
{
	use RefreshDatabase;

	public function test_route_gets_fallback_locale_if_session_do_not_have()
	{
		$user = User::factory()->create();

		$this->actingAs($user);

		$response = $this->call('GET', '/');

		$this->assertEquals(302, $response->status());
	}

	public function test_route_gets_locale_from_session()
	{
		$user = User::factory()->create();

		$this->actingAs($user)
			->withSession(['applocale' => 'en'])
			->call('GET', '/ka')
			->assertSessionHas(['applocale' => 'ka'])
			->assertStatus(200);
	}
}
