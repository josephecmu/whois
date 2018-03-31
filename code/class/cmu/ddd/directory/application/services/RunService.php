<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class RunService
{

	private static function getEntityFromOu(DTO $dto) : string
	{
	
		$ou_eq = $dto->get('ou');           //the DTO for 'ADD' contains the key 'ou' 

		$entity = ldap_explode_dn($ou_eq, 1)[0];	

		return $entity;

	}

	private static function getEntityFromDn(DTO $dto) : string
	{

		$dn = $dto->get('dn');                  //returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$entity = ldap_explode_dn($dn, 1)[1];

		return $entity;

	}
	private static function getEntity(DTO $dto, string $action) : string
	{
		switch($action) {
			case "add":
				$entity = self::getEntityFromOu($dto);
				break;	
			case "update":
			case "delete":
			case "get":	
				$entity = self::getEntityFromDn($dto);
				break;
			default:
				throw new \Exception("Action '" . $action .   "' passed is invalid.");
		}

			return $entity;
		
	}

	static public function init(DTO $dto, string $action) //may return a DTO, may return a bool
	{

		$entity = self::getEntity($dto, $action);

        $namespace = "\\cmu\\ddd\\directory\\application\\services\\";

		$class = $namespace .  $entity . "\\" .  ucfirst($action) . ucfirst($entity)  . "Service";

        $cmd = new $class();

        return $cmd->execute($dto);

	}

}
