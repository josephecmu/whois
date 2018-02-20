<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

class Mod

{
	private $final; 											//our array
	private $obj; 												//concrete Mapper

	function __construct (AbstractMapper $obj, $raw = null) 
	{
		//this class is only instantiated ONCE, we must populate the final array to start mods.
	
		$this->final = ($raw) ?: $obj->getRaw();
			
		$this->obj = $obj;

	}
		
	private function modify(string $class_name) : array   		//helper function to avoid typing below 
	{
		$class =  __NAMESPACE__  . '\\mods\\' . $class_name;	//all of our mods are in the 'mods' directory
		$strat = new $class($this->obj); 						//STRATEGY class is called and instantiated each time.
		$strat->act_on_single_array_depth($this->final);  		//here we pass the 'final' array for modification
		return $strat->returnTemp();							//get the array after strategy is done with it.
	}

	public function remap_keys() : self

	{
		$this->final = $this->modify("RemapKeys");
		return $this;

	}

	public function remove_int_keys() : self
	{

		 $this->final = $this->modify("RemoveIntKeys");
		 return $this;

	}
	
	public function group_elements() : self

	{
		$this->final = $this->modify("GroupElements");
		return $this;

	}


	public function single_elements() : self
	{

		$this->final = $this->modify("SingleElements");
		return $this;

	}


	public function to_array() : self
	{

		$this->final = $this->modify("ToArray");
		return $this;
	
	}

	public function move_elements_up_if_not_in_entity_map() : self
	{

		$this->final = $this->modify("MoveElementsUpIfNotInEntityMap");
		return $this;

	}

	public function expose_protected() : self
	{

		$this->final = $this->modify("ExposeProtected");
		return $this;

	}


	public function expose_private() : self
	{

		$this->final = $this->modify("ExposePrivate"); 
		return $this;

	}

	public function reverse_remap_keys() : self
	{

		$this->final = $this->modify("ReverseRemapKeys");
		return $this;

	}

	//This function is RECURSIVE.  It will not be able to be applied to the "one level ldap filtering"
	public function remove_count_recursive() : self
	{

		$this->remove_count($this->final);
		return $this;
	}
	
	private function remove_count(array &$array) 
	{
		foreach ($array as $value) { 
			if (is_array($value)) { 
				$this->remove_count($value);
			} else {
				unset($array['count']);
			}
		}
	}
	//end recursive method
	public function returnFinalArray() : array

	{
		return $this->final;

	}

}
