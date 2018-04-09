<?php
namespace cmu\html\products;


abstract class AbstractMetaQueryDic
{ 

    protected $metaobject;                  // Metaarray() object
    protected $requestobject;               // Request() object 
    protected $att = []; 				//I think this is needed to the overall form, see child.
    protected $dn;							//may pass dn

    abstract public function returnDisplayObject();

    abstract protected function returnTotalObject();

}
