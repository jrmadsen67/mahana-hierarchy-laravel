<?php namespace Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy;

use Jrmadsen67\MahanaHierarchyLaravel\models\Hierarchy;
use Config;
 

class HierarchyEloquentRepository implements HierarchyRepositoryInterface
{

    protected $primary_key;

    protected $parent_id;

    protected $lineage;

    protected $deep;

    protected $parent_id_default;

    protected $padding_count;

    protected $padding_string;


    public function __construct()
    {
        $this->initialize(Config::get('mahana-hierarchy-laravel::hierarchy'));

        //seems wrong and hacky, but want to make _findChildren()
        //second param configurable & you can only use constants or static
        define('PARENT_ID_DEFAULT', $this->parent_id_default); 
    }


    public function initialize($config){

        if(!is_array($config)) return false;
        
        foreach($config as $key => $val){
            $this->$key = $val;
        }
    }


    public function get($top_id)
    {
        $query = \DB::table($this->table);

        // if $top_id == 0, we want everything
        if (!empty($top_id))
        {
            $parent = $this->get_one($top_id);
            if (empty($parent))
            {
                return [];
            }               
            $query->where($this->lineage, 'LIKE', $parent[$this->lineage] .'%');
        }   
        $items = $query->orderBy($this->lineage)->get();
        return $items;

    }

    public function get_one($id)
    {
        return Hierarchy::find($id);
    }


    public function get_children($parent_id)
    {      
        return Hierarchy::where($this->parent_id, '=', $parent_id)->orderBy($this->lineage)->get();
    }

    public function get_descendents($parent_id){
        $parent = $this->get_one($parent_id);
        if (empty($parent)) return array();

        // note that adding '-' to the like leaves out the parent record
        return Hierarchy::where($this->lineage, 'LIKE', $parent[$this->lineage] .'-%')->orderBy($this->lineage)->get();
    }


    public function get_ancestors($id, $remove_this){
        $current = $this->get_one($id);
        if (empty($current)) return array();

        $lineage_ids = explode('-' , $current[$this->lineage]);

        if ($remove_this) unset($lineage_ids[count($lineage_ids)-1]);

        return Hierarchy::whereIn($this->primary_key, $lineage_ids)->orderBy($this->lineage)->get();      
    }


    public function get_parent($id){
        $current = $this->get_one($id);
        if (empty($current)) return array();

        return Hierarchy::where($this->primary_key, '=', $current['parent_id'])->get();
    }


    public function get_grouped_children($top_id){

        $result = $this->get($top_id);
        if (empty($result)) return array();

        $grouped_result = $this->_findChildren($result);

        return $grouped_result;        
    }

    public function insert($data)
    {
        $data[$this->deep] = 0;
        if(!empty($data['parent_id']))
        {
            //get parent info
            $parent = $this->get_one($data[$this->parent_id]);
            $data[$this->deep] = $parent[$this->deep] + 1;
        }   

        $newRecord = Hierarchy::create($data);

        //update new record's lineage
        $update[$this->lineage] = (empty($parent[$this->lineage]))? str_pad($newRecord->id, $this->padding_count ,$this->padding_string, STR_PAD_LEFT)
            : $parent[$this->lineage].'-'.str_pad($newRecord->id, $this->padding_count, $this->padding_string, STR_PAD_LEFT);   

        return $this->update($newRecord->id, $update);
    }

    public function update($id, $data)
    {
        $result = Hierarchy::where($this->primary_key, '=',$id)->update($data);
        return $this->get_one($id);      
    }

    public function delete($id, $with_children)
    {
        $result = Hierarchy::where(function($query) use ($id, $with_children){
            $query->where($this->primary_key, '=', $id);
            if ($with_children)
            {
                $parent = $this->get_one($id);

                if (!empty($parent))
                {           
                    $query->orWhere($this->lineage, 'LIKE', $parent[$this->lineage].'-%');
               }  
            }   
        });

        $result->delete();
    }

    public function max_deep()
    {
        $max_deep = Hierarchy::max($this->deep);
        return $max_deep  + 1; //deep starts at 0        
    }

    public function resync()
    {
        //we could probably just re-write this with two copies of your table, and update. I think this will run safer and leave less to worry
        $current_data = Hierarchy::select([$this->primary_key, $this->parent_id])->orderBy($this->parent_id, 'asc')->get()->toArray();

        if (!empty($current_data))
        {
            foreach ($current_data as $row) {

                $update[$this->deep] = 0;

                if(!empty($row[$this->parent_id]))
                {
                    //get parent info
                    $parent = $this->get_one($row[$this->parent_id]);
                    $update[$this->deep] = $parent[$this->deep] + 1;
                }                   

                $update[$this->lineage] = (empty($parent[$this->lineage]))? str_pad($row[$this->primary_key], $this->padding_count ,$this->padding_string, STR_PAD_LEFT): $parent[$this->lineage].'-'.str_pad($row[$this->primary_key], $this->padding_count, $this->padding_string, STR_PAD_LEFT);
                $this->update($row[$this->primary_key], $update); 
                unset($parent);
            }
        }


    }

    // Thank you, http://stackoverflow.com/users/427328/elusive
    function _findChildren(&$nodeList, $parentId = PARENT_ID_DEFAULT) {
        $nodes = array();

        foreach ($nodeList as $node) {
            if ($node->parent_id == $parentId) {
                $node->children = $this->_findChildren($nodeList, $node->id);
                $nodes[] = $node;
            }
        }

        return $nodes;
    }

}