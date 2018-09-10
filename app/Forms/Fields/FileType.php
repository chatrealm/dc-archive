<?php
namespace Chatrealm\DCArchive\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\InputType;

class FileType extends InputType {

	protected function getTemplate() {
		return 'file';
	}

}
