<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\Page;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormWysiwygField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class PageForm extends SharpForm {
	use WithSharpFormEloquentUpdater;

	public function buildFormFields() {
		$this->addField(
			SharpFormTextField::make('title')
				->setLabel('Title')
		);
		$this->addField(
			SharpFormTextField::make('slug')
				->setLabel('Slug')
				->setHelpMessage('Leave empty to auto-generate. Generated URL will be ' . url('/p/') . '/<slug>')
		);
		$this->addField(
			SharpFormWysiwygField::make('content')
				->setLabel('Page Content')
				->setToolbar([
					SharpFormWysiwygField::H1,
					SharpFormWysiwygField::B,
					SharpFormWysiwygField::I,
					SharpFormWysiwygField::CODE,
					SharpFormWysiwygField::QUOTE,
					SharpFormWysiwygField::SEPARATOR,
					SharpFormWysiwygField::UL,
					SharpFormWysiwygField::OL,
					SharpFormWysiwygField::INCREASE_NESTING,
					SharpFormWysiwygField::DECREASE_NESTING,
					SharpFormWysiwygField::SEPARATOR,
					SharpFormWysiwygField::A,
				])
		);
	}

	public function buildFormLayout() {
		$this->addColumn(6, function (FormLayoutColumn $column) {
			$column->withSingleField('title');
		});
		$this->addColumn(6, function (FormLayoutColumn $column) {
			$column->withSingleField('slug');
		});
		$this->addColumn(12, function (FormLayoutColumn $column) {
			$column->withSingleField('content');
		});
	}

	public function find($id) : array {
		return $this->transform(Page::findOrFail($id));
	}

	public function update($id, array $data) {
		$instance = $id ? Page::findOrFail($id) : new Page();

		$this->save($instance, $data);
	}

	public function delete($id) {
		Page::findOrFail($id)->delete();
	}

}
