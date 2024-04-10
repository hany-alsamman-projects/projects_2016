<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * vcard helpers
 *
 * @package		PyroCMS
 * @subpackage	Comments Module
 * @category	Helper
 * @author		Hany alsamman - CodexFW Dev Team
 */

/**
 * Function to display a cast stars
 *
 * @param	int		$ref_id		The ID of the comment (I guess?)
 * @param	bool	$reference	Whether to use a reference or not (?)
 * @return	void
 */
function display_cast($vid, $gid)
{
    
	$ci =& get_instance();

	$ci->load->model('vcard/vcard_m');

	$data = $ci->vcard_m->get_cast_by_id($vid, $gid);
    
    print_r($data);


	$ci->load->view('vcard/cast_stars', $data);
}