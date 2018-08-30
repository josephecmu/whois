<?php 
namespace cmu\html\form\builders;

use \cmu\html\form\products\Input;
use \cmu\html\form\products\Label;
use \cmu\html\general\products\Div;

class LeafTextGroupDeleteBuilder extends AbstractLeafBuilder

{

	private $existing;

	function returnLeaf()

	{
		//we need a loop to start the outter array couter (ex. outlets[0][outletid])
		//values array  check for the existance of the first element of the array, if it is set, we have values here.
		//else, make a blank for new entries.	
 		$numberofvaluesarray = (isset(self::$valuesarray[0])) ? count(self::$valuesarray) + 1 : 1 ;

		//'textboxes' must be set for LeafTextGroupBuilder in the '.conf' file (ex. rooms.conf)
		$numberoftextboxes = count(self::$metaarray['textboxes']) ;

		for ($i = 0; $i < $numberofvaluesarray; $i++) {		//$i iteration of values array(i.e. number outlets) 

			$rand = rand(5,10000);	//this sets a single int to reference the related fields per value.

			for ($t = 0; $t < $numberoftextboxes + 1 ; $t++) { //number of checkboxes + 'delete' button

				if ($t < $numberoftextboxes ) { 

					$this->obj = new Input;
					
					//we need the NAME of the key to return.  It's cleaner to assign to a variable.
					$key = self::$metaarray['textboxes'][$t];

					if (isset(self::$valuesarray[$i][$key])) { //only print values if values array exists

						$this->changeProperty('replace', 'value', array_values(self::$valuesarray)[$i][$key]);
						$this->changeProperty('replace', 'readonly', 'readonly');
						$this->changeProperty('append', 'class', $rand . "outlet");	
						$this->existing = 'yes';

					} elseif ( $t == $numberoftextboxes - 2 ) {  //hide the 'dn' field if no values
						 $this->changeProperty('replace', 'type', 'hidden');
					} elseif ( $t == $numberoftextboxes - 3 ) {

						$this->changeProperty('replace', 'placeholder', 'New OutletID');
					}

					if ( $t == $numberoftextboxes - 1 ) {   //delete field
						$this->changeProperty('append', 'class', $rand);
						$this->changeProperty('replace', 'type', 'hidden');				
						$this->changeProperty('delete', 'readonly');
					}

					$this->changeProperty( 'replace', 'appendname', '[' . $i   . ']' , '[' . $key . ']' );
					$this->changeProperty( 'replace', 'alt', self::$metaarray['textboxes'][$t]);
			

				} elseif ($this->existing == 'yes') {
					//Delete button
						$this->obj = new Input;
						$this->changeProperty('replace', 'type', 'button');
						$this->changeProperty('replace', 'name', 'Delete');
						$this->changeProperty('replace', 'value', 'Delete');
						$this->changeProperty('delete', 'readonly');
						$this->changeProperty('replace', 'onclick', "deleteSubObj('." . $rand . "')"  ); 
						$this->changeProperty('replace', 'id', $rand . "button");
						$this->changeProperty('append', 'class', $rand . "button");
						$this->existing = null;//reset

				}  else {
					$this->changeProperty('replace', 'type', 'hidden');		//hack to hide field.

				}

				$this->arrayChangeProperty();
				$this->setProperty();
					
				$objects[] = $this->obj; 


			}

			//this should go in CompositeTextboxgrouparrayBuilder
			//we need to return a new close div and open div tag here
//			$objects[]	= new \cmu\html\general\products\Div;

		}

		return $objects;
    }

}
