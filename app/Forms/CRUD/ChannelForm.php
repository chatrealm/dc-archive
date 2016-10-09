<?php

namespace Chatrealm\DCArchive\Forms\CRUD;

use Kris\LaravelFormBuilder\Form;

class ChannelForm extends Form {
	public function buildForm() {
		$this->add('name', 'text')
			->add('slug', 'text')
			->add('youtube_id', 'text', [
				'label' => 'Youtube Channel ID'
			])
			->add('submit', 'submit', [
				'label' => $this->getData('is_create') ? 'Create' : 'Save',
				'attr' => [
					'class' => 'button is-primary'
				]
			]);
	}

}
