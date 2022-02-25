<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class WorldWideStats extends Component
{
	public $newCases;

	public $recovered;

	public $death;

	public $point = ',';

	public function mount()
	{
		$this->newCases = number_format(Country::sum('confirmed'));
		$this->recovered = number_format(Country::sum('recovered'));
		$this->death = number_format(Country::sum('deaths'));
	}

	public function render()
	{
		return view('livewire.world-wide-stats');
	}
}
