<?php

namespace Chatrealm\DCArchive\Http\Controllers;

use Chatrealm\DCArchive\Models\Video;

class VideoController extends Controller {

	/**
	 * Browsing page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$query = Video::query();
		$query->with(['channel']);

		$query->orderBy('published_at', 'DESC');
		$videos = $query->paginate(20);

		return view('browse', ['videos' => $videos]);
	}

	/**
	 * Video page
	 *
	 * @param \Chatrealm\DCArchive\Models\Video $video
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Video $video) {
		return view('video', ['video' => $video]);
	}

}
