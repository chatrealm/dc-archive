<?php

namespace Chatrealm\DCArchive\Forms;

use Kris\LaravelFormBuilder\Form;

class RegisterForm extends Form {
	public function buildForm() {
		$this->add('username', 'text')
			->add('email', 'email')
			->add('password', 'repeated', [
				'type' => 'password',
				'second_options' => [
					'label' => 'Confirm Password'
				]
			])
			->add('submit', 'submit', [
				'label' => 'Register',
				'attr' => [
					'class' => 'button is-primary'
				]
			]);
	}

}
