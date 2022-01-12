<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ByCountryStats extends Component
{
	public $countries;

	public $search;

	public function mount()
	{
		$this->countries = Country::all();
	}

	public function updatedSearch()
	{
		if (strlen($this->search) >= 1)
		{
			$this->countries = Country::where('name->' . App::getlocale(), 'like', $this->search . '%')->get();
		}
		else
		{
			$this->countries = Country::all();
		}
	}

	public function up($column)
	{
		$this->countries = Country::all()->sortBy($column);
	}

	public function down($column)
	{
		$this->countries = Country::all()->sortByDesc($column);
	}

	public function render()
	{
		return view('livewire.by-country-stats');
	}
}
