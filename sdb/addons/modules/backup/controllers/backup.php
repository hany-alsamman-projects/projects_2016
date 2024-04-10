<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	Controllers for public
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class backup extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('testmodule_m');                
    }
        
    public function index()
    {
        $this->template
        ->title($this->module_details['name'])
        ->build('index');
    }
}
