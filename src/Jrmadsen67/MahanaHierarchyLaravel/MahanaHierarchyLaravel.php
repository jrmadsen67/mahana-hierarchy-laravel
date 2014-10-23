<?php namespace Jrmadsen67\MahanaHierarchyLaravel;

use Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy\HierarchyEloquentRepository;

class MahanaHierarchyLaravel {


    protected $hierarchy_repo;

    
    /**
    * __construct
    *
    * @param HierarchyEloquentRepository
    *
    * @return void
    */
    public function __construct(HierarchyEloquentRepository $hierarchy_repo)
    {
        $this->hierarchy_repo = $hierarchy_repo;
    }  
    
    /**
    * Fetch all records based on the primary key, ordered by their lineage.
    *
    * @param $top_id integer - allows you to return only from a certain point  (optional)
    *
    * @return Collection
    */
    public function get($top_id=0)
    {
        return $this->hierarchy_repo->get($top_id);     
    }
    
    /**
    * Fetch a single record based on the primary key.
    *
    * @param $id integer
    *
    * @return row_array
    */
    public function get_one($id=0)
    {
        if (empty($id)) return [];
		$item = $this->hierarchy_repo->get_one($id); 

        if (empty($item)) return [];

        return $item->toArray();                 
    }
    
    /**
    * Fetch all direct child records based on the parent id, ordered by their lineage.
    *
    * @param $parent_id - integer - parent id of child records
    *
    * @return Collection
    */
    public function get_children($parent_id=0)
    {
        if (empty($parent_id)) return [];
        $items = $this->hierarchy_repo->get_children($parent_id); 

        return $items->toArray();         
    } 

    
    /**
    * Fetch all descendent records based on the parent id, ordered by their lineage.
    *
    * @param $parent_id - integer - parent id of descendent records
    *
    * @return Collection
    */
    public function get_descendents($parent_id)
    {       
        if (empty($parent_id)) return [];
        $items = $this->hierarchy_repo->get_descendents($parent_id); 

        if (empty($item)) return [];

        return $items->toArray();       
    }
    
    /**
    * Fetch all ancestor records based on the id, ordered by their lineage (top to bottom).
    *
    * @param $id - integer - id of descendent record
    * @param $remove_this - boolean - whether to include or exclude record of id
    *
    * @return Collection
    */
    public function get_ancestors($id, $remove_this = false)
    {       
        if (empty($id)) return [];
        $items = $this->hierarchy_repo->get_ancestors($id, $remove_this); 

        if (empty($items)) return [];

        return $items->toArray();     
    }
    
    /**
    * Fetch parent of record based on the id 
    *
    * @param $id - integer - id of descendent record
    *
    * @return row_array
    */
    public function get_parent($id)
    {       
        $item = $this->hierarchy_repo->get_parent($id); 

        // error handle

        return $item->toArray();
    }
    
    /**
    * Fetch all descendent records based on the parent id, ordered by 
    * their lineage, and groups them as a mulit-dimensional array. 
    *
    * @param $top_id - integer - parent id of descendent records (optional)
    *
    * @return Collection
    */
    public function get_grouped_children($top_id=0)
    {
        return $this->hierarchy_repo->get_grouped_children($top_id);   
    }   
    
    /**
    * inserts new record. If no parent_id included, assumes top level item
    *
    * @param $data - array
    *
    * @return row_array
    */
    public function insert($data)
    {
        $item = $this->hierarchy_repo->insert($data); 

        // error handle

        return $item->toArray(); 

    } 
    
    /**
    * updates record
    *
    * @param $id - integer
    * @param $data - array
    *
    * @return row_array - updated result
    */
    public function update($id, $data)
    {
        $item = $this->hierarchy_repo->update($id, $data); 

        // error handle

        return $item->toArray();                   
    }
    
    /**
    * deletes record
    *
    * @param $id - integer - record to delete
    * @param $with_children - boolean - whether or not to also delete children records
    *
    * @return void
    */
    public function delete($id, $with_children=false)
    {
        return $this->hierarchy_repo->delete($id, $with_children);
    }
    
    /**
    * gets the maximum depth of any branch of tree
    *
    * @return integer
    */
    public function max_deep()
    {
        return $this->hierarchy_repo->max_deep();
    }

    /**
    * for use when the data is existing & has parent_id, but no lineage or deep
    * can be used to repair your data or set it up the first time
    *
    * @return void
    */    
    function resync()
    {
        $this->hierarchy_repo->resync();
    }


}