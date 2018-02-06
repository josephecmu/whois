<?php 
namespace cmu\html\form\products;

trait TraitTextValidate  //used to validate at the LEAF level for text errors regex

{
    private $filtertype = null;             //validate against this STRATEGY
    private $validateagainst = null;
    private $sanitize = null;               //sanitize against this STRATEGY
    
    function setValidateagainst($validateagainst_in)
    
    {
   
   		$this->validateagainst = $validateagainst_in;
    
    }
    
    function getValidateaginst()
    
    {
    
    	return $this->validateagainst;
    
    }

    function setFiltertype( string $in_filtertype)

    {
    
        $this->filtertype = $in_filtertype;

    }
    
    function setSanitize($in_sanitize)

	{
		
		$this->sanitize = $in_sanitize;
	
	}

    public function getFiltertype()

    {

        return $this->filtertype;

    }

    public function getSanitize()

    {

        return $this->sanitize;

    }

}