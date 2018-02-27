<?php
// NOT used...was testing with recursive
namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\recursive;

class RemoveCount extends AbstractRecursiveMods
{

	protected function change($k, $v, array &$array)
	{
		unset ($array['count']);
	}

//	public function r_modify(array &$array)
//	{
//		
//		foreach ($array as $k => &$v) {
//			if (is_array($v)) {
//					$this->r_modify($v);
//				}
//
//			unset ($array['count']);
//
//		}
//
//		return $array;
//
//	}

}
