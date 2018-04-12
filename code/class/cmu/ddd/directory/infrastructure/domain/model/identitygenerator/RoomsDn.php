<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class RoomsDn extends AbstractDn

{

	static $ou = "ou=rooms";
	static $idatt = "cn";
	
	public static function buildDn($roomid) : string
	{
		//we need to create a proper DN to insert. IDENTITY
		return  self::$idatt . "=" . $roomid . "," . self::$ou . "," . self::$dc ;
	}


}

