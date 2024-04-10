<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Plugin
 *
 *
 * @package		CodexFW
 * @author		Codex Corp "Experts" Dev Team
 * @copyright	Copyright (c) 2008 - 2011, CodexFW
 *
 */
class Plugin_groups extends Plugin
{
	
    public function __construct()
	{
		
	}
    
	/**
	 * Usage:
	 *
	 * {pyro:groups:build_list}
	 *
	 * @param	array
	 * @return	array
	 */
	function build_list()
	{
		
        //$data['subjects']		= 'hany';
        
        $this->load->model('groups/group_m');
                
        $data['groups'] = $this->group_m->get_all_groups();
        

		return $this->module_view('groups', 'build_list', $data);
	}
    
}

/* End of file theme.php */