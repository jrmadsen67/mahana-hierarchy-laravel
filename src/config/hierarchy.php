<?php


return [
	
	// If you need to change your table name or fields
	'table'             => 'hierarchy',
	
	'primary_key'       => 'id',

	'name'				=> 'name',
	
	'parent_id'         => 'parent_id',
	
	'lineage'           => 'lineage',
	
	'deep'              => 'deep', 

	'fillable'			=> ['name', 'parent_id', 'lineage', 'deep', 'object_id', 'object_type_id'],     
	
	// match your parent_id default, as null, 0 or whatever
	'parent_id_default' => null, 
	
	// The lineage padding count & mask
	'padding_count'     => 5,
	
	'padding_string'    => '0',

];


