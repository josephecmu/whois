<?php
namespace cmu\html\form\commands;

class PostprocessCommand extends AbstractCommand

{

    function execute(CommandContext $context) : bool

    {

        $returnpostobj = $context->get('returnpostobj');
        
        $postprocess = new \cmu\html\form\process\postprocess\PostProcess($returnpostobj);
        
        return $postprocess->doSomething();
        
    }

}
