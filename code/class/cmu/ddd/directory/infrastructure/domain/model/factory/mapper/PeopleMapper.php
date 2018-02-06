<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;

class PeopleMapper extends AbstractMapper

{
	//eventually  move to config.ini
	//re-mapper (attributes to Domain object names)
	protected $name_map = [	'cn'=>'firstname', 
							'sn'=>'lastname',
							'dn'=>'peoplerdn',
							'uid'=>'andrewid'];

	//mapping of attributed to SINGLE (s) or MULTIVALUE(m) attributes in subarray.	
	protected $single_map = ['firstname', 'lastname', 'peoplerdn', 'andrewid' ];

	//determines which attrubes should be in subarray, and 'name' of sub-array
	protected $group_map =[ 

							 'firstname' => 'name',
							 'lastname'  => 'name'

					     ];
	protected $to_array_map = ['peoplerdn'];
}
