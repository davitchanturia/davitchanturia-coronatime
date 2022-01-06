<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class ByCountryStats extends Component
{

    public $countries;

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function render()
    {
        return view('livewire.by-country-stats');
    }
}
