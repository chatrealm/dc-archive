<?php

namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\Channel;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class ChannelList extends SharpEntityList {
	public function buildListDataContainers() {
		$this->addDataContainer(
			EntityListDataContainer::make('id')
				->setLabel('ID')
				->setSortable()
		);
		$this->addDataContainer(
			EntityListDataContainer::make('name')
				->setLabel('Name')
				->setSortable()
		);
		$this->addDataContainer(
			EntityListDataContainer::make('youtube_id')
				->setLabel('Channel')
		);
		$this->addDataContainer(
			EntityListDataContainer::make('last_updated')
				->setLabel('Last Updated')
		);
	}

	public function buildListLayout() {
		$this->addColumn('id', 1);
		$this->addColumn('name', 6);
		$this->addColumn('youtube_id', 3);
		$this->addColumn('last_updated', 2);
	}

	public function getListData(EntityListQueryParams $params) {
		$query = Channel::query();

		if ($params->hasSearch()) {
			foreach ($params->searchWords() as $word) {
				$query->where(function ($query) use ($word) {
					$query->orWhere('name', 'like', $word);
				});
			}
		}

		$query->orderBy($params->sortedBy(), $params->sortedDir());

		$results = $query->paginate(50);

		$this->setCustomTransformer('last_updated', function ($value, Channel $channel) {
			if ($value) {
				return $channel->last_updated->diffForHumans();
			}
			return 'Never';
		});

		return $this->transform($results);
	}

	public function buildListConfig() {
		$this->setInstanceIdAttribute('id');
		$this->setSearchable();
		$this->setDefaultSort('id', 'asc');
		$this->setPaginated();
	}

}
