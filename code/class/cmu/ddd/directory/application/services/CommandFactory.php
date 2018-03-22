<?php 
namespace cmu\ddd\directory\application\services;

class CommandFactory 

{
    private static $dir = 'commands';
 
    static function getCommand($action = 'Default') :  AbstractService

    {

        $namespace = "\\cmu\\ddd\\directory\\application\\services\\";

        $class = $namespace . UCFirst(strtolower($action))."peopleService";

        $cmd = new $class();

        return $cmd;

    }

}
