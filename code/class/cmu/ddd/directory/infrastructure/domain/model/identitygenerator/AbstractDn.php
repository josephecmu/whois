<?php 

namespace cmu\infrastructure\identitygenerator\directory;

class PeopleDn extends AbstractDn

{

    protected $dn;

    function __construct()

    {

        

    }

    abstract protected function generateDn();

    protected function create() : string

    {

        $this->generateDn();

        return $this->returnDn();

    }

    protected function returnDn() : string

    {
        
        return $this->dn;

    }


}