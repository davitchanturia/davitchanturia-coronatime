<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory()->create([
			'email'                      => 'dato@redberry.ge',
			'username'                   => 'dato',
			'password'                   => 'password',
			'email_verification_token'   => Str::random(64),
		]);
	}
}
