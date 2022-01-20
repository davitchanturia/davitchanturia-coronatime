<?php

namespace Tests\Unit;

use App\Http\Livewire\Info;
use App\Http\Livewire\NameAndButton;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class InfoTest extends TestCase
{
	use RefreshDatabase;

	public function test_after_changing_tab_header_text_changes_as_well()
	{
		$user = User::factory()->create();

		Livewire::actingAs($user)
			->test(Info::class)
			->call('changeText', '1')
			->assertSee('Worldwide Statistics');
	}

	public function test_after_click_logout_event_emites()
	{
		$user = User::factory()->create();

		Livewire::actingAs($user)
			->test(NameAndButton::class)
			->call('sendEvent')
			->assertEmitted('show-logout-modal');
	}

	public function test_when_data_is_in_db_statistic_number_contains_point()
	{
		$user = User::factory()->create();

		$country = Country::factory()->create([
			'confirmed' => '123456',
		]);

		$this->actingAs($user);

		$response = $this->get(route('home', 'en'));

		$response->assertSee('123,456');
	}
}
