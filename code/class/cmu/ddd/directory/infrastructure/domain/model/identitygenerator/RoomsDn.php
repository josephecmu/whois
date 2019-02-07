<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class RoomsDn extends AbstractDn
{
	
	public function buildDn(string $id) : string
	{
		$ou = $this->options['rooms']['dnprefix'];
		$idatt = $this->options['rooms']['idatt'];
		//we need to create a proper DN to insert. IDENTITY
		return  $idatt . "=" . $id . "," . $ou . "," . this->$dc ;
	}

}

