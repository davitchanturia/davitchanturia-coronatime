<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GenerateDataFromAPiTest extends TestCase
{
	use RefreshDatabase;

	public function test_if_response_is_succesfull_it_pushes_data_into_array_and_saves_in_db()
	{
		$fakeCountryNames = [
			[
				'code' => 'GE',
				'name' => [
					'en' => 'Georgia',
					'ka' => 'საქართველო',
				],
			],
			[
				'code' => 'BE',
				'name' => [
					'en' => 'Belgium',
					'ka' => 'ბელგია',
				],
			],
		];

		$fakeCountryStatistics = [
			[
				'id'        => 1,
				'country'   => 'Georgia',
				'code'      => 'GE',
				'confirmed' => 233,
				'recovered' => 1222,
				'critical'  => 13,
				'deaths'    => 3,
				'created_at'=> '2021-09-13T11:43:29.000000Z',
				'updated_at'=> '2021-09-13T11:43:29.000000Z',
			],
			[
				'id'        => 2,
				'country'   => 'Beglium',
				'code'      => 'BE',
				'confirmed' => 2398,
				'recovered' => 3147,
				'critical'  => 2349,
				'deaths'    => 477,
				'created_at'=> '2021-09-13T11:43:39.000000Z',
				'updated_at'=> '2021-09-13T11:43:39.000000Z',
			],
		];

		Http::fake(
			[
				'https://devtest.ge/countries' => Http::response($fakeCountryNames),
			],
		);

		Http::fake(
			[
				'https://devtest.ge/get-country-statistics' => Http::response($fakeCountryStatistics),
			],
		);

		$countries = [];
		// $this->artisan('create:generate-data');

		$names = Http::get('https://devtest.ge/countries');

		$x = 0;
		foreach ($names->json() as $element)
		{
			// sleep(2);

			$stats = Http::post('https://devtest.ge/get-country-statistics', $element);

			// dd($stats->json());
			$country = [
				'name'      => $element['name'],
				'code'      => $element['code'],
				'confirmed' => $stats->json()[$x]['confirmed'],
				'recovered' => $stats->json()[$x]['recovered'],
				'critical'  => $stats->json()[$x]['critical'],
				'deaths'    => $stats->json()[$x]['deaths'],
			];

			$x++;
			array_push($countries, $country);
			// dump($countries);
		}

		// dd('asdasd');
		// dd($countries);
		foreach ($countries as $el)
		{
			// dump($countries);
			// dump('------------------');
			// dump($el);
			// dump('------------------');
			$coun = Country::create(
				[
					'code'      => $el['code'],
					'name'      => [
						'en' => $el['name']['en'],
						'ka' => $el['name']['ka'],
					],
					'confirmed' => $el['confirmed'],
					'recovered' => $el['recovered'],
					'critical'  => $el['critical'],
					'deaths'    => $el['deaths'],
				]
			);
			// dump($coun);
			// dump('------------------');
		}

		// dd('end');
		$this->assertDatabaseHas('countries', [
			'code'      => 'GE',
			'confirmed' => 233,
			'recovered' => 1222,
			'critical'  => 13,
			'deaths'    => 3,
		]);

		$this->assertDatabaseHas('countries', [
			'code'      => 'BE',
			'confirmed' => 2398,
			'recovered' => 3147,
			'critical'  => 2349,
			'deaths'    => 477,
		]);
	}
}
