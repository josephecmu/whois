<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

class Mod

{
	private $final; 											//our array
	private $obj; 												//concrete Mapper

	function __construct (AbstractMapper $obj, array $raw = null) 
	{
		//this class is only instantiated ONCE, we must populate the final array to start mods.
		$this->final = ($raw) ?: $obj->getRaw();
			
		$this->obj = $obj;

	}
		
	private function s_modify(string $class_name) : array   		//helper function to avoid typing below 
	{
		$class =  __NAMESPACE__  . '\\mods\\single\\' . $class_name;	//all of our mods are in the 'mods' directory
		$strat = new $class($this->obj); 						//STRATEGY class is called and instantiated each time.
		$strat->act_on_single_array_depth($this->final);  		//here we pass the 'final' array for modification
		return $strat->returnTemp();							//get the array after strategy is done with it.
	}

	private function r_modify(string $class_name) : array
	{
		$class =  __NAMESPACE__  . '\\mods\\recursive\\' . $class_name;    //all of our mods are in the 'mods' directory
		$strat = new $class($this->obj);                        //STRATEGY class is called and instantiated each time.
		$strat->act_on_recursive_array_depth($this->final);	    //here we pass the 'final' array for modification
		return $strat->returnTemp();							//get the array after strategy is done with it.
	}

	//modifiers...they call the 'mods' using the helper functions above...fluent interface
	public function remap_keys() : self

	{
		$this->final = $this->s_modify("RemapKeys");
		return $this;

	}

	public function remove_int_keys() : self
	{

		 $this->final = $this->s_modify("RemoveIntKeys");
		 return $this;

	}
	
	public function group_elements() : self

	{
		$this->final = $this->s_modify("GroupElements");
		return $this;

	}


	public function single_elements() : self
	{

		$this->final = $this->s_modify("SingleElements");
		return $this;

	}

	public function to_array() : self
	{

		$this->final = $this->s_modify("ToArray");
		return $this;
	
	}

	public function move_elements_up_if_not_in_entity_map() : self
	{

		$this->final = $this->s_modify("MoveElementsUpIfNotInEntityMap");
		return $this;

	}

	public function expose_protected() : self
	{

		$this->final = $this->s_modify("ExposeProtected");
		return $this;

	}


	public function expose_private() : self
	{

		$this->final = $this->s_modify("ExposePrivate"); 
		return $this;

	}

	public function reverse_remap_keys() : self
	{

		$this->final = $this->s_modify("ReverseRemapKeys");
		return $this;

	}

	public function remove_count_recursive() : self
	{
		$this->final=$this->r_modify("RemoveCount"); 
		return $this;
	}
	
	public function recurse_expose_private_and_protected() : self
	{

		$this->final=$this->r_modify("ExposePrivateAndProtected");
		return $this;

	}
	//end modifiers
	public function returnFinalArray() : array

	{
		return $this->final;

	}

}
