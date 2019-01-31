<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class ComputersDn extends AbstractDn
{

	static $ou = "ou=computers,ou=devices";
	static $idatt = "cn";
	
	public static function buildDn($computerid) : string
	{
		//we need to create a proper DN to insert. IDENTITY
		return  self::$idatt . "=" . $computerid . "," . self::$ou . "," . self::$dc ;
	}


}
