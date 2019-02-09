<?php

namespace Chatrealm\DCArchive\Http\Controllers;

use Chatrealm\DCArchive\Models\Person;

class CreatorController extends Controller {
	/**
	 * Browsing page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$query = Person::query();
		$query->with(['image', 'links']);

		$query->where('tier', '>=', 2);
		$query->orderBy('tier', 'DESC');
		$people = $query->get()->groupBy('tier');

		return view('creators', ['people' => $people]);
	}

}
