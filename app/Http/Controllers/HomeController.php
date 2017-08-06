<?php

namespace Chatrealm\DCArchive\Http\Controllers;

use Chatrealm\DCArchive\Models\Video;

class HomeController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$videos = Video::query()
			->with(['channel'])
			->orderBy('published_at', 'DESC')
			->take(10)
			->get();

		return view('home', compact('videos'));
	}

}
