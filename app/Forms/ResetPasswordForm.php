<?php

namespace Chatrealm\DCArchive\Forms;

use Kris\LaravelFormBuilder\Form;

class ResetPasswordForm extends Form {
	public function buildForm() {
		$this->add('token', 'hidden')
			->add('email', 'email')
			->add('password', 'repeated', [
				'type' => 'password',
				'second_options' => [
					'label' => 'Confirm Password'
				]
			])
			->add('submit', 'submit', [
				'label' => 'Reset Password',
				'attr' => [
					'class' => 'button is-primary'
				]
			]);
	}

}
