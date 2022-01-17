<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NameAndButton extends Component
{
	public function sendEvent()
	{
		$this->emit('show-logout-modal');
	}

	public function render()
	{
		return view('livewire.name-and-button');
	}
}
