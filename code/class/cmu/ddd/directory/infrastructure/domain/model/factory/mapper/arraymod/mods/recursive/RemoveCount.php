<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\recursive;

class RemoveCount extends AbstractRecursiveMods
{
	protected function change($k, $v, array &$array) : void
	{
		unset ($array['count']);
	}
}
