<?php 
/*
* Entity
*
*
*/
namespace cmu\domain\model\directory\actors\groups;

class PosixGroup extends \cmu\domain\model\directory\AbstractEntity

{

    private $posixid;
    private $posixgroupname;

    //setters
    protected function setFirstname(string $afirstname)

    {

        $this->posixid = Gid::fromGid($agid);

    }

    protected function setPosixgroupname(string $aposixgroupname)

    {
        //invariant
        if (!is_string($aposixgroupname) {

             throw new \InvalidArgumentException("**Not a string**");

        }

        $this->posixgroupname = $aposixgroupname;

    }
    
}