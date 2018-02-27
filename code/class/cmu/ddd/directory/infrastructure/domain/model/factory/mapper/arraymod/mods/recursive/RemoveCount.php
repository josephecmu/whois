<?php
// NOT used...was testing with recursive
namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\recursive;

class RemoveCount extends AbstractRecursiveMods
{

	protected function change($k, $v, array &$array)
	{
		unset ($array['count']);
	}

}
