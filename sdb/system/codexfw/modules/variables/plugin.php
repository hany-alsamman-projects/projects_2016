<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Variable Plugin
 *
 * Allows tags to be used in content items.
 *
 * @package		CodexFW
 * @author		Codex Corp "Experts" Dev Team
 * @copyright	Copyright (c) 2008 - 2011, CodexFW
 *
 */
class Plugin_Variables extends Plugin
{
	/**
	 * Load a variable
	 *
	 * Magic method to get the variable.
	 *
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function __call($name, $data)
	{
		$this->load->library('variables/variables');
		return $this->variables->$name;
	}
}

/* End of file plugin.php */