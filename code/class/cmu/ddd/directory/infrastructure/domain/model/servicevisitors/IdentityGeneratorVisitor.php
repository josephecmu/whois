<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\servicevisitors;

use cmu\ddd\directory\application\services\people\AddPeopleService;

class IdentityGeneratorVisitor extends AbstractVisitorService

{


	static $ou = "ou=people";
	static $idatt = "uid";

	public static function buildDn($andrewid) : string
	{

		//we need to create a proper DN to insert. IDENTITY

	}

	public function visitAddPeopleService(AddPeopleService $entity)
	{
		
		return  self::$idatt . "=" . $entity->andrewid . "," . self::$ou . "," . self::$dc ;
	}	



}
