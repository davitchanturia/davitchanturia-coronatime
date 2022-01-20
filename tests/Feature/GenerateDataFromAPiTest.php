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

		$this->artisan('create:generate-data');

		$countries = [];

		$names = Http::get('https://devtest.ge/countries');

		$sequence = Http::sequence();

		foreach ($fakeCountryStatistics as $value)
		{
			$sequence->push($value);
		}

		Http::fake(
			[
				'https://devtest.ge/get-country-statistics' => $sequence,
			],
		);

		foreach ($names->json() as $key => $element)
		{
			$stats = Http::post('https://devtest.ge/get-country-statistics', $element);

			$country = [
				'name'      => $element['name'],
				'code'      => $element['code'],
				'confirmed' => $stats->json()['confirmed'],
				'recovered' => $stats->json()['recovered'],
				'critical'  => $stats->json()['critical'],
				'deaths'    => $stats->json()['deaths'],
			];

			array_push($countries, $country);
		}

		foreach ($countries as $el)
		{
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
		}

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
