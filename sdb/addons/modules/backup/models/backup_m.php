<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	Test Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class backup_m extends MY_Model {

	public function __construct()
	{
		 parent::__construct();
         
	}

    
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{	   
                
		$backup_config = $this->config->item('backup');
		
		$backup_dir = $backup_config['db_backup_path'];
        
        $this->load->helper('array');
		$this->load->helper('file');      
        
		$backup_dir_info = get_dir_file_info($backup_dir);
		
		$vars = array();
        

		if (!empty($backup_dir_info))
		{
			$sorted_backup_dir_info = each(array_sorter($backup_dir_info, 'date','desc'));
			
			$sorted_backup_dir_info = array_sorter($backup_dir_info, 'date','desc');
			foreach($sorted_backup_dir_info as $path => $val)
			{
				$ext = strtolower(end(explode('.', $val['name'])));
				if ($ext == 'sql' || $ext = 'zip')
				{
					$last_backup_date = date("m/d/Y h:ia", $val['date']);
					$vars['last_backup_date'] = $last_backup_date;
					
				}
			}
		}      
      
      	return $vars;
            
	}

}