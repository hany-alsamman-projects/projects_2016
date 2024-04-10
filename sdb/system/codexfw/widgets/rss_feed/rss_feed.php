<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package 		PyroCMS
 * @subpackage 		RSS Feed Widget
 * @author			Hany alsamman - PyroCMS Development Team
 *
 * Show RSS feeds in your site
 */
class Widget_Rss_feed extends Widgets {

	public $title = array(
		'en' => 'RSS Feed',
		'pt' => 'Feed RSS'
	);
	public $description = array(
		'en' => 'Display parsed RSS feeds on your websites',
		'pt' => 'Interpreta e exibe qualquer feed RSS no seu site'
	);
	public $author	= 'Hany alsamman';
	public $website	= 'http://philsturgeon.co.uk/';
	public $version	= '1.2';
	public $fields	= array(
		array(
			'field' => 'feed_url',
			'label' => 'Feed URL',
			'rules' => 'prep_url|required'
		),
		array(
			'field' => 'number',
			'label' => 'Number of items',
			'rules' => 'numeric'
		)
	);

	public function run($options)
	{
		$this->load->library('simplepie');
		$this->simplepie->set_cache_location($this->config->item('simplepie_cache_dir'));
		$this->simplepie->set_feed_url($options['feed_url']);
		$this->simplepie->init();

		empty($options['number']) AND $options['number'] = 5;

		// Store the feed items
		return array(
			'rss_items' => $this->simplepie->get_items(0, $options['number'])
		);
	}

	public function save($options)
	{
		return $options;
	}

}