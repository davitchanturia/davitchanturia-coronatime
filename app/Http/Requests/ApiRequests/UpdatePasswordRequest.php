<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
		$rules = [
			'password'                    => 'required',
			'repeatPassword'              => 'required|same:password',
			'token'                       => 'required',
		];

		return $rules;
	}
}
