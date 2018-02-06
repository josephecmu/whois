<?php
namespace cmu\html\products;

abstract class AbstractMetaQueryDic

{ 

    protected $metaobject;                  // Metaarray() object
    protected $requestobject;               // Request() object 
    protected $filter = "(objectClass=*)"; 
    protected $att = array();
    protected $dn;

    function __construct(\cmu\html\base\Meta $metaobject_in, array $ldap_parms_in) 

    {

        foreach ($ldap_parms_in as $prop => $v) {

            if (property_exists($this, $prop)) {

                $this->$prop = $v;

            }

        }

        $this->metaobject = $metaobject_in;

        $this->requestobject = (new \cmu\html\base\Request());

    }

    abstract function returnDisplayObject();

    abstract protected function returnTotalObject();

    public function setFilter( string $filter_in)

    {

        $this->filter = $filter_in;

    }

    public function setDn( string $dn_in)

    {

        $this->dn = $dn_in;

    }

    public function setAtt(string $att_in)

    {

        $this->att = $att_in;

    }
    
    
    //protected function returnMetaInj($object, $values)                          //shortcut method
    
    //{
    	
    	//$obj = "\\cmu\\html\\base\\" . $object;
    	
    	//$meta = new $obj;
    
    	//$meta->setProperties($this->metaobject->getProperties());

        //$meta->setValues($values);
    
        //$meta->injectValuesAndSet();

        //return $meta->getProperties();

	//}

}