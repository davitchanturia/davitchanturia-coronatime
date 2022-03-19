<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $rules = [
			'username'              => 'required|min:3|unique:users',
			'email'                 => 'required|min:3|unique:users',
			'password'              => 'required|min:3',
			'repeatPassword'        => 'required|same:password',
			'remember'              => 'required',
		];

		return $rules;
	}
}
