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
		$this->fillable = \Config::get('mahana-hierarchy-laravel::hierarchy.fillable');
	}

}