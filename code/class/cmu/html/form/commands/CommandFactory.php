<?php 
namespace cmu\html\form\commands;

class CommandFactory 

{
    private static $dir = 'commands';
 
    static function getCommand( $action = 'Default' ) : AbstractCommand 

    {

        $namespace = "\\cmu\\html\\form\\commands\\";

        $class = $namespace . UCFirst(strtolower($action))."Command";

        $cmd = new $class();

        return $cmd;

    }

}
