<?php 
namespace cmu\html\form\builders;

use \cmu\html\form\products\Input;

class LeafTextGroupDeleteBuilder extends AbstractLeafBuilder

{

	function returnLeaf()

	{
		//we need a loop to start the outter array couter (ex. outlets[0][outletid])
		//values array  check for the existance of the first element of the array, if it is set, we have values here.
		//else, make a blank for new entries.	
 		$numberofvaluesarray = (isset(self::$valuesarray[0])) ? count(self::$valuesarray) + 1 : 1 ;


			//'textboxes' must be set for LeafTextGroupBuilder in the '.conf' file (ex. rooms.conf)
			$numberoftextboxes = count(self::$metaarray['textboxes']) ;
	  		for ($i = 0; $i < $numberofvaluesarray; $i++) {		//$i iteration of values array(i.e. number outlets) 

//			$rand = rand(5,10000);	//this sets a single int to reference the related fields per value.

			$temp=[];

			for ($t = 0; $t < $numberoftextboxes ; $t++) { //number of checkboxes

				$this->obj = new Input;

				//we need the NAME of the key to return.  It's cleaner to assign to a variable.
				$key = self::$metaarray['textboxes'][$t];
				if (isset(self::$valuesarray[$i][$key])) { //only print values if values array exists

					$this->changeProperty('replace', 'value', array_values(self::$valuesarray)[$i][$key]);
					$this->changeProperty('replace', 'readonly', 'readonly');


	//				if ($t == $numberoftextboxes ) {  //hidden field

	//					$this->changeProperty('replace', 'appendname', '[' . $i   . ']', '[delete]');
	//					$this->changeProperty('replace', 'type', 'hidden');
	//					$this->changeProperty('replace', 'value', 'no'); 
	//					$this->changeProperty('delete', 'readonly');
	//					$this->changeProperty('append', 'class', $rand);

	//				} elseif ($t == $numberoftextboxes + 1) {  //button 	
	//
	//					$this->changeProperty('replace', 'type', 'button');
	//					$this->changeProperty('replace', 'name', 'Delete');
	//					$this->changeProperty('replace', 'value', 'Delete');
	//					$this->changeProperty('delete', 'readonly');
	//					$this->changeProperty('replace', 'onclick', "deleteSubObj('." . $rand . "')"  ); 


				} else {

					if ( $t == $numberoftextboxes -1 ) {   //delete
				
						$this->changeProperty('delete', 'readonly');
						$this->changeProperty('replace', 'placeholder', 'delete? type yes');
					}
					//below gives us:
					//entity[x][d]  (i.e. outlets[0][outletid])
					//this is needed to return a proper POST array.
			
				}

			
				$this->changeProperty( 'replace', 'appendname', '[' . $i   . ']' , '[' . $key . ']' );

				$this->changeProperty( 'replace', 'alt', self::$metaarray['textboxes'][$t]);

				$this->arrayChangeProperty();
				
				$this->setProperty();

				$objects[] = $this->obj;


			}

			//create the <div>
			//this should go in CompositeTextboxgrouparrayBuilder
			//we need to return a new close div and open div tag here
			$objects[]	= new \cmu\html\general\products\Div;


		}

		return $objects;
    }

}
