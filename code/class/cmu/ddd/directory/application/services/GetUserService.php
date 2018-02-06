<?php

namespace cmu\ddd\directory\application\services;

class GetUserService extends \cmu\ddd\directory\application\services\lib\AbstractService 

{

	private $userrepository;

	public function __construct( \cmu\ddd\directory\infrastructure\domain\model\repository\UserRepository $auserrepository)
  	{
	   $this->userrepository = $auserrepository;
	   //$this->userDtoAssembler = $userDtoAssembler;
	}

	public function execute($apeoplerdn) : \cmu\ddd\directory\domain\model\actors\people\People

	{
		//	return $this->userDtoAssembler->assemble($user);
		//return $people; //testing 
		
		return $this->userrepository->get($apeoplerdn);

	}

}
