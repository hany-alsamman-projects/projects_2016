<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * The testimonials module enables users to create and manage client testimonials.
 *
 * @author         Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
 * @package     PyroCMS
 * @subpackage     testimonials Module
 * @category     Modules
 * @license     Apache License v2.0
 */
class testimonials_m extends MY_Model {

    /**
     * Get all testimonial entries
     *
     * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
     * @access public
     * @return mixed
     */
    public function get_all($limit = NULL)
    {
    	$this->db->order_by("id", "desc");
    	if (isset($limit)){ $this->db->limit($limit); }
        $results = $this->db->get('wf_testimonials');
        $result = $results->result_array();
        return $result;
    }
    
    /**
     * Get one testimonial entry
     *
     * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
     * @access public
     * @param array $id The ID of the entry to get
     * @return mixed
     */
    public function get($id)
    {
        $results = $this->db->get_where('wf_testimonials', array('id' => $id));
        $result = $results->row_array();
        return $result;
    }
    
    /**
     * Insert a new entry into the database
     *
     * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
     * @access public
     * @param array $input The data to insert (a copy of $_POST)
     * @return bool
     */
    public function insert_testimonial($input)
    {
        // Setup the data to insert
        $to_insert = array(
            'name' => $input['name'],
            'location' => $input['location'],
            'comment' => $input['comment']
        );

        // Insert the data into the database
        if ($this->db->insert('wf_testimonials',$to_insert))
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Update an existing entry
     *
     * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
     * @access public
     * @param int $id The ID of the entry to update
     * @param array $input The data to use for updating the DB record
     * @return bool
     */
    public function update_entry($id, $input)
    {
        $new_data = array(
            'name' => $input['name'],
            'location' => $input['location'],
            'comment' => $input['comment']
        );
        
        if (isset ($input['delete']) )
        {
        	if($this->delete($id))
        	{
        		return TRUE;
        	} else {
        		return FALSE;
        	}
        } else {
        
	        $this->db->where('id', $id);
	        if ($this->db->update('wf_testimonials', $new_data))
	        {
	            return TRUE;    
	        } else {
	            return FALSE;    
	        }
	    }
    }
    
    /**
     * Delete an entry
     *
     * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
     * @access public
     * @param int $id The ID of the entry to delete
     * @return bool
     */
    public function delete($id)
    {
        if ($this->db->delete('wf_testimonials', array('id' => $id)))
        {
            return TRUE;    
        } else {
            return FALSE;    
        }
    }
}