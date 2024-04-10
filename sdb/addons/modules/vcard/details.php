<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_vcard extends Module {

	public $version = '0.1';

	public function info()
	{
		return array(
			'name' => array(
				'sl' => 'vCard',
				'en' => 'vCard',
				'de' => 'vCard',
				'nl' => 'vCard',
				'fr' => 'vCard',
				'zh' => 'vCard',
				'it' => 'vCard',
				'ru' => 'vCard',
				'ar' => 'يطاقة عمل',
				'pt' => 'vCard',
				'cs' => 'vCard',
				'es' => 'vCard',
				'fi' => 'vCard',
				'lt' => 'vCard'
			),
			'description' => array(
				'sl' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'en' => 'The vcard module is a powerful module that lets users create advanced business card .',
				'de' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'nl' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'fr' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'zh' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'it' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'ru' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'ar' => 'صيغة بطاقة تسمح للمستخدمين اضافة بطاقات عمل احترافية ومتقدمة',
				'pt' => 'The vcard module is a powerful module that lets users create advanced business card ',
			    'cs' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'es' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'fi' => 'The vcard module is a powerful module that lets users create advanced business card ',
				'lt' => 'The vcard module is a powerful module that lets users create advanced business card '
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{

		
		$table_vcard = "
                CREATE TABLE IF NOT EXISTS `vcard` (
                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL,
                  `picture` varchar(125) NOT NULL DEFAULT 'nopic.jpg',
                  `description` varchar(255) NOT NULL,
                  `added_by` int(11) DEFAULT NULL,
                  `members` text,
                  `date` int(11) DEFAULT NULL,
                  `last_update` int(11) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `added_by` (`added_by`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		";

		$table_cast = "
                CREATE TABLE IF NOT EXISTS `vcard_cast` (
                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` int(11) unsigned NOT NULL,
                  `vid` int(11) unsigned NOT NULL,
                  `gid` int(11) unsigned NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `vid` (`vid`,`gid`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		";
        
        
        if($this->db->query($table_vcard) && $this->db->query($table_cast))
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
		<p>The vcard module is a advnaced business card management tool. Features include create, edit and delete.</p>";
	}
}
/* End of file details.php */
