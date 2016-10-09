<?php

namespace Chatrealm\DCArchive\Forms\CRUD;

use Kris\LaravelFormBuilder\Form;

class DestroyForm extends Form {
	public function buildForm() {
		$this->add('submit', 'submit', [
			'label' => 'Delete ' . $this->getData('type', 'Item'),
			'attr' => [
				'class' => 'button is-danger'
			]
		]);
	}

}
