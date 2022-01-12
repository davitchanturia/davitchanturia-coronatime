<?php

namespace Tests\Unit;

use App\Http\Livewire\Info;
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
}
