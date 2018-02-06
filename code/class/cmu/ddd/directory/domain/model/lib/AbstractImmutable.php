<?php 
/*
* Immutable parent for child Value Objects
*
*
*/
namespace cmu\ddd\directory\domain\model\lib;
abstract class AbstractImmutable

{

    use TraitValidator, TraitDynSetGet;

    //we dont need these magic methods in Value Objects
    public function __set(string $id, $val) : void { return; }

    public function __unset(string $val): void { return; }

}
