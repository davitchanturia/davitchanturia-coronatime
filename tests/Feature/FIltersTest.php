<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Livewire\ByCountryStats;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class FiltersTest extends TestCase
{
	use RefreshDatabase;

	public function test_searching_works_if_something_is_written()
	{
		$user = User::factory()->create();

		$countryOne = Country::factory()->create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 12,
			'recovered' => 1000,
			'critical'  => 1,
			'deaths'    => 0,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Germany', 'ka' => 'გერმანია'],
			'code'      => 'UK',
			'confirmed' => 122,
			'recovered' => 100,
			'critical'  => 122,
			'deaths'    => 5,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Australia', 'ka' => 'ავსტრალია'],
			'code'      => 'GE',
			'confirmed' => 1200,
			'recovered' => 4000,
			'critical'  => 432,
			'deaths'    => 200,
		]);

		Livewire::actingAs($user)
			->test(ByCountryStats::class)
			->set('search', 'Ge')
			->assertSee('Georgia')
			->assertSee('Germany');
	}

	public function test_all_countries_renders_if_nothing_is_written_in_search()
	{
		$user = User::factory()->create();

		Country::factory()->create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 12,
			'recovered' => 1000,
			'critical'  => 1,
			'deaths'    => 0,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Germany', 'ka' => 'გერმანია'],
			'code'      => 'UK',
			'confirmed' => 122,
			'recovered' => 100,
			'critical'  => 122,
			'deaths'    => 5,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Australia', 'ka' => 'ავსტრალია'],
			'code'      => 'GE',
			'confirmed' => 1200,
			'recovered' => 4000,
			'critical'  => 432,
			'deaths'    => 200,
		]);

		Livewire::actingAs($user)
			->test(ByCountryStats::class)
			->set('search', '')
			->assertSee('Australia')
			->assertSee('Georgia')
			->assertSee('Germany');
	}

	public function test_up_method_works_when_user_sorts()
	{
		$user = User::factory()->create();

		Country::factory()->create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 12,
			'recovered' => 1000,
			'critical'  => 1,
			'deaths'    => 0,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Germany', 'ka' => 'გერმანია'],
			'code'      => 'UK',
			'confirmed' => 122,
			'recovered' => 100,
			'critical'  => 122,
			'deaths'    => 5,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Australia', 'ka' => 'ავსტრალია'],
			'code'      => 'GE',
			'confirmed' => 1200,
			'recovered' => 4000,
			'critical'  => 432,
			'deaths'    => 200,
		]);

		Livewire::actingAs($user)
			->test(ByCountryStats::class)
			->call('up', 'confirmed')
			->assertSeeInOrder(['Georgia', 'Germany', 'Australia']);
	}

	public function test_down_method_works_when_user_sorts()
	{
		$user = User::factory()->create();

		Country::factory()->create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 12,
			'recovered' => 1000,
			'critical'  => 1,
			'deaths'    => 0,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Germany', 'ka' => 'გერმანია'],
			'code'      => 'UK',
			'confirmed' => 122,
			'recovered' => 100,
			'critical'  => 122,
			'deaths'    => 5,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Australia', 'ka' => 'ავსტრალია'],
			'code'      => 'GE',
			'confirmed' => 1200,
			'recovered' => 4000,
			'critical'  => 432,
			'deaths'    => 200,
		]);

		Livewire::actingAs($user)
			->test(ByCountryStats::class)
			->call('down', 'confirmed')
			->assertSeeInOrder(['Australia', 'Germany', 'Georgia']);
	}

	public function test_search_and_up_method_filtering_correctly()
	{
		$user = User::factory()->create();

		Country::factory()->create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 12,
			'recovered' => 1000,
			'critical'  => 1,
			'deaths'    => 0,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Germany', 'ka' => 'გერმანია'],
			'code'      => 'UK',
			'confirmed' => 122,
			'recovered' => 100,
			'critical'  => 122,
			'deaths'    => 5,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Australia', 'ka' => 'ავსტრალია'],
			'code'      => 'GE',
			'confirmed' => 1200,
			'recovered' => 4000,
			'critical'  => 432,
			'deaths'    => 200,
		]);

		Livewire::actingAs($user)
			->test(ByCountryStats::class)
			->set('search', 'Ge')
			->call('up', 'confirmed')
			->assertSeeInOrder(['Georgia', 'Germany']);
	}

	public function test_search_and_down_method_filtering_correctly()
	{
		$user = User::factory()->create();

		Country::factory()->create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 12,
			'recovered' => 1000,
			'critical'  => 1,
			'deaths'    => 0,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Germany', 'ka' => 'გერმანია'],
			'code'      => 'UK',
			'confirmed' => 122,
			'recovered' => 100,
			'critical'  => 122,
			'deaths'    => 5,
		]);

		Country::factory()->create([
			'name'      => ['en' => 'Australia', 'ka' => 'ავსტრალია'],
			'code'      => 'GE',
			'confirmed' => 1200,
			'recovered' => 4000,
			'critical'  => 432,
			'deaths'    => 200,
		]);

		Livewire::actingAs($user)
			->test(ByCountryStats::class)
			->set('search', 'Ge')
			->call('down', 'confirmed')
			->assertSeeInOrder(['Germany', 'Georgia']);
	}
}
