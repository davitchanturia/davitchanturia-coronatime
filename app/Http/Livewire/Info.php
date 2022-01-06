<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Info extends Component
{
	public $text;

	public function mount()
	{
		$this->text = trans('text.Worldwidestatistics');
	}

	public function changeText($openTab)
	{
		$info = ['1' => 'text.Worldwidestatistics', '2' => 'text.Countrystatistics'];
		$this->text = trans($info[$openTab]);
	}

	public function render()
	{
		return view('livewire.info');
	}
}
