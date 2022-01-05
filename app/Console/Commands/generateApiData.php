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
	public function handle()
	{
		$response = Http::get('https://devtest.ge/countries');

		foreach ($response->json() as $element)
		{
			$encodedArray = json_encode($element['name']);

			Country::create([
				'name' => $encodedArray,
			]);
		}

		$this->info('Data from api is migrated succesfully!');
	}
}
