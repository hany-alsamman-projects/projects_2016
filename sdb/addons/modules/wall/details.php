<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Wall extends Module {

	public $version = '0.1';

	public function info()
	{
		return array(
			'name' => array(
				'sl' => 'Wall',
				'en' => 'Wall',
				'de' => 'Wall',
				'nl' => 'Wall',
				'fr' => 'Wall',
				'zh' => 'Wall',
				'it' => 'Wall',
				'ru' => 'Wall',
				'ar' => 'الحائط',
				'pt' => 'Wall',
				'cs' => 'Wall',
				'es' => 'Wall',
				'fi' => 'Wall',
				'lt' => 'Wall'
			),
			'description' => array(
				'sl' => 'The wall module to add status and comments options into profile page',
				'en' => 'The wall module to add status and comments options into profile page',
				'de' => 'The wall module to add status and comments options into profile page',
				'nl' => 'The wall module to add status and comments options into profile page',
				'fr' => 'The wall module to add status and comments options into profile page',
				'zh' => 'The wall module to add status and comments options into profile page',
				'it' => 'The wall module to add status and comments options into profile page',
				'ru' => 'The wall module to add status and comments options into profile page',
				'ar' => 'برمجية الحائط , من اجل إضافة الحالة والتعليقات ضمن صفحة البروفايل',
				'pt' => 'The wall module to add status and comments options into profile page',
			    'cs' => 'The wall module to add status and comments options into profile page',
				'es' => 'The wall module to add status and comments options into profile page',
				'fi' => 'The wall module to add status and comments options into profile page',
				'lt' => 'The wall module to add status and comments options into profile page'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{

		
		$table_Wall = "
            CREATE TABLE IF NOT EXISTS `wall_comments` (
              `com_id` int(11) NOT NULL AUTO_INCREMENT,
              `comment` varchar(200) DEFAULT NULL,
              `msg_id_fk` int(11) DEFAULT NULL,
              `uid_fk` int(11) DEFAULT NULL,
              `ip` varchar(30) DEFAULT NULL,
              `created` int(11) DEFAULT '1269249260',
              PRIMARY KEY (`com_id`),
              KEY `msg_id_fk` (`msg_id_fk`),
              KEY `uid_fk` (`uid_fk`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8
		";

		$table_cast = "
            CREATE TABLE IF NOT EXISTS `wall_messages` (
              `msg_id` int(11) NOT NULL AUTO_INCREMENT,
              `message` varchar(200) DEFAULT NULL,
              `uid_fk` int(11) DEFAULT NULL,
              `ip` varchar(30) DEFAULT NULL,
              `created` int(11) DEFAULT '1269249260',
              PRIMARY KEY (`msg_id`),
              KEY `uid_fk` (`uid_fk`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8
		";
        
        
        if($this->db->query($table_Wall) && $this->db->query($table_cast))
		{
			return TRUE;
		}

	}

	public function uninstall()
	{
        return false;

	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "<h4>Overview</h4>
		<p>The wall module to add status and comments options into profile page. Features include status, comments and more.</p>";
	}
}
/* End of file details.php */
