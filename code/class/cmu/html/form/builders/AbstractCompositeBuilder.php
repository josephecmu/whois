<?php 
namespace cmu\html\form\builders;

abstract class AbstractCompositeBuilder extends AbstractFormBuilder

{

    use \cmu\html\builders\TraitCompositeBuilder;

    function __construct(array $metaarray_in) {
        //include the setters in AbstractBuilder.php
        parent::__construct($metaarray_in);
        //parse out options array
        self::$optionsarray = !empty(self::$metaarray['optionsarray']) ? self::$metaarray['optionsarray'] : null ;
        //create Composite Control per ELEMENT BLOCK
		$this->composite = new \cmu\html\form\products\CompositeControl;
        //DYNAMIC composite SETTER
        //if the first 4 characters of the array key are "comp", map to $this->composite
        //this allows us to map to the CONTAINER holding the elements.
        $comparray = array();  //define array

        foreach (self::$elementarray as $k => $v) {

            if (substr($k, 0, 4) == 'comp') {
                //strip the 'comp' from the front of the key
                $key = str_replace('comp', '', substr($k, 4));

                $comparray[$key] = $v;

            }

        }

        $this->composite->setThisProperty($comparray);  //assign properties from above array

        $this->composite->setClass("div"); //global assign

    }
    //overrride parent addToComposite() due to array
    function addToComposite(\cmu\html\products\InterfaceComposite $composite)

    {

        foreach ($this->buildercomponents as $component) {
        
            $object = $component->returnLeaf();
                
            if (is_array($object)) {  //array returning multiple objects
            
                foreach ($object as $obj) {

                    $this->composite->addComponent($obj);  //add to composite and below
                                                                                  
                }
                
            } else {  //returning single object
            
                $this->composite->addComponent($object);  //add to composite
            
            }

            $composite->addComponent($this->composite);  //add to Composite

        }

    }
    
}