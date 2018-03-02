<?php
namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config;
//may not need trying to couple using seperated interface
interface InterfaceConfig
{

	public function get(string $key);

	public function set(string $key, $vals);

}
