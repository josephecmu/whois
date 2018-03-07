<?php

namespace cmu\ddd\directory\infrastructure\domain\model\share;

use cmu\config\site\bin\Conf;
use cmu\config\site\bin\TraitConfig;

trait TraitConfigDomain

{
	use TraitConfig;

	abstract protected function returnConcreteConfigObject( array $options) : Conf;


}
