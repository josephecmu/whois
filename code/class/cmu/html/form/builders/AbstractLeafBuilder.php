<?php 
namespace cmu\html\form\builders;

use \cmu\html\builders\TraitLeafBuilder;

abstract class AbstractLeafBuilder extends AbstractFormBuilder

{
    use TraitLeafBuilder;
       
    function __construct(array $overrides_in = null, string $counter_in=null)

    {
        //sanitize and check metaarray here

        //make sure the metaarray has id, class, title, for, name, reqnumber:
        $core_attributes = array('id', 'class', 'title', 'for', 'name', 'reqnumber' );

        foreach ($core_attributes as $att) {

            if (!array_key_exists($att, self::$metaarray)) {

                self::$metaarray[$att] = null;

            }

        }

		$this->overrides = $overrides_in;  		//is this declared anywhere?
		$this->counter = $counter_in;

    }

}
