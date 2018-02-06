<?php 

    //Global include file
    include_once '../code/class/cmu/config/site/whois.conf';

    $fields = array( "name" => [ "firstname" => "Joe",
                       			 "lastname" => "Evans"],
#                    "posixpeople" =>  ["gid" => 3000 ,
#                                       "uid" => 3000 ,
#                                   "homedir" => "/some/path"],
                       "andrewid" => "josephe" ,
                      "peoplerdn" => "uid=josephe,dc=cmu,dc=edu" 
					   );
	
    $fields2 = array( "name" => [ "firstname" => "Florin",
                       			 "lastname" => "Manolache"],
#                    "posixpeople" =>  ["gid" => 3000 ,
#                                       "uid" => 3000 ,
#                                   "homedir" => "/some/path"],
                       "andrewid" => "florin" ,
                      "peoplerdn" => "uid=florin,dc=cmu,dc=edu" 
					   );
	$outlets1 = ["outletid" => "45532jf", "outletrdn" => "uid=45532jf,dc=cmu,dc=edu"];
	$outlets2 = [ "outletid" => "45545-45532jf", "outletrdn" => "uid=45545-45532jf,dc=cmu,dc=edu"];

	$room_array = array ( "roomnumber" => "6102",
						"roomrdn" => "uid=6102WH,dc=cmu,dc=edu",
						"outlets" => [ $outlets1, $outlets2 ] 

				);

    $people = new \cmu\ddd\directory\domain\model\actors\people\People($fields);
    //Embedded Values////////////////
    echo $people->dynGet("name")->dynGet("firstname") . "   "   ;
echo "<br>";
    echo $people->dynGet("name")->dynGet("lastname") . "   "  ;
echo "<br>";
#    echo $people->dynGet("posixpeople")->dynGet("uid")->getId() . "   "  ;
#
#    echo $people->dynGet("posixpeople")->dynGet("gid")->getId() . "   "  ;

    echo $people->dynGet("andrewid")->getAndrewid() . "   " ;
echo "<br>";
#    echo $people->dynGet("posixpeople")->dynGet("homedir")->getPath() . "   " ;
#
    echo $people->dynGet("peoplerdn")->dynGet("dn");
echo "<br>";

	$room = new \cmu\ddd\directory\domain\model\locations\Rooms ($room_array);

echo "<br>";
	echo $room->dynGet("roomnumber") . "   " ;
echo "<br>";
	echo $room->dynGet("roomrdn")->dynGet("dn"). "   "  ;

	echo "<br>";
	

	echo "Adding a new outlet...";
	$newoutlet =  [ "outletid" => "-45532jf", "outletrdn" => "uid=-45532jf,dc=cmu,dc=edu"];
	$room->assignOutletToRoom($newoutlet);

	echo "NEW SET";	
	echo "<br>";

	


	print_r($room->dynGet("outlets"));
	echo "-------------------------------------------";

//	$userrepository = new \cmu\ddd\directory\infrastructure\domain\model\repository\UserRepository;
//	$addservice = new \cmu\ddd\directory\application\services\AddUserService($userrepository);
//	$addservice->execute($fields);
//	print_r($userrepository->returnPeople());

//	$addservice->execute($fields2);
//	echo "-------------------------------------------";
//
//	print_r($userrepository->returnPeople());
//	
//	$getuserservice = new \cmu\ddd\directory\application\services\GetUserService($userrepository);
//	
//
//	echo "-------------------------------------------";
//	print_r( $getuserservice->execute("uid=josephe,dc=cmu,dc=edu"));
?> 
