<?php

namespace Chatrealm\DCArchive\Forms;

use Kris\LaravelFormBuilder\Form;

class ForgotPasswordForm extends Form {
	public function buildForm() {
		$this->add('email', 'email')
			->add('submit', 'submit', [
				'label' => 'Send Password Reset Link',
				'attr' => [
					'class' => 'button is-primary'
				]
			]);
	}

}
