<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class fetchCountryData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch:country-data';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'generates data from api and inserts into the database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public $countries = [];

	public function handle()
	{
		$names = Http::get('https://devtest.ge/countries');

		if ($names->successful())
		{
			$this->execution($names);
		}

		foreach ($this->countries as $country)
		{
			Country::updateOrCreate(
				['code'      => $country['code']],
				[
					'name'      => [
						'en' => $country['name']['en'],
						'ka' => $country['name']['ka'],
					],
					'confirmed' => $country['confirmed'],
					'recovered' => $country['recovered'],
					'critical'  => $country['critical'],
					'deaths'    => $country['deaths'],
				]
			);
		}

		$this->info('Data from api is migrated succesfully!');
	}

	private function save($element, $stats): array
	{
		return [
			'name'      => $element['name'],
			'code'      => $element['code'],
			'confirmed' => $stats->json()['confirmed'],
			'recovered' => $stats->json()['recovered'],
			'critical'  => $stats->json()['critical'],
			'deaths'    => $stats->json()['deaths'],
		];
	}

	private function execution($names)
	{
		foreach ($names->json() as $element)
		{
			sleep(2);

			$stats = Http::post('https://devtest.ge/get-country-statistics', $element);

			$country = $this->save($element, $stats);

			array_push($this->countries, $country);
		}
	}
}
