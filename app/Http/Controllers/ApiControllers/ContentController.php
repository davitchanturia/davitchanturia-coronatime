<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Country;

class ContentController extends Controller
{
	public function index()
	{
		$worldStats = [
			'newCases'  => number_format(Country::sum('confirmed')),
			'recovered' => number_format(Country::sum('recovered')),
			'death'     => number_format(Country::sum('deaths')),
		];

		return response()->json([
			'countries'  => Country::all(),
			'worldStats' => $worldStats,
		], 200);
	}
}
