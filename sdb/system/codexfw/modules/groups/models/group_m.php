<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Group model
 *
 * @author Hany alsamman - Codex Corp "Experts" Dev Team
 * @package CodexFW
 * @subpackage Groups module
 * @category Modules
 *
 */
class Group_m extends MY_Model
{
	/**
	 * Check a rule based on it's role
	 *
	 * @access public
	 * @param string $role The role
	 * @param array $location
	 * @return mixed
	 */
	public function check_rule_by_role($role, $location)
	{
		// No more checking to do, admins win
		if ( $role == 1 )
		{
			return TRUE;
		}

		// Check the rule based on whatever parts of the location we have
		if ( isset($location['module']) )
		{
			 $this->db->where('(module = "'.$location['module'].'" or module = "*")');
		}

		if ( isset($location['controller']) )
		{
			 $this->db->where('(controller = "'.$location['controller'].'" or controller = "*")');
		}

		if ( isset($location['method']) )
		{
			 $this->db->where('(method = "'.$location['method'].'" or method = "*")');
		}

		// Check which kind of user?
		$this->db->where('g.id', $role);

		$this->db->from('permissions p');
		$this->db->join('groups as g', 'g.id = p.group_id');

		$query = $this->db->get();

		return $query->num_rows() > 0;
	}

	/**
	 * Return an array of groups
	 *
	 * @access public
	 * @param array $params Optional parameters
	 * @return array
	 */
	public function get_all($params = array())
	{
		if ( isset($params['except']) )
		{
			$this->db->where_not_in('name', $params['except']);
		}

		return parent::get_all();
	}

	/**
	 * Add a group
	 *
	 * @access public
	 * @param array $input The data to insert
	 * @return array
	 */
	public function insert($input = array())
	{
		return parent::insert(array(
			'name'			=> $input['name'],
			'description'	=> $input['description']
		));
	}

	/**
	 * Update a group
	 *
	 * @access public
	 * @param int $id The ID of the role
	 * @param array $input The data to update
	 * @return array
	 */
	public function update($id = 0, $input = array())
	{
		return parent::update($id, array(
			'name'			=> $input['name'],
			'description'	=> $input['description']
		));
	}

	/**
	 * Delete a group
	 *
	 * @access public
	 * @param int $id The ID of the role to delete
	 * @return
	 */
	public function delete($ids = 0)
	{
		is_array($ids) OR $ids = array('id' => $ids);

		// Dont let them delete these.
		// The controller should handle the error message, this is just insurance
		$this->db->where_not_in('name', array('user', 'admin'));

		return parent::delete_many($ids);
	}
    
    
    public function get_all_groups($limit = NULL)
    {
    	$this->db->order_by("id");
        $this->db->where_not_in('id', array('1', '2'));
    	if (isset($limit)){ $this->db->limit($limit); }
        $results = $this->db->get('groups');
        $result = $results->result_array();
        return $result;
    }
}