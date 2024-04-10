<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Array sorter that will sort on an array's key and allows for asc/desc order
 *
 * @access	public
 * @param	array
 * @param	string
 * @param	string
 * @param	boolean
 * @param	boolean
 * @return	array
 */


/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	Controllers for Admin
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller
{

	/**
	 * Constructor method
	 *
	 * @author Hany alsamman - Codex FrameWork Dev Team
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
  
        
                
	}

    function assets_server_path($file = NULL, $path = NULL, $module = NULL)
    {
    	$CI = _get_assets();
    	return $CI->asset->assets_server_path($file, $path, $module);
    }

	/**
	 * 
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
	        

        $this->lang->load('backup');        
        $this->load->config('backup');
		
        $this->load->helper('array');
		$this->load->helper('file');
        
		$backup_config = $this->config->item('backup');
		$download_path = $backup_config['db_backup_path'];
        
		$is_writable = is_writable($download_path);
    		if ($post = $this->input->post('action'))
    		{
    			// Load the DB utility class
    			$this->load->dbutil();
    			
    			// Backup your entire database and assign it to a variable
    			//$config = array('newline' => "\r", 'format' => 'zip');
    			
    			// need to do text here to make some fixes
    			$db_back_prefs = $backup_config['db_backup_prefs'];
    			$db_back_prefs['format'] = 'txt';
    			$backup =& $this->dbutil->backup($db_back_prefs); 
    			
    			//fixes to work with PHPMYAdmin
    			$backup = str_replace('\\\t', "\t",	$backup);
    			$backup = str_replace('\\\n', '\n', $backup);
    			$backup = str_replace("\\'", "''", $backup);
    			$backup = str_replace('\\\\', '', $backup);
    			
    			// load the file helper and write the file to your server
    			$this->load->helper('file');
    			$this->load->library('zip');
    			
    			if ($backup_config['backup_file_prefix'] == 'AUTO')
    			{
    				$this->load->helper('url');
    				$backup_config['backup_file_prefix'] = url_title($this->config->item('site_name', FUEL_FOLDER), '_', TRUE);
    			}
    			
    			$filename = $backup_config['backup_file_prefix'].'_'.date('Y-m-d');
    			$this->zip->add_data($filename.'.sql', $backup);
    
    			// include assets folder
    			if (!empty($_POST['include_assets']))
    			{
    				$this->zip->read_dir($this->assets_server_path());
    			}
    
    			// write the zip file to a folder on your server. 
    			$this->zip->archive($download_path.$filename.'.zip'); 
    
    			// download the file to your desktop. 
    			$this->zip->download($filename.'.zip');
    			
    			$msg = lang('data_backup');
    			$this->logs_model->logit($msg);
    		}
    		else 
    		{
    			$vars['download_path'] = $download_path;
    			$vars['is_writable'] = $is_writable;
    			$vars['backup_assets'] = $backup_config['backup_assets'];

                $this->template->title('test')->build('admin/backup', $vars);
                
                
                
    		}
	}

}