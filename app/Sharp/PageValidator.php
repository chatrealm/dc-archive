<?php
namespace Chatrealm\DCArchive\Sharp;

use Code16\Sharp\Form\Validator\SharpFormRequest;
use Illuminate\Validation\Rule;

class PageValidator extends SharpFormRequest {
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
		$id = $this->route('instanceId');

		 $uniqueRule = Rule::unique('channels');
		 if ($id) {
			 $uniqueRule->ignore($id);
		 }

		return [
			'title' => [
				'required',
				'max:255',
			],
			'slug' => [
				'nullable',
				'max:255',
				$uniqueRule
			],
			'content' => [
				'nullable',
				'string',
				'max:2097152'
			]
		];
	}

}
