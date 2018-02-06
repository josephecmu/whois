<?php 
namespace cmu\html\products;

interface InterfaceComposite

{
    //INTERFACE for COMPOSITE containers must impliment functions below from AbstractProduct
    function addComponent(\cmu\html\products\AbstractProduct $component_in);

    function removeComponent(\cmu\html\products\AbstractProduct $component_in);

}