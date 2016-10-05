<?php

namespace Chatrealm\DCArchive\Forms;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form {
	public function buildForm() {
		$this->add('email', 'email')
			->add('password', 'password')
			->add('remember', 'checkbox', ['label' => 'Remember Me'])
			->add('submit', 'submit', [
				'label' => 'Login',
				'attr' => [
					'class' => 'button is-primary'
				]
			]);
	}

}
