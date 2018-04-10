<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class PeopleDn extends AbstractDn

{

	static $ou = "ou=people";
	static $idatt = "uid";
	
	public static function buildDn($andrewid) : string
	{
		//we need to create a proper DN to insert. IDENTITY
		return  self::$idatt . "=" . $andrewid . "," . self::$ou . "," . self::$dc ;
	}


}
