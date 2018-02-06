<?php 
/*
* Entity
*
*
*/
namespace cmu\domain\model\directory\equipment\computers;

class Computer extends \cmu\domain\model\directory\AbstractEntity

{

    protected $computername;
    protected $computeros;
    protected $computerrdn;
	protected $roomrdn;									//reference to Room Entity

    //setters
	protected function setRoomrdn ($roomrdn)

	{

        $this->roomrdn= $roomrdn;

	}
    
}
