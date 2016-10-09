<?php

namespace Chatrealm\DCArchive\Http\Requests\CRUD;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChannel extends FormRequest {
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
		$channel = $this->route('channel_id');

		$uniqueRule = Rule::unique('channels');
		if ($channel) {
			$uniqueRule->ignore($channel->id);
		}

		return [
			'name' => 'required|max:255',
			'slug' => 'max:255',
			'youtube_id' => ['required', 'max:32', $uniqueRule]
		];
	}

}
