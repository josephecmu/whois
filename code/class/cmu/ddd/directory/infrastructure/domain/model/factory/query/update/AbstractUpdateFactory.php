<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

abstract class AbstractUpdateFactory

{
	
	abstract public function newUpdate(AbstractEntity $obj): string;
	
	//needs to be modified for LDAP...............................	
//	protected function buildStatement(string $table, array $fields, array $conditions = null): array

	protected function buildStatement( array $obj_array) : array
	

	{










//			$terms = array();
//
//				if (! is_null($conditions)) {
//					$query  = "UPDATE {$table} SET ";
//					$query .= implode(" = ?,", array_keys($fields)) . " = ?";
//					$terms  = array_values($fields);
//					$cond   = [];
//					$query .= " WHERE ";
//
//					foreach ($conditions as $key => $val) {
//						$cond[] = "$key = ?";
//						$terms[] = $val;
//					}
//
//					$query .= implode(" AND ", $cond);
//					} else {
//						$query  = "INSERT INTO {$table} (";
//						$query .= implode(",", array_keys($fields));
//						$query .= ") VALUES (";
//
//					foreach ($fields as $name => $value) {
//						$terms[] = $value;
//						$qs[] = '?';
//
//						$query .= implode(",", $qs);
//						$query .= ")";
//					}
//
//			        return [$query, $terms];

		}

}
