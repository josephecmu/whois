<?php
namespace cmu\html\products;

use \cmu\html\base\registry\RequestRegistry;

abstract class AbstractMetaQueryDic

{ 

    protected $metaobject;                  // Metaarray() object
    protected $requestobject;               // Request() object 
    protected $filter = "(objectClass=*)"; 
    protected $att = array();
    protected $dn;
//	protected $request_registry;
	//
	//we may not pass the array $config_array, it needs to be determined based on REQUEST
    function __construct(\cmu\html\base\Meta $metaobject_in, array $config_array_in = null) 

	{

		$config_array =  $config_array_in ??  $this->getConfigArray() ;
		//table needs this.
        foreach ($config_array as $prop => $v) {

            if (property_exists($this, $prop)) {

                $this->$prop = $v;

            }

        }

        $this->metaobject = $metaobject_in;

        $this->requestobject = (new \cmu\html\base\Request());		//create a new Request

		if ($this->requestobject->getValue('dn'))
		{	
			$this->dn = $this->requestobject->getValue('dn');

		}

	}

    abstract function returnDisplayObject();

    abstract protected function returnTotalObject();
	//we need a function to get the correct config array
	protected function getConfigArray() : array
	{
		//$entity = ldap_explode_dn($this->dn, 1)[0];
		//
		//we now need to get the config array

	}

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

        
	//}

}
