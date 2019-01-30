<?php
namespace Chatrealm\DCArchive\Sharp;

use Code16\Sharp\Form\Validator\SharpFormRequest;
use Illuminate\Validation\Rule;

class PersonValidator extends SharpFormRequest {
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

		$uniqueRule = Rule::unique('people');
		if ($id) {
			$uniqueRule->ignore($id);
		}

		/** @var \Chatrealm\DCArchive\Services\ServicesManager $services */
		$services = resolve(ServicesManager::class);

		return [
			'name' => [
				'required',
				'max:255',
			],
			'slug' => [
				'nullable',
				'max:255',
				$uniqueRule
			],
			'about' => [
				'nullable',
				'string'
			],
			'tier' => [
				'nullable',
				Rule::in(array_keys(config('dctv.people_tiers')))
			],
			'links' => ['array'],
			'links.*.service' => [
				'nullable',
				Rule::in($services->availableServicesKeys())
			],
			'links.*.label' => [
				'nullable',
				'string'
			],
			'links.*.service_data' => [
				'required'
			]
		];
	}
}

