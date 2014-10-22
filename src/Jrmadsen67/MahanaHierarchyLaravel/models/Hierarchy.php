<?php
namespace Jrmadsen67\MahanaHierarchyLaravel\models;

class Hierarchy extends \Eloquent {

	protected $table = 'hierarchy';  // Config::get('mahana-hierarchy-laravel::hierarchy.table')
	
	protected $fillable = ['name', 'parent_id']; 


}