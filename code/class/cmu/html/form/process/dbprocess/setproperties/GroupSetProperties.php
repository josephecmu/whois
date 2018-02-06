<?php
namespace cmu\html\form\process\dbprocess\setproperties;

class GroupSetProperties extends AbstractSetProperties
{

    protected $objectclasses = ["posixGroup"];
    protected $id = 'cn';

}