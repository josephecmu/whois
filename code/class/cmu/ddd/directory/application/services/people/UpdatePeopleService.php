<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class UpdatePeopleservice extends AbstractPeopleService 
{

	public function execute(DTO $dto) : bool
	{

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		//we need to get the Andrewid from DN
		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu
    	$andrewid = substr(substr($dn, 0, strpos( $dn, ',', 0)), 4);        //get to first comma, then strip 'uid='

		$dto->set('andrewid', $andrewid);

		$obj = $this->doa->build($dto);

		return $this->doa->update($obj);	

	}

}	
