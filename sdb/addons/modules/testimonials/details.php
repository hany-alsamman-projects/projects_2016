<?php defined('BASEPATH') or exit('No direct script access');

class Module_testimonials extends Module {

	public $version = '0.1b';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'testimonials',
				'fr' => 'Témoignages'
			),
			'description' => array(
				'en' => 'Create, edit and display customer testimonials on your PyroCMS site!',
				'fr' => 'Créer, modifier et afficher des témoignages de clients sur votre site PyroCMS!'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}
	
	public function install()
	{
		// Create testimonials Table
		$this->dbforge->drop_table('wf_testimonials');
		$testimonials = "
			CREATE TABLE `wf_testimonials` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(50) NOT NULL,
			  `location` varchar(100) NOT NULL,
			  `comment` text,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";
		
		if($this->db->query($testimonials))
		{
			return TRUE;
		}
	}
	
	public function uninstall()
	{
		$this->dbforge->drop_table('wf_testimonials');
		return TRUE;
	}

	public function upgrade($old_version)
	{
		return TRUE;
	}
	
	public function help()
	{
		return "No documentation is currently available for the testimonials module - contact <a href='http://winkingfrog.com'>Winking Frog Studios</a>!";
	}

}