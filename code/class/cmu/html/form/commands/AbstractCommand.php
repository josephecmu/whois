<?php
namespace cmu\html\form\commands;

abstract class AbstractCommand

{

    abstract function execute(CommandContext $context) : bool;

}
