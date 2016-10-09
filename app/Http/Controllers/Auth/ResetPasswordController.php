<?php

namespace Chatrealm\DCArchive\Http\Controllers\Auth;

use Chatrealm\DCArchive\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ResetPasswordController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use FormBuilderTrait;
	use ResetsPasswords;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null $token
	 * @return \Illuminate\Http\Response
	 */
	public function showResetForm(Request $request, $token = null) {
		$form = $this->form('ResetPasswordForm', [
			'method' => 'POST',
			'url' => action('Auth\ResetPasswordController@reset'),
			'model' => [
				'token' => $token,
				'email' => $request->email
			]
		]);

		return view('auth.passwords.reset', compact('form'));
	}

}
