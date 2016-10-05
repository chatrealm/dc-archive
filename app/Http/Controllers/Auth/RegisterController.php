<?php

namespace Chatrealm\DCArchive\Http\Controllers\Auth;

use Chatrealm\DCArchive\Http\Controllers\Controller;
use Chatrealm\DCArchive\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Validator;

class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use FormBuilderTrait;
	use RegistersUsers;

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
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm() {
		$form = $this->form('RegisterForm', [
			'method' => 'POST',
			'url' => action('Auth\RegisterController@register')
		]);

		return view('auth.register', [
			'form' => $form
		]);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'username' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \Chatrealm\DCArchive\User
	 */
	protected function create(array $data) {
		return User::create([
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

}
