<?php
namespace cmu\html\form\commands;

class PostprocessCommand extends AbstractCommand

{

    function execute( CommandContext $context )

    {

        $returnpostobj = $context->get('returnpostobj');
        
        $postprocess = new \cmu\html\form\process\postprocess\PostProcess($returnpostobj);
        
        return $postprocess->doSomething();
        
    }

}