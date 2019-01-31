<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\Person;
use Chatrealm\DCArchive\Services\ServicesManager;
use Code16\Sharp\Form\Eloquent\Transformers\FormUploadModelTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormListField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class PersonForm extends SharpForm {
	use WithSharpFormEloquentUpdater;

	public function buildFormFields() {
		$this->addField(
			SharpFormTextField::make('name')
				->setLabel('Name')
		);
		$this->addField(
			SharpFormTextField::make('slug')
				->setLabel('Slug')
				->setHelpMessage('Leave empty to autogenerate')
		);
		$this->addField(
			SharpFormTextareaField::make('about')
				->setLabel('About')
		);
		$this->addField(
			SharpFormUploadField::make('image')
				->setLabel('Image')
				->setStorageDisk('public')
				->setFileFilterImages()
				->setStorageBasePath('people/{id}/image')
		);
		$tiers = config('dctv.people_tiers');
		$this->addField(
			SharpFormSelectField::make('tier', array_map(function ($id, $label) {
				return ['id' => $id, 'label' => $label];
			}, array_keys($tiers), $tiers))
				->setLabel('Tier')
				->setClearable()
		);

		/** @var \Chatrealm\DCArchive\Services\ServicesManager $services */
		$services = resolve(ServicesManager::class);
		$this->addField(
			SharpFormListField::make('links')
				->setLabel('Links')
				->setAddable()
				->setRemovable()
				->addItemField(
					SharpFormSelectField::make('service', $services->availableServicesList())
						->setLabel('Service')
						->setClearable()
						->setDisplayAsDropdown()
						->setHelpMessage('Leave empty for generic website')
				)
				->addItemField(
					SharpFormTextField::make('service_data')
						->setLabel('Identifier on service')
						->setHelpMessage('URL for no service')
				)
				->addItemField(
					SharpFormTextField::make('label')
						->setLabel('Label')
						->setHelpMessage('Leave empty to match service')
				)
		);
	}

	/**
	 * @return void
	 */
	public function buildFormLayout() {
		$this->addColumn(8, function (FormLayoutColumn $column) {
			$column->withSingleField('name');
			$column->withSingleField('slug');
			$column->withSingleField('about');
		});
		$this->addColumn(4, function (FormLayoutColumn $column) {
			$column->withSingleField('image');
			$column->withSingleField('tier');
		});
		$this->addColumn(12, function (FormLayoutColumn $column) {
			$column->withSingleField('links', function (FormLayoutColumn $listItem) {
				$listItem->withFields('service|4', 'service_data|4', 'label|4');
			});
		});
	}

	public function find($id): array {
		$this->setCustomTransformer('image', new FormUploadModelTransformer());

		return $this->transform(
			Person::with(['image', 'links'])->find($id)
		);
	}

	public function update($id, array $data) {
		$instance = $id ? Person::findOrFail($id) : new Person();

		$this->save($instance, $data);

		return $instance->id;
	}

	public function delete($id) {
		Person::findOrFail($id)->delete();
	}

}
