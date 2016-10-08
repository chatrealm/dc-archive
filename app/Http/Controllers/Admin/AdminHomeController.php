<?php

namespace Chatrealm\DCArchive\Http\Controllers\Admin;

use Chatrealm\DCArchive\Http\Controllers\Controller;

class AdminHomeController extends Controller {
	/**
	 * Admin home page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.home');
	}

}
