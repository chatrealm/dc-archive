<?php

namespace Chatrealm\DCArchive\Http\Controllers\Admin;

use Chatrealm\DCArchive\Http\Controllers\Controller;
use Chatrealm\DCArchive\Http\Requests\CRUD\StoreChannel;
use Chatrealm\DCArchive\Models\Channel;
use Flash;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ChannelsController extends Controller {
	use FormBuilderTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$channels = Channel::paginate(25);

		return view('admin.channel.index', [
			'channels' => $channels
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$form = $this->form('CRUD\ChannelForm', [
			'method' => 'POST',
			'url' => route('admin.channel.store')
		], [
			'is_create' => true
		]);

		return view('admin.channel.create', compact('form'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Chatrealm\DCArchive\Http\Requests\CRUD\StoreChannel  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreChannel $request) {
		$channel = new Channel($request->only('name', 'slug', 'youtube_id'));

		// Get channel info
		$this->setYoutubeInfo($channel);

		if ($channel->save()) {
			Flash::success('Channel added.');

			return redirect()->route('admin.channel.index');
		}

		Flash::error('Saving failed');

		return back()->withInput();
	}

	/**
	 * Set youtube info on the model
	 *
	 * @param \Chatrealm\DCArchive\Models\Channel $channel
	 * @return void
	 **/
	protected function setYoutubeInfo(Channel $channel) {
		// Get channel info
		$youtubeChannel = $this->getChannelFromYoutube($channel->youtube_id);

		if (!$youtubeChannel) {
			back()->withInput()->withErrors([
				'youtube_id' => [
					'Youtube channel not found'
				]
			])->throwResponse();
		}

		$channel->uploads_playlist = $youtubeChannel->contentDetails->relatedPlaylists->uploads;
	}

	/**
	 * Get channel from youtube
	 *
	 * @param string $channel_id Youtube channel ID
	 * @return object|null
	 */
	protected function getChannelFromYoutube($channel_id) {
		$client = app('youtube.client');

		$response = $client->get('channels', [
			'query' => [
				'part' => 'contentDetails',
				'id' => $channel_id,
				'fields' => 'items(contentDetails/relatedPlaylists/uploads,id)'
			]
		]);
		$youtubeChannel = json_decode($response->getBody());

		if (count($youtubeChannel->items)) {
			return $youtubeChannel->items[0];
		}
		return null;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Chatrealm\DCArchive\Models\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function show(Channel $channel) {
		return view('admin.channel.show', compact('channel'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Chatrealm\DCArchive\Models\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Channel $channel) {
		$form = $this->form('CRUD\ChannelForm', [
			'method' => 'PUT',
			'url' => route('admin.channel.update', ['channel_id' => $channel->id]),
			'model' => $channel
		]);

		$deleteForm = $this->form('CRUD\DestroyForm', [
			'method' => 'DELETE',
			'url' => route('admin.channel.destroy', ['channel_id' => $channel->id])
		], [
			'type' => 'Channel'
		]);

		return view('admin.channel.edit', compact('form', 'deleteForm'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Chatrealm\DCArchive\Http\Requests\CRUD\StoreChannel  $request
	 * @param  \Chatrealm\DCArchive\Models\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreChannel $request, Channel $channel) {
		$channel->fill($request->only('name', 'slug', 'youtube_id'));

		if ($channel->isDirty('youtube_id')) {
			// Get channel info
			$this->setYoutubeInfo($channel);
		}

		if ($channel->save()) {
			Flash::success('Channel updated.');

			return redirect()->route('admin.channel.show', ['channel_id' => $channel->id]);
		}

		Flash::error('Saving failed');

		return back()->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Chatrealm\DCArchive\Models\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Channel $channel) {
		$channel->delete();

		Flash::success('Channel deleted.');

		return redirect()->route('admin.channel.index');
	}

}
