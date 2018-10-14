<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\Channel;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormHtmlField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\Layout\FormLayoutFieldset;
use Code16\Sharp\Form\SharpForm;

class ChannelForm extends SharpForm {
	use WithSharpFormEloquentUpdater;

	protected static $YOUTUBE_LINKS_TEMPLATE = <<<END
<p v-if="channel_id"><strong>Current channel</strong>: <a :href="channel_url">{{ channel_id }}</a></p>
<p v-else>No current channel</p>
<p v-if="uploads_id"><strong>Uploads playlist</strong>: <a :href="uploads_url">{{ uploads_id }}</a></p>
<p v-if="last_updated"><strong>Last updated</strong>: {{ last_updated }}
END;

	public function buildFormFields() {
		$this->addField(
			SharpFormTextField::make('name')
				->setLabel('Name')
		);
		$this->addField(
			SharpFormTextField::make('slug')
				->setLabel('Slug')
				->setHelpMessage('Leave empty to auto-generate')
		);
		$this->addField(
			SharpFormTextField::make('youtube_id')
				->setLabel('YouTube Channel ID')
				->setHelpMessage('Channel ID from https://www.youtube.com/channel/... Usually starts with UC')
		);
		$this->addField(
			SharpFormHtmlField::make('youtube_links')
				->setLabel('Uploads playlist')
				->setInlineTemplate(static::$YOUTUBE_LINKS_TEMPLATE)
				->setReadOnly()
		);
	}

	public function buildFormLayout() {
		$this->addColumn(6, function (FormLayoutColumn $column) {
			$column->withSingleField('name');
		});
		$this->addColumn(6, function (FormLayoutColumn $column) {
			$column->withSingleField('slug');
		});
		$this->addColumn(12, function (FormLayoutColumn $column) {
			$column->withFieldset('YouTube Details', function (FormLayoutFieldset $fieldset) {
				$fieldset->withSingleField('youtube_id');
				$fieldset->withSingleField('youtube_links');
			});
		});
	}

	public function find($id) : array {
		$this->setCustomTransformer('youtube_links', function($_, Channel $channel) {
			return [
				'channel_id' => $channel->youtube_id,
				'channel_url' => $channel->url,
				'uploads_id' => $channel->uploads_playlist,
				'uploads_url' => $channel->playlist_url,
				'last_updated' => $channel->last_updated ? $channel->last_updated->diffForHumans() : 'Never'
			];
		});

		return $this->transform(Channel::findOrFail($id));
	}

	public function update($id, array $data) {
		$instance = $id ? Channel::findOrFail($id) : new Channel();

		$this->ignore('youtube_links');

		$this->save($instance, $data);
	}

	public function create(): array {
		$this->setCustomTransformer('youtube_links', function($_, Channel $channel) {
			return [
				'channel_id' => null,
				'channel_url' => null,
				'uploads_id' => null,
				'uploads_url' => null
			];
		});

		return $this->transform(new Channel());
	}

	public function delete($id) {
		Channel::findOrFail($id)->delete();
	}

}
