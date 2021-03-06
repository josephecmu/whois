<?php
/*
 * Identity Object
 * encapsulates query criteria, thereby decoupling the system from database syntax.
 * Fluent Interface
 *
 */
namespace cmu\ddd\directory\infrastructure\domain\model\idobject;

use cmu\config\site\bin\Conf;
use cmu\ddd\directory\infrastructure\domain\model\share\TraitConfigDomain;

abstract class AbstractIdentityObject
{

	use TraitConfigDomain;

	protected $currentfield = null;
	protected $fields = [];
	protected $and = null;   //<--what is this for?
	protected $enforce = [];
	
	private $globalcondition="&";

	// an identity object can start off empty, or with a field
	 public function __construct(string $field = null)
	 {
			$options = $this->getConfigArray("idobj.ini");						//get enforce fields from .ini file
			$conf=$this->returnConcreteConfigObject($options);                  //child implimentation 

			if (! is_null($conf->get("enforceatt"))) {
				$this->enforce = $conf->get("enforceatt");
			}

			 if (! is_null($field)) {
				 $this->field($field);
			 }
	 }
	public function setGlobalCondition($cond_in) : void
	{
		$this->globalcondition = $cond_in;
	}

	public function getGlobalCondition() : string
	{
		return $this->globalcondition;
	}

	// field names to which this is constrained
	public function getObjectFields() : array
	  {
		  return $this->enforce;
	  }

	public function field(string $fieldname): self
	{
		if (! $this->isVoid() && $this->currentfield->isIncomplete()) {
			throw new \Exception("Incomplete field");
		}

//		$this->enforceField($fieldname);

		if (isset($this->fields[$fieldname])) {
			$this->currentfield = $this->fields[$fieldname];
		} else {
			$this->currentfield = new Field($fieldname);
			$this->fields[$fieldname] = $this->currentfield;
		}
		return $this;					//Fluent Interface
	}

	// does the identity object have any fields yet
    public function isVoid(): bool
    {
		return empty($this->fields);
	}

	// is the given fieldname legal?
//	 public function enforceField(string $fieldname)
//	 {
//		 if (! in_array($fieldname, $this->enforce) && ! empty($this->enforce)) {
//			 $forcelist = implode(', ', $this->enforce);
//			 throw new \Exception("{$fieldname} not a legal field ($forcelist)");
//		 }
//	 }

	// add an equality operator to the current field
	 // ie 'age' becomes age=40
	 // returns a reference to the current object (via operator())
	 public function eq($value): self
	 {
		 return $this->operator("=", $value);
	 }
	  // less than
	  public function lt($value): self
	  {
		  return $this->operator("<", $value);
	  }
	 
	  // greater than
	  public function gt($value): self
	  {
		  return $this->operator(">", $value);
	  }
	  // does the work for the operator methods
	  // return all comparisons built up so far in an associative array
	  // does the work for the operator methods
	  // gets the current field and adds the operator and test value
	  // to it
	  private function operator(string $symbol, $value): self
	  {
	  		if ($this->isVoid()) {
	   			throw new \Exception("no object field defined");
			}
	   		$this->currentfield->addTest($symbol, $value);
			return $this;
	  }

	  public function getComps(): array
	  {
	  		$ret = [];
		   	foreach ($this->fields as $field) {
		   		$ret = array_merge($ret, $field->getComps());
		   	}
	  		return $ret;
	  }

	  public function __toString() : string
	  {
		  $ret = [];
		  foreach ($this->getComps() as $compdata) {
			  $ret[] = "{$compdata['name']} {$compdata['operator']} {$compdata['value']}";
		  }
		  return implode(" AND ", $ret);
	  }
}
