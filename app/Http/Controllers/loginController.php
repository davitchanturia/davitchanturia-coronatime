<?php

namespace App\Http\Controllers;

class loginController extends Controller
{
	public function index()
	{
		return view('forms.login');
	}

	public function destroy()
	{
		auth()->logout();

		return redirect(route('login'));
	}
}
