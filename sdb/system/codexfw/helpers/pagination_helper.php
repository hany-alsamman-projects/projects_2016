<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function create_codex_pagination($uri, $total_rows, $limit = NULL, $uri_segment = 4)
{
	$ci =& get_instance();
	$ci->load->library('pagination');

	$current_page = $ci->uri->segment($uri_segment, 0);

	// Initialize pagination
	$config['suffix']				= $ci->config->item('url_suffix');
	$config['base_url']				= $config['suffix'] !== FALSE ? rtrim(site_url($uri), $config['suffix']) : site_url($uri);
	$config['total_rows']			= $total_rows; // count all records
	$config['per_page']				= $limit === NULL ? 1: $limit;
	$config['uri_segment']			= $uri_segment;
	$config['page_query_string']	= FALSE;

	$config['num_links'] = 4;

	$config['full_tag_open'] = '';
	$config['full_tag_close'] = '';

	$config['first_link'] = '&lt;&lt;';
	$config['first_tag_open'] = '<li><span title="First"><b>';
	$config['first_tag_close'] = '</b></span></li>';

	$config['prev_link'] = '<img src="system/codexfw/assets/img/admin/icons/fugue/navigation-180.png" width="16" height="16"> Prev';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';

	$config['cur_tag_open'] = '<li><a href="#" class="current"><b>';
	$config['cur_tag_close'] = '</b></a></li>';

	$config['num_tag_open'] = '<li><b>';
	$config['num_tag_close'] = '</b></li>';

	$config['next_link'] = 'Next <img src="system/codexfw/assets/img/admin/icons/fugue/navigation.png" width="16" height="16">';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';

	$config['last_link'] = '&gt;&gt;';
	$config['last_tag_open'] = '<li><span class="last">';
	$config['last_tag_close'] = '</span></li>';

	$ci->pagination->initialize($config); // initialize pagination

	return array(
		'current_page' 	=> $current_page,
		'per_page' 		=> $config['per_page'],
		'limit'			=> array($config['per_page'], $current_page),
		'links' 		=> $ci->pagination->create_links()
	);
}


function create_codex_pagination2($uri, $total_rows, $limit = NULL, $uri_segment = 4)
{
	$ci =& get_instance();
	$ci->load->library('pagination');

	$current_page = $ci->uri->segment($uri_segment, 0);

	// Initialize pagination
    $config['suffix'] = $ci->config->item('url_suffix');
    $config['base_url'] = $config['suffix'] !== FALSE ? rtrim(site_url($uri), $config['suffix']) : site_url($uri);
    $config['total_rows'] = $total_rows; // count all records
    $config['per_page'] = $limit === NULL ? $ci->settings->records_per_page : $limit;
    $config['uri_segment'] = $uri_segment;
    $config['page_query_string'] = FALSE;

	$config['num_links'] = 4;

	$config['full_tag_open'] = '';
	$config['full_tag_close'] = '';

	$config['first_link'] = '&lt;&lt;';
	$config['first_tag_open'] = '<li><span title="First"><b>';
	$config['first_tag_close'] = '</b></span></li>';

	$config['prev_link'] = '<img src="system/codexfw/assets/img/admin/icons/fugue/navigation-180.png" width="16" height="16"> Prev';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';

	$config['cur_tag_open'] = '<li><a href="#" class="current"><b>';
	$config['cur_tag_close'] = '</b></a></li>';

	$config['num_tag_open'] = '<li><b>';
	$config['num_tag_close'] = '</b></li>';

	$config['next_link'] = 'Next <img src="system/codexfw/assets/img/admin/icons/fugue/navigation.png" width="16" height="16">';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';

	$config['last_link'] = '&gt;&gt;';
	$config['last_tag_open'] = '<li><span class="last">';
	$config['last_tag_close'] = '</span></li>';

	$ci->pagination->initialize($config); // initialize pagination

	return array(
		'current_page' 	=> $current_page,
		'per_page' 		=> $config['per_page'],
		'limit'			=> array($config['per_page'], $current_page),
		'links' 		=> $ci->pagination->create_links()
	);
}


/**
  * The Pagination helper cuts out some of the bumf of normal pagination
  * @author		Philip Sturgeon
  * @filename	pagination_helper.php
  * @title		Pagination Helper
  * @version	1.0
 **/

function create_pagination($uri, $total_rows, $limit = NULL, $uri_segment = 4)
{
	$ci =& get_instance();
	$ci->load->library('pagination');

	$current_page = $ci->uri->segment($uri_segment, 0);

	// Initialize pagination
	$config['base_url']				= site_url($uri);
	$config['total_rows']			= $total_rows; // count all records
	$config['per_page']				= $limit === NULL ? $ci->settings->records_per_page : $limit;
	$config['uri_segment']			= $uri_segment;
	$config['page_query_string']	= FALSE;

	$config['num_links'] = 4;

	$config['full_tag_open'] = '<p class="pagination">';
	$config['full_tag_close'] = '</p>';

	$config['first_link'] = '&lt;&lt;';
	$config['first_tag_open'] = '<span class="first">';
	$config['first_tag_close'] = '</span>';

	$config['prev_link'] = '<img src="system/codexfw/assets/img/admin/icons/fugue/navigation-180.png" width="16" height="16">';
	$config['prev_tag_open'] = '<span class="prev">';
	$config['prev_tag_close'] = '</span>';

	$config['cur_tag_open'] = '<span class="current">';
	$config['cur_tag_close'] = '</span>';

	$config['num_tag_open'] = '<span>';
	$config['num_tag_close'] = '</span>';

	$config['next_link'] = '<img src="system/codexfw/assets/img/admin/icons/fugue/navigation.png" width="16" height="16">';
	$config['next_tag_open'] = '<span class="next">';
	$config['next_tag_close'] = '</span>';

	$config['last_link'] = '&gt;&gt;';
	$config['last_tag_open'] = '<span class="last">';
	$config['last_tag_close'] = '</span>';

	$ci->pagination->initialize($config); // initialize pagination

	return array(
		'current_page' 	=> $current_page,
		'per_page' 		=> $config['per_page'],
		'limit'			=> array($config['per_page'], $current_page),
		'links' 		=> $ci->pagination->create_links()
	);
}