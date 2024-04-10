<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Testimonal Module Plugin
 *
 * Retrieve testimonial data for frontend display/usage
 *
 * @package		CodexFW
 * @author		Gordon Naldrett - Winking Frog Studios / Moray Web Solutions
 * @copyright	Copyright (c)2010, Moray Web Solutions
 *
 */
class Plugin_testimonials extends Plugin
{
	/**
	 * Entries
	 *
	 * Displays a selected number of testimonial entries as list items <li>
	 *
	 * Usage:
	 * {pyro:testimonials:entries limit="5"}
	 *
	 * @param	array
	 * @return	array
	 */
	function entries()
	{
		$this->load->model('testimonials/testimonials_m');
		$this->config->load('testimonials/testimonials_config');
		
		$limit = $this->attribute('limit');

		// No limit? Get default setting from config/testimonials_config.php
		if ($limit === NULL)
		{
			$limit = $this->config->item('default_num_entries');
		}
		
		$results = $this->testimonials_m->get_all($limit);
		$testimonials = "";
		
		if ($results)
		{
			foreach ($results as $result)
			{
				$testimonials .= "<div class='testimonial_entry'>\n
									<p class='testimonial_comment'>".$result['comment']."</p>\n
									<p class='testimonial_name'>".$result['name']."</p>\n
									<p class='testimonial_location'>".$result['location']."</p>\n
								</div>\n";
			}
			return $testimonials;
		} else {
			return $this->lang->line('testimonials_plugin_entries_error');
		}		
	}
}