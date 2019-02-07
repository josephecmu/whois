<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class PeopleDn extends AbstractDn
{

	public function buildDn(string $id) : string
	{
		//we need to create a proper DN to insert. IDENTITY
		$ou = $this->options['people']['dnprefix'];
		$idatt = $this->options['people']['idatt'];
		return  self::$idatt . "=" . $id . "," . $ou . "," . $this->dc ;
	}

}
