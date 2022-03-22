<?php

namespace Tests\Feature\api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_get_country_statistics()
	{
		$user = User::factory()->create();

		$this->be($user);

		$response = $this->get(route('country.data'));

		$response->assertStatus(200);
	}

	public function test_user_can_get_searched_data()
	{
		$user = User::factory()->create();

		$this->be($user);

		$response = $this->get(route('search.data', [
			'locale'        => 'en',
			'search'        => 'Georgia',
		]));

		$response->assertStatus(200);
	}

	public function test_user_can_get_data_while_search_length_equals_zero()
	{
		$user = User::factory()->create();

		$this->be($user);

		$response = $this->get(route('search.data', [
			'locale'        => 'en',
			'search'        => '',
		]));

		$response->assertStatus(200);
	}
}
