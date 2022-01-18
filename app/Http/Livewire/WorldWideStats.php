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
		$this->newCases = $this->withPoint(Country::sum('confirmed'));
		$this->recovered = $this->withPoint(Country::sum('recovered'));
		$this->death = $this->withPoint(Country::sum('deaths'));
	}

	public function withPoint($string)
	{
		if (strlen($string) > 3)
		{
			return substr_replace($string, $this->point, -3, 0);
		}
		else
		{
			return $string;
		}
	}

	public function render()
	{
		return view('livewire.world-wide-stats');
	}
}
