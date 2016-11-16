<?php

namespace Chatrealm\DCArchive\Console\Commands;

use Carbon\Carbon;
use Chatrealm\DCArchive\Jobs\ScanChannelForNewVideos;
use Chatrealm\DCArchive\Models\Channel;
use Illuminate\Console\Command;

class ScanChannelsForVideosCommand extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'scan:channels';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Scan channels for any updates';

	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$channels = Channel::where('last_updated', '<', Carbon::now()->subMinutes(15))->get();
		$this->info('Found ' . count($channels) . ' channels');
		$channels->each(function ($channel) {
			dispatch(new ScanChannelForNewVideos($channel));
		});
	}

}
