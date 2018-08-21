<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class OutletsDn extends AbstractDn

{

	static $ou = "ou=outlets,ou=devices";
	static $idatt = "cn";
	
	public static function buildDn($outletid) : string
	{
		//we need to create a proper DN to insert. IDENTITY
		return  self::$idatt . "=" . $outletid . "," . self::$ou . "," . self::$dc ;
	}


}

