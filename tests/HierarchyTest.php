<?php

class HierarchyTest extends \PHPUnit_Framework_TestCase {

    public function setUp()
    {

    } 

    public function tearDown()
    {

    }      

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testTrueIsTrue()
	{
		 $this->assertTrue(true);
	}

    public function testGet()
    {
   	// $top_id=0
    }

    public function testGetOne()
    {
		//$item = $this->hierarchy_repo->get_one($id); 
               
    } 

    public function testGetChildren()
    {
        //$items = $this->hierarchy_repo->get_children($parent_id); 
      
    }

    public function testGetDescendents()
    {       
        //$items = $this->hierarchy_repo->get_descendents($parent_id); 
    
    }

    public function testGetAncestors()
    {       
        //$items = $this->hierarchy_repo->get_ancestors($id, $remove_this); 
  
    }

    public function testGetParent()
    {       
        //$item = $this->hierarchy_repo->get_parent($id); 

    }

    public function testGetGroupedChildren()
    {
        //$items = $this->hierarchy_repo->get_grouped_children($top_id); 
  
    }  

    public function testInsert()
    {
        //$item = $this->hierarchy_repo->insert($data); 

    } 

    public function testUpdate()
    {
        //$item = $this->hierarchy_repo->update($id, $data); 
                  
    }

    public function testDelete()
    {
        //return $this->hierarchy_repo->delete($id, $with_children);
    }

    public function testMaxDeep()
    {
        //return $this->hierarchy_repo->max_deep();
    }

    public function testResync()
    {
        //$this->hierarchy_repo->resync();
    }    
}