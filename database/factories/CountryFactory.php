<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'name'      => ['en' => 'name', 'ka' => 'saxeli'],
			'code'      => 'GE',
			'confirmed' => 1234,
			'recovered' => 2323,
			'critical'  => 1231,
			'deaths'    => 1223,
		];
	}
}
