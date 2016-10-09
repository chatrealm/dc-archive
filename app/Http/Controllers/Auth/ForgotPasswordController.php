<?php

namespace Chatrealm\DCArchive\Http\Controllers\Auth;

use Chatrealm\DCArchive\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ForgotPasswordController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/

	use FormBuilderTrait;
	use SendsPasswordResetEmails;

	/**
	 * Create a new controller instance.
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLinkRequestForm() {
		$form = $this->form('ForgotPasswordForm', [
			'method' => 'POST',
			'url' => action('Auth\ForgotPasswordController@sendResetLinkEmail')
		]);

		return view('auth.passwords.email', compact('form'));
	}

}
