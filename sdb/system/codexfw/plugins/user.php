<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Session Plugin
 *
 * Read and write session data
 *
 * @package		PyroCMS
 * @author		CodexFW Dev Team
 * @copyright	Copyright (c) 2008 - 2011, PyroCMS
 *
 */
class Plugin_User extends Plugin
{
    
	/**
	 * Data
	 *
	 * Loads a theme partial
	 *
	 * Usage:
	 * {pyro:user:profile_picture image="admin"}
	 *	<p>Hello admin!</p>
	 * {/pyro:user:profile_picture}
	 *
	 * @param	array
	 * @return	array
	 */
 	function profile_picture()
	{
//		$image = $this->attribute('image', NULL);
//
//		$this->load->library('Face_Detector');
//        
//        $detector = new Face_Detector();
//        $detector->face_detect($_SERVER["DOCUMENT_ROOT"].'/testcms/uploads/files/'.$image);
//        $detector->toJpeg();
	}
    
	/**
	 * Data
	 *
	 * Loads a theme partial
	 *
	 * Usage:
	 * {pyro:user:logged_in group="admin"}
	 *	<p>Hello admin!</p>
	 * {/pyro:user:logged_in}
	 *
	 * @param	array
	 * @return	array
	 */
	function logged_in()
	{
		$group = $this->attribute('group', NULL);

		if ($this->user)
		{
			if ($group AND $group !== $this->user->group)
			{
				return '';
			}

			return $this->content() ? $this->content() : TRUE;
		}

		return '';
	}

	/**
	 * Data
	 *
	 * Loads a theme partial
	 *
	 * Usage:
	 * {pyro:user:not_logged_in group="admin"}
	 *	<p>Hello not an admin</p>
	 * {/pyro:user:not_logged_in}
	 *
	 * @param	array
	 * @return	array
	 */
	function not_logged_in()
	{
		$group = $this->attribute('group', NULL);

		// Logged out or not the right user
		if ( ! $this->user OR ($group AND $group !== $this->user->group))
		{
			return $this->content();
		}

		return '';
	}

	function has_cp_permissions()
	{
		if ($this->user)
		{
			if ( ! (($this->user->group == 'admin') OR $this->permission_m->get_group($this->user->group_id)))
			{
				return '';
			}

			return $this->content() ? $this->content() : TRUE;
		}

		return '';
	}

	function __call($foo, $arguments)
	{
		return isset($this->user->$foo) ? $this->user->$foo : NULL;
	}
}

/* End of file theme.php */