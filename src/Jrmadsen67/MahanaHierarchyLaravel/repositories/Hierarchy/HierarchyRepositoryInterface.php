<?php namespace Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy;
/**
 * Interface for the hierarchy repo
 */
interface HierarchyRepositoryInterface
{
	public function get($top_id);
	public function get_one($id);
	public function get_children($parent_id);
	public function get_descendents($parent_id);
	public function get_ancestors($id, $remove_this);
	public function get_parent($id);
	public function get_grouped_children($top_id);
	public function where($params);
	public function insert($data);
	public function update($id, $data);
	public function delete($id, $with_children);
	public function max_deep();
	public function resync();

}