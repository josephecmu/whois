<?php 
/**
 * This is a parent class of all entities in the Domain.
 *
 *
 */
namespace cmu\ddd\directory\domain\model\lib;

class AbstractEntity

{

    use TraitDynamicSetterVerifyProperty;

    public function __construct(array $fields = array()) {
    
		$this->confirmFieldsAndConfirmSetProperties($fields, $this->getRequiredFields());

    }

	public function getUid() : string		//we need a uniq public identifier
	{

		return $this->dn->dynGet('dn');

	}

	protected function getRequiredFields() : array

	{

		return array();		//incase we have no required fields

	}

}

