<?php

namespace Chatrealm\DCArchive\Http\Controllers\Admin;

use Chatrealm\DCArchive\Http\Controllers\Controller;
use Chatrealm\DCArchive\Models\User;

class UsersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::paginate(25);

		return view('admin.users.index', compact('users'));
	}

}
