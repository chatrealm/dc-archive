<?php
namespace Chatrealm\DCArchive\Sharp;

use Chatrealm\DCArchive\Models\User;
use Chatrealm\DCArchive\Sharp\Filters\UserAdminFilter;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class UserList extends SharpEntityList {
	public function buildListDataContainers() {
		$this->addDataContainer(
			EntityListDataContainer::make('id')
				->setSortable()
				->setLabel('ID')
		);
		$this->addDataContainer(
			EntityListDataContainer::make('username')
				->setLabel('Username')
				->setSortable()
		);
		$this->addDataContainer(
			EntityListDataContainer::make('is_admin')
				->setHtml()
				->setLabel('Admin')
				->setSortable()
		);
	}

	public function buildListLayout() {
		$this->addColumn('id', 1);
		$this->addColumn('username', 8);
		$this->addColumn('is_admin', 2);
	}

	public function getListData(EntityListQueryParams $params) {
		$query = User::query();

		if ($params->hasSearch()) {
			foreach ($params->searchWords() as $word) {
				$query->where(function ($query) use ($word) {
					$query->orWhere('username', 'like', $word);
					$query->orWhere('email', 'like', $word);
				});
			}
		}

		if ($params->filterFor('admin') !== null) {
			$value = $params->filterFor('admin');
			$query->where(function ($query) use ($value) {
				$query->where('is_admin', $value);
				if (!$value) {
					$query->orWhereNull('is_admin');
				}
			});
		}

		$query->orderBy($params->sortedBy(), $params->sortedDir());

		$results = $query->paginate(50);

		$this->setCustomTransformer('is_admin', function ($admin) {
			if ($admin) {
				return '<i class="fa fa-check"></i> Yes';
			}
			return '';
		});

		return $this->transform($results);
	}

	public function buildListConfig() {
		$this->setInstanceIdAttribute('id');
		$this->setSearchable();
		$this->setDefaultSort('id', 'asc');
		$this->setPaginated();

		$this->addFilter('admin', UserAdminFilter::class);
	}

}
