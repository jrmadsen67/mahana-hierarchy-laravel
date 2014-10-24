<?php
namespace Jrmadsen67\MahanaHierarchyLaravel\models;

class Hierarchy extends \Eloquent {

	protected $table; 
	
	protected $fillable;

	public function __construct()
	{

		$this->setFillable();

		$this->setTable(\Config::get('mahana-hierarchy-laravel::hierarchy.table'));
	}

	// Eloquent\Model uses a new static($attributes) that doesn't play nicely with __construct()
	public static function create(array $attributes)
	{
		$model = new Hierarchy;
		$model->fill($attributes);
		$model->save();
		return $model;
	}

	public function setFillable()
	{
		$name      = \Config::get('mahana-hierarchy-laravel::hierarchy.name');
		$parent_id = \Config::get('mahana-hierarchy-laravel::hierarchy.parent_id');
		$lineage   = \Config::get('mahana-hierarchy-laravel::hierarchy.lineage');
		$deep      = \Config::get('mahana-hierarchy-laravel::hierarchy.deep');

		$this->fillable = ['name', 'parent_id', 'lineage', 'deep'];
	}

}