<?php

namespace Chatrealm\DCArchive\Http\Controllers;

use Chatrealm\DCArchive\Models\Page;

class PageController extends Controller {
	public function show(Page $page) {
		return view('page.show', compact('page'));
	}

}
