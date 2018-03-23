<?php
namespace cmu\html\form\process\dbprocess\setproperties;

class PeopleSetProperties extends AbstractSetProperties
{

    protected $objectclasses = ["cmuPerson", "shadowAccount", "posixAccount"];//[posixAccount] account MUST have attributes!!            
    protected $id = 'uid';

}
