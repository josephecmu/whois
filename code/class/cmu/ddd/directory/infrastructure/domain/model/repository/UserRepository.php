<?php

namespace cmu\ddd\directory\infrastructure\domain\model\repository;

class UserRepository extends AbstractRepository

{

	private $people=[];

	public function add($apeople)//need class hinting only from DTO???
	
	{ 
		$this->people[$apeople->dynGet("peoplerdn")->dynGet("dn")] = $apeople;

	}

	public function returnPeople()

	{

		return $this->people;

	}

	public function get($apeoplerdn)

	{

		if (isset($this->people[$apeoplerdn]) {

			return $this->people[$apeoplerdn];

		}

	}

}
