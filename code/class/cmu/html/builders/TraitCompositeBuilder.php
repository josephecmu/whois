<?php 
namespace cmu\html\builders;

trait TraitCompositeBuilder

{
    //used to hold objects and iterate through build()
    protected $buildercomponents = array();
    //pieces of the control that will be placed into composite
    protected $component;
    //the CompositeControl
    protected $composite;

    //add component to BUILDERCOMPONEENTS array
    protected function addBuilder( AbstractBuilder $component_in)

    {

        if (in_array ($component_in, $this->buildercomponents, true)) {

            return;

        }
        
        $this->buildercomponents[] = $component_in;

    }
	//Template//////////// build()
    //Child must implement
    abstract function make();
    //Template
    public function build(\cmu\html\products\InterfaceComposite $composite)

    {

        $this->make();  //will run make() in each builder (which creates and returns new Leafobjects)

        $this->addToComposite($composite);

    }

    private function addToComposite(\cmu\html\products\InterfaceComposite $composite)

    {

        foreach ($this->buildercomponents as $component) {
        
        $object = $component->returnLeaf();

            $composite->addComponent($object);  //add to Composite

        }

    }

}