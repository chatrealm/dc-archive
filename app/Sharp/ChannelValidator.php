<?php
namespace Chatrealm\DCArchive\Sharp;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChannelValidator extends FormRequest {
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
			'name' => [
				'required',
				'max:255',
			],
			'slug' => [
				'required',
				'max:255',
				$uniqueRule
			],
			'youtube_id' => [
				'required',
				'max:32',
				$uniqueRule
			]
		];
	}

}
