<?php

namespace Chatrealm\DCArchive\Observers;

use Chatrealm\DCArchive\Jobs\ScanChannelForNewVideos;
use Chatrealm\DCArchive\Models\Channel;

class ChannelObserver {
	/**
	 * Handle the channel "saved" event.
	 *
	 * @param  \Chatrealm\DCArchive\Models\Channel  $channel
	 * @return void
	 */
	public function saved(Channel $channel) {
		if ($channel->isDirty('uploads_playlist')) {
			dispatch(new ScanChannelForNewVideos($channel, true));
		}
	}

}
