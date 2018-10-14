<?php
namespace Chatrealm\DCArchive\Sharp;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserValidator extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return $this->user()->is_admin;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'username' => [
				'required',
				'alpha_dash',
				'max:32',
				Rule::unique('users')->ignore($this->route('instanceId'))
			],
			'email' => [
				'required',
				'email',
				'max:255',
				Rule::unique('users')->ignore($this->route('instanceId'))
			],
			'is_admin' => ['boolean']
		];
	}

}
