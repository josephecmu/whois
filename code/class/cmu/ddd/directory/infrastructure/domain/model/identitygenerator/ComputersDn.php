<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

class ComputersDn extends AbstractDn
{

	public function buildDn(string $id) : string
	{
		$ou = $this->options['computers']['dnprefix'];
		$idatt = $this->options['computers']['idatt'];
		//we need to create a proper DN to insert. IDENTITY
		return  $idatt . "=" . $id . "," . $ou . "," . $this->dc ;
	}

}
