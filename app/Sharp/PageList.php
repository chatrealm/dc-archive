<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\Page;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class PageList extends SharpEntityList {
	public function buildListDataContainers() {
		$this->addDataContainer(
			EntityListDataContainer::make('id')
				->setLabel('ID')
				->setSortable()
		);
		$this->addDataContainer(
			EntityListDataContainer::make('title')
				->setLabel('Title')
				->setSortable()
		);
		$this->addDataContainer(
			EntityListDataContainer::make('slug')
				->setLabel('Slug')
				->setSortable()
		);
	}

	public function buildListLayout() {
		$this->addColumn('id', 2);
		$this->addColumn('title', 5);
		$this->addColumn('slug', 5);
	}

	public function getListData(EntityListQueryParams $params) {
		$query = Page::query();

		if ($params->hasSearch()) {
			foreach ($params->searchWords() as $word) {
				$query->where(function ($query) use ($word) {
					$query->orWhere('slug', 'like', $word);
					$query->orWhere('title', 'like', $word);
				});
			}
		}

		$query->orderBy($params->sortedBy(), $params->sortedDir());

		$results = $query->paginate(50);

		return $this->transform($results);
	}

	public function buildListConfig() {
		$this->setInstanceIdAttribute('id');
		$this->setSearchable();
		$this->setDefaultSort('id', 'asc');
		$this->setPaginated();
	}

}
