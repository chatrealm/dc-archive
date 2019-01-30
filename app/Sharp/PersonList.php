<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\Person;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class PersonList extends SharpEntityList {
	public function buildListDataContainers() {
		$this->addDataContainer(
			EntityListDataContainer::make('id')
				->setSortable()
				->setLabel('ID')
		);
		$this->addDataContainer(
			EntityListDataContainer::make('name')
				->setLabel('Name')
					->setSortable()
					->setSortable()
		);
		$this->addDataContainer(
			EntityListDataContainer::make('tier')
				->setSortable()
				->setLabel('Tier')
		);
	}

	public function buildListLayout() {
		$this->addColumn('id', 1);
		$this->addColumn('name', 8);
		$this->addColumn('tier', 3);
	}

	public function getListData(EntityListQueryParams $params) {
		$query = Person::query();

		if ($params->hasSearch()) {
			foreach ($params->searchWords() as $word) {
				$query->where(function ($query) use ($word) {
					$query->orWhere('name', 'like', $word);
					$query->orWhere('slug', 'like', $word);
					$query->orWhere('about', 'like', $word);
				});
			}
		}

		$results = $query->paginate(50);

		$this->setCustomTransformer('tier', function ($tier_number, Person $person) {
			return $person->tier_string;
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
