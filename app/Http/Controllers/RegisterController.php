<?php

namespace App\Http\Controllers;

class RegisterController extends Controller
{
	public function index()
	{
		return view('forms.register');
	}

	public function show()
	{
		return view('forms.send-email');
	}
}
