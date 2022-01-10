<?php

namespace App\Console\Commands;

use App\Models\Country;
use GuzzleHttp\Promise\Create;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class generateApiData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'create:generate-data';

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
		$response = Http::get('https://devtest.ge/countries');

		foreach ($response->json() as $element)
		{
			sleep(2);

			$stats = Http::post('https://devtest.ge/get-country-statistics', $element);

			$country = [
				'name'      => $element['name'],
				'code'      => $element['code'],
				'confirmed' => $stats->json()['confirmed'],
				'recovered' => $stats->json()['recovered'],
				'critical'  => $stats->json()['critical'],
				'deaths'    => $stats->json()['deaths'],
			];

			array_push($this->countries, $country);
		}

		foreach ($this->countries as $country)
		{
			Country::create([
				'name'      => [
					'en' => $country['name']['en'],
					'ka' => $country['name']['ka'],
				],
				'code'      => $country['code'],
				'confirmed' => $country['confirmed'],
				'recovered' => $country['recovered'],
				'critical'  => $country['critical'],
				'deaths'    => $country['deaths'],
			]);
		}

		$this->info('Data from api is migrated succesfully!');
	}
}
