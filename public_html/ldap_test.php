
<?php
//glboal include
// include_once '../code/class/cmu/config/site/whois.conf';

 $ret=[	 'count' => 1,
		 0 => [
				 'cn' =>[ 'count' => 1,
					      0 => 'Jack'],
				  0 => 'cn',
				 'sn' => [ 'count' => 1,
					       0 => 'Evans'],
			     1 => 'sn',
				 'count' => 2,
				 'dn' => 'uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu'
			 ]
		];

echo "<pre>";
print_r($ret);
echo "</pre>";

//function recursive($array){
//	    foreach($array as $key => $value){
			//If $value is an array.
	//        if(is_array($value)){
//                    //We need to loop through it.
//                                recursive($value);
//                                        } else{
	//                                                    //It is not an array, so print it out.
	//                                                                echo $value, '<br>';
	//                                                                        }
	//                                                                            }
	//                                                                            }




echo "Strip 'count'";
#https://stackoverflow.com/questions/1708860/php-recursively-unset-array-keys-if-match
function recursive_unset(&$array, $unwanted_key) {
	unset($array[$unwanted_key]);
	foreach ($array as &$value) {
		if (is_array($value)) {
			recursive_unset($value, $unwanted_key);
		}
	}
}

function unset_int($array) {

	


}
recursive_unset($ret, "count");

echo "<pre>";
print_r($ret);
echo "</pre>"; 

unset_int($ret);


echo "<pre>";
print_r($ret);
echo "</pre>"; 
