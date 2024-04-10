<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Wall Module Plugin
 *
 *
 * @package		CodexFW
 * @author		Hany alsamman - Codex FrameWork Dev Team
 * @copyright	Copyright (c)2011
 *
 */
class Plugin_wall extends Plugin
{
	/**
	 * Entries
	 *
	 * Displays a selected number of testimonial entries as list items <li>
	 *
	 * Usage:
	 * {pyro:wall:entries uid="" limit="5"}
	 *
	 * @param	array
	 * @return	array
	 */
	function entries()
	{

        $this->load->model('wall/wall_m');

        $this->load->model('users/users_m');

        $this->load->helper('wall/wall');
		//$this->config->load('wall/wall_config');

		$limit = $this->attribute('limit');

        $uid = $this->attribute('uid');

		// No limit? Get default setting from config/wall_config.php
//		if ($limit === NULL)
//		{
//			$limit = $this->config->item('default_num_entries');
//		}


        if ( $this->uri->segment(3) == 'index' || $this->uri->segment(1) == 'my-profile' ) {

            $user = $this->user;

        }else{

            $username = $this->uri->segment(4);
            if(is_numeric($username)) $id = array('id'=>$username); else $id = array('username'=>$username);
            $user = $this->users_m->get($id);

        }
                		
		$data['Updates'] = $this->wall_m->Updates($user->id, $limit);

        $data['user_data'] = $user;

		return $this->module_view('wall', 'load_messages', $data);
	}
}