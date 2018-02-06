<?php
/*
*   Value object
*
*/
namespace cmu\domain\model\directory\actors\groups;

final class Gid extends \cmu\domain\model\directory\patterns\parents\AbstractPosixId

{

    public static function fromGid(int $anid) : self
    
    {
  
        return new self($anid);   

    }

}