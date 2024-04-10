<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	vcard Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class vcard_m extends MY_Model {

	public function __construct()
	{
		 parent::__construct();
         
         //echo 'hany';
	}
    
	public function get_by()
	{
		$where =& func_get_args();
		$this->_set_where($where);

		return $this->db->get($this->_table)
			->row();
	}
    
    /**
     * Get all vcard entries
     *
     * @author Hany alsamman
     * @access public
     * @return mixed
     */
    public function get_all($limit = NULL, $since)
    {
        $this->db->where('date', $since);
    	$this->db->order_by("id", "desc");
    	if (isset($limit)){ $this->db->limit($limit); }
        $results = $this->db->get('vcard');
        $result = $results->result_array();
        return $result;
    }
    
    public function get_all_admin($limit = NULL)
    {
    	$this->db->order_by("id", "desc");
    	if (isset($limit)){ $this->db->limit($limit); }
        $results = $this->db->get('vcard');
        $result = $results->result_object();
        return $result;
    }
    
    /**
     * Get one vcard entry
     *
     * @author Hany alsamman
     * @access public
     * @param array $id The ID of the entry to get
     * @return mixed
     */
    public function get($id)
    {
        $results = $this->db->get_where('vcard', array('id' => $id));
        $result = $results->row_object();
        return $result;
    }
    
    /**
     * Insert a new entry into the database
     *
     * @author Hany alsamman
     * @access public
     * @param array $input The data to insert (a copy of $_POST)
     * @return bool
     */
    public function insert_vcard($input)
    {
        // Setup the data to insert
        $to_insert = array(
            'name' => $input['name'],
            'description' => $input['description'],
            'date' => $input['date']
        );

        // Insert the data into the database
        if ($this->db->insert('vcard',$to_insert))
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Update an existing entry
     *
     * @author Hany alsamman
     * @access public
     * @param int $id The ID of the entry to update
     * @param array $input The data to use for updating the DB record
     * @return bool
     */
    public function update_entry($id, $input)
    {
        
        if (isset ($input['delete']) )
        {
        	if($this->delete($id))
        	{
        		return TRUE;
        	} else {
        		return FALSE;
        	}
        } else {
            
            $new_data = array(
                'name' => $input['name'],
                'description' => $input['description'],
                'picture' => $input['picture'],
                'date' => $input['date']
            );
        
	        $this->db->where('id', $id);
	        if ($this->db->update('vcard', $new_data))
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
     * @author Hany alsamman
     * @access public
     * @param int $id The ID of the entry to delete
     * @return bool
     */
    public function delete($id)
    {
        if ($this->db->delete('vcard', array('id' => $id)))
        {
            // delete the cast list under this vcard
            $this->db->delete('vcard_cast', array('vid' => $id));
            
            return TRUE;    
        } else {
            return FALSE;    
        }
    }
    
    public function get_groups()
    {
        return $this->db->query('SELECT id,description FROM `groups`')->result_array();
    }
    
    public function user_delete($uid,$vid)
    {
        if ($this->db->delete('vcard_cast', array('uid' => $uid, 'vid' => $vid)))
        {
            return TRUE;    
        } else {
            return FALSE;    
        }
    }    
    
    public function user_add($uid, $gid, $vid)
    {
        // Setup the data to insert
        $to_insert = array(
            'uid' => $uid,
            'gid' => $gid,
            'vid' => $vid
        );

        // Insert the data into the database
        if ($this->db->insert('vcard_cast',$to_insert))
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function user_search($match)
    {
        
        //$this->db->select('username, email, last_login, created, modified, group_id');
        //$this->db->from($this->table_name);
        //$this->db->where('users.status', 'active')

        $result = $this->db->query("SELECT user_id AS id,display_name AS data , gravatar AS thumbnail , display_name AS description FROM `profiles` WHERE display_name LIKE '$match%'");
        
        if($result->num_rows()>0) return $result->result_array(); else return false;
    }
     
    public function user_search_with_id($match)
    {
        
        //$this->db->select('username, email, last_login, created, modified, group_id');
        //$this->db->from($this->table_name);
        //$this->db->where('users.status', 'active')

        //$result = $this->db->query("SELECT user_id AS id,display_name AS data , gravatar AS thumbnail , display_name AS description FROM `profiles` WHERE display_name LIKE '$match%'");
        
        $result = $this->db->query("SELECT `p`.user_id AS id, `p`.display_name AS data , `p`.gravatar AS thumbnail , `p`.display_name AS description FROM `profiles` p, `users` u WHERE `p`.display_name LIKE '$match%' and `u`.id = `p`.user_id");
        if($result->num_rows()>0) return $result->result_array(); else return false;
    }
    
    public function user_search_with_username($match, $group_by=false)
    {
        
        //$this->db->select('username, email, last_login, created, modified, group_id');
        //$this->db->from($this->table_name);
        //$this->db->where('users.status', 'active')

        //$result = $this->db->query("SELECT user_id AS id,display_name AS data , gravatar AS thumbnail , display_name AS description FROM `profiles` WHERE display_name LIKE '$match%'");
        
        if($group_by != false) $get_by = "`u`.group_id = '$group_by' and";
        
        $result = $this->db->query("SELECT `u`.username AS id, `p`.display_name AS data , `p`.gravatar AS thumbnail , `p`.display_name AS description FROM `profiles` p, `users` u WHERE $get_by `p`.display_name LIKE '$match%' and `u`.id = `p`.user_id");
        if($result->num_rows()>0) return $result->result_array(); else return false;
    }
    
    public function vcard_search($match)
    {
        
        $result = $this->db->query("SELECT id, name AS data, description, picture AS thumbnail  FROM `vcard` WHERE name LIKE '$match%'");

        if($result->num_rows()>0) return $result->result_array(); else return false;
    }
    
    public function bulid_members($gid, $vid)
    {        
        $result = $this->db->query("SELECT v.gid AS group_id, p.user_id, p.first_name, p.display_name FROM `vcard_cast` v , `profiles` p WHERE v.vid = '$vid' and p.user_id = v.uid and v.gid = '$gid'");
        
        if($result->num_rows()>0) return $result->result_array(); else return false;
    }
    
    /**
     * Get full cast
     *
     * @author Hany alsamman
     * @access public
     * @return mixed
     */
    public function get_cast_by_id($vid, $gid, $limit=false)
    {
 
    	if ( is_array($gid) ) 
        {
            $groups = 'v.gid IN ('.implode(",", $gid).')';
            //$group_name = ', (SELECT description FROM (groups) WHERE id IN ('.implode(",", $gid).') AS mygroup';
            $group_name = false;
        }
        
        if(!is_array($gid)){
            $groups = 'v.gid = '.$gid.'';
            $group_name = ", (SELECT description FROM (groups) WHERE `id` = '$gid') AS mygroup";
        }
        
        $results = $this->db->query('SELECT v.gid, p.user_id, p.display_name, p.gravatar '.$group_name.' FROM `vcard_cast` v , `profiles` p WHERE v.vid = '.$vid.' and '.$groups.' and v.uid = p.user_id ');
        $result = $results->result_object();
        return $result;
    }
    
    public function get_fullcast_by_vid($vid, $limit = 5)
    {
        
        $get = $this->db->query('SELECT DISTINCT `gid` FROM `vcard_cast` WHERE `vid` = '.$vid.'')->result_object();
        
        return $get;
        
    }

}