<?php 
namespace cmu\html\form\commands;

class ProcessFormDic                            //Dependency Injection Container to loop over commands

{

    private $commands = array();                //array of commands to run
    private $context;                           //CommandContext() object to hold arrays

    function __construct(array $commands_in, CommandContext $context_in)

    {

        $this->commands = $commands_in;

        $this->context = $context_in;

    }

    function process() : bool

    {

        foreach($this->commands as $command) {			//loop over COMMANDS

            $cmd = CommandFactory::getCommand($command);
            
            $result[] = $cmd->execute($this->context);
        
        }

        if (!in_array(0, $result))  {     //check if any of the commands returns 'false(0)', then retun 'true'
	   
			return true ;   
		} 

		return false;		

	

	//	throw new \Exception ("An error occurred.");

    }

}
