<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class OutletsDn extends AbstractDn
{

	public static function buildDn(string $id) : string
	{
		$ou = $this->options['outlets']['dnprefix'];
		$idatt = $this->options['outlets']['idatt'];
		//we need to create a proper DN to insert. IDENTITY
		return  $idatt . "=" . $id . "," .$ou . "," . $this->dc ;
	}
}

