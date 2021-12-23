<?php

namespace App\Http\Controllers;

class ResetPasswordController extends Controller
{
	public function index()
	{
		return view('forms.resetPassword');
	}
}
