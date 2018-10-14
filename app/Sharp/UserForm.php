<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\User;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormCheckField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class UserForm extends SharpForm {
	use WithSharpFormEloquentUpdater;

	public function buildFormFields() {
		$this->addField(
			SharpFormTextField::make('username')
				->setLabel('Username')
		);
		$this->addField(
			SharpFormTextField::make('email')
				->setLabel('e-mail address')
		);
		$this->addField(
			SharpFormCheckField::make('is_admin', 'Admin')
				->setLabel('Is Admin?')
		);
	}

	public function buildFormLayout() {
		$this->addColumn(8, function (FormLayoutColumn $column) {
			$column->withSingleField('username');
			$column->withSingleField('email');
		});
		$this->addColumn(4, function (FormLayoutColumn $column) {
			$column->withSingleField('is_admin');
		});
	}

	public function find($id): array {
		return $this->transform(User::findOrFail($id));
	}

	public function update($id, array $data) {
		$user = $id ? User::findOrFail($id) : new User();

		return $this->save($user, $data);
	}

	public function delete($id) {
		// Intentionally unimplemented.
	}

}
