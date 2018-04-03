<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class AddPeopleService extends AbstractPeopleService

{

	public function execute(DTO $dto) : bool

	{
		$ou_eq = $dto->get('ou');			//the DTO for 'ADD' contains the key 'ou'

		$dto->unset('ou'); 					//this administrative key is not needed here.

		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

        //Check for uniquness of gidnumber, andrewid, uidnumber and homedirectory
        //TODO: better way to pass the array, maye with the mapper?
        $basedn = $this->ou . "," . $this->dc;
        $unique = array("uidnumber" => "uidnumber",
                        "uid" => "andrewid",
                        "gidnumber" => "gidnumber",
                        "homedirectory" => "homedirectory");
        if(!$this->doa->verifyUnique($dto, $basedn, $unique, 0)) {
            print_r("NOT UNIQUE!");
            Throw new \ErrorException("Not Unique");
        }


		$andrewid = $dto->get('andrewid');

		//we need to create a proper DN to insert.
		$dn = $this->idatt . "=" . $andrewid . "," . $this->ou . "," . $this->dc ;

		$dto->set('dn', $dn);		//we need to pass the $dn we just constructed

		$obj = $this->doa->build($dto);

		return $this->doa->add($obj);	

	}

}
