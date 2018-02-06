<?php 
namespace cmu\html\general\builders;

abstract class AbstractLeafBuilder extends AbstractGeneralBuilder

{

    use \cmu\html\builders\TraitLeafBuilder;

    function __construct(array $overrides_in = null)

    {
        //make sure the metaarray has id, class, title, name:
        $core_attributes = array('id', 'class', 'title', 'name');

        foreach ($core_attributes as $att) {

            if (!array_key_exists($att, self::$metaarray)) {

                self::$metaarray[$att] = null;

            }

        }

        $this->overrides = $overrides_in;

    }

}