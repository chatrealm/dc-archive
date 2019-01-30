<?php
namespace Chatrealm\DCArchive\Services\Service;

abstract class BaseService {
	abstract public function getLabel();
	abstract public function getURL($identifier);

}
