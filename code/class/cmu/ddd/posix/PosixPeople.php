<?php 
/*
*   Value object
*
*/
namespace cmu\domain\model\directory\actors\people;

final class PosixPeople extends \cmu\domain\model\directory\AbstractImmutable

{

    protected $uid;           //'PosixId'  Pattern
    protected $gid;           //'PosixId'  Pattern
    protected $homedir;       //'Path'     Pattern

    private function __construct(array $aposixpeoplearray) //use an array, posix will increase in size intime, possibly Builder pattern?

    {

        $this->uid = $this->posixIdFactory($aposixpeoplearray['uid']) ;
        $this->gid = $this->posixIdFactory($aposixpeoplearray['gid']) ;
        $this->homedir = $this->pathFactory($aposixpeoplearray['homedir']) ;

    }

    public static function fromPosixPeople(array $aposixpeoplearray) : self
    
    {

        return new self($aposixpeoplearray);   

    }

}




