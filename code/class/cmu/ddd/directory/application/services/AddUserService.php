<?php

namespace cmu\ddd\directory\application\services;

class AddUserService extends \cmu\ddd\directory\application\services\lib\AbstractService 

{

	//private $userDtoAssembler;
	private $userrepository;

//	public function __construct( UserRepository $userRepository, UserDTOAssembler $userDtoAssembler)
	public function __construct( \cmu\ddd\directory\infrastructure\domain\model\repository\UserRepository $auserrepository)
  	{
	   $this->userrepository = $auserrepository;
	   //$this->userDtoAssembler = $userDtoAssembler;
	}
		   
	public function execute($request)    //we should be able to execute directly.  $request is an array already
	{

//		$peoplerdn=$request->getPeopleRDN();
//		$name=$request->getName();
//		$andrewid=$request->dynGet("andrewid");
		
		$people = new \cmu\ddd\directory\domain\model\actors\people\People($request);
	//	return $this->userDtoAssembler->assemble($user);
		//return $people; //testing 
		
		$this->userrepository->add($people);
		
		//check if already exists

		//run multiple actions per aggregate (assign room, etc)
	}

}
