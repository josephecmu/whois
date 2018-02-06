<?php
namespace cmu\html\products;

abstract class AbstractProduct

{
    //GLOBAL ATTRIBUTES that many elements support
    protected $id = null;
    protected $class = null;
    protected $title = null;

    //default visitor implimentation assumes \visitors\ReturnHtmlVisitor()
    public function returnHtml()  //PUBLIC so we can access the elements WITHOUT COMPOSITE

    {
        $namespace = ((new \ReflectionObject($this))->getNamespaceName());

        $ulevel_nspace = substr($namespace, 0, strrpos($namespace, '\\'));

        $class = $ulevel_nspace . '\visitors\ReturnHtmlVisitor';

        $visitor = new $class();

        return $this->accept($visitor);

    }

    public function getAttributes()

    {
        //find all methods of this class
        $methodsarray = get_class_methods($this);

        foreach ($methodsarray as $method) {

            if (substr($method, 0, 7 ) === "getHtml") {

                $attarray[] = $this->$method();
                
            }

        }

        $string = implode(' ', $attarray);

        return $string;

    }

    protected function accept(\cmu\html\visitors\AbstractVisitor $visitor)

    {

        $classname = get_class($this);

        $classname = substr($classname, strrpos($classname, '\\') + 1);

        $method = "visit" . $classname;

        return $visitor->$method($this);

    }

    function setId($id_in)

    {

        $this->id = $id_in;

    }
    
    function setClass($class_in)

    {

        $this->class = $class_in ;

    }

    function setTitle($title_in)

    {

        $this->title = $title_in;

    }

    protected function getHtmlId()

    {

        if (isset($this->id)) { 
        
            return "id = '" . $this->id . "'";

        }

    }

    protected function getHtmlClass()

    {

        if (isset($this->class)) { 
        
            return "class = '" . $this->class . "'";

        }

    }

    protected function getHtmlTitle()

    {

        if (isset($this->title)) { 
        
            return "title = '" . $this->title . "'";

        }

    }

    public function returnExternalObjectHtml($obj, array $objarray)

    {

        $obj = new $obj;

        $obj->setThisProperty($objarray, $this);  //have to pass $this to method below.
        
        return $obj->returnHtml();

    }
    //public dynamic setter
    public function setThisProperty(array $objectarray, $extobj = null)

    {

       
        if (array_key_exists('externalarray', $objectarray)) {              //reorder to set externalarray first

            //$new_value = $objectarray['externalarray'];

            //unset($objectarray['externalarray']);

            //array_unshift($objectarray, $new_value);

            ////print_r($objectarray['externalarray']);

            //print_r($objectarray);
            //echo "<br />";
            //echo "<br />";

            $this->setExternalarray($objectarray['externalarray']);

            unset($objectarray['externalarray']);  //we don't need

        }


        $comp_obj = (null !== $extobj) ? $extobj : $this;   //compare object 

        foreach ($objectarray as $k => $v) {

            if (property_exists($this, $k)) {  //standard check if $k is property in current OBJECT

                if (is_array($v) !== true) { //make sure NOT array, STRATEGY below only handles SINGLE values, not ARRAYS
                   
                    $v = (new \cmu\html\products\property\SetPropertyContext())->setValue($v, $comp_obj); //<--STRATEGY to return correct value for assigning to object property

                }

                $this->{'set'.ucwords($k)}($v);  //assign all values

            }

        }

    }

}