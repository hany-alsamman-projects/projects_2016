<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package 		MizuCMS
 * @subpackage 		Login Widget
 * @author			Hany alsamman - MizuCMS Development Team
 * 
 * Show RSS feeds in your site
 */

class Widget_Login extends Widgets
{
	public $title		= 'Login';
	public $description	= array(
		'en' => 'Display a simple login form anywhere',
		'pt' => 'Permite colocar um formulário de login em qualquer lugar do seu site'
	);
	public $author		= 'Hany alsamman';
	public $website		= 'http://philsturgeon.co.uk/';
	public $version		= '1.0';

	public function run()
	{
		return !$this->ion_auth->logged_in();
	}
}