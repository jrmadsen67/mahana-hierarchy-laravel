<?php namespace Jrmadsen67\MahanaHierarchyLaravel;

use Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy\HierarchyEloquentRepository;

class MahanaHierarchyLaravel {


    protected $hierarchy_repo;

    public function __construct(HierarchyEloquentRepository $hierarchy_repo)
    {
        $this->hierarchy_repo = $hierarchy_repo;
    }  

    // Fetch all records based on the primary key, ordered by their lineage. 
    // param - integer - allows you to return only from a certain point  (optional)
    // Returns result_array 
    public function get($top_id=0)
    {
        $items = $this->hierarchy_repo->get($top_id);

        // error handle

        return $items;      
    }

    // // Fetch a single record based on the primary key. 
    // // Returns row_array
    public function get_one($id)
    {
		$item = $this->hierarchy_repo->get_one($id); 

        // error handle

        return $item->toArray();                 
    }

    // Fetch all direct child records based on the parent id, ordered by their lineage. 
    // param - integer - parent id of child records
    // Returns result_array 
    public function get_children($parent_id)
    {
        $items = $this->hierarchy_repo->get_children($parent_id); 

        // error handle

        return $items;         
    } 

    // Fetch all descendent records based on the parent id, ordered by their lineage. 
    // param - integer - parent id of descendent records
    // Returns result_array 
    public function get_descendents($parent_id)
    {       
        $items = $this->hierarchy_repo->get_descendents($parent_id); 

        // error handle

        return $items;     
    }

    // Fetch all ancestor records based on the id, ordered by their lineage (top to bottom). 
    // param - integer - id of descendent record
    // Returns result_array 
    public function get_ancestors($id, $remove_this = false)
    {       
        $items = $this->hierarchy_repo->get_ancestors($id, $remove_this); 

        // error handle

        return $items;   
    }

    // Fetch parent of record based on the id 
    // param - integer - id of descendent record
    // Returns row 
    public function get_parent($id)
    {       
        $item = $this->hierarchy_repo->get_parent($id); 

        // error handle

        return $item->toArray();
    }

    // Fetch all descendent records based on the parent id, ordered by their lineage, and groups them as a mulit-dimensional array. 
    // param - integer - parent id of descendent records (optional)
    // Returns result_array 
    public function get_grouped_children($top_id=0)
    {
        $items = $this->hierarchy_repo->get_grouped_children($top_id); 

        // error handle

        return $items;   
    }   


    // inserts new record. If no parent_id included, assumes top level item
    // returns result of final statement
    public function insert($data)
    {
        $item = $this->hierarchy_repo->insert($data); 

        // error handle

        return $item->toArray(); 

    } 


    // updates record
    // returns update result
    public function update($id, $data)
    {
        $item = $this->hierarchy_repo->update($id, $data); 

        // error handle

        return $item->toArray();                   
    }


    // deletes record
    // param - true/false - delete all descendent records
    public function delete($id, $with_children=false)
    {
        return $this->hierarchy_repo->delete($id, $with_children);
    }


    // gets the maximum depth of any branch of tree
    // returns integer
    public function max_deep()
    {
        return $this->hierarchy_repo->max_deep();
    }


    //for use when the data is existing & has parent_id, but no lineage or deep
    //can be used to repair your data or set it up the first time
    function resync()
    {
        $this->hierarchy_repo->resync();

    }


}