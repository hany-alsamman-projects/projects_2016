<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_conjuction extends Theme {

    public $name			= 'Codex SDB';
    public $author			= 'Hany alsamman';
    public $author_website	= 'http://codexc.com/';
    public $website			= 'http://codexc.com/';
    public $description		= 'Default SDB v1.0 Theme CSS3 styling.';
    public $version			= '1.0';

	public function __construct()
	{
		$supported_lang	= Settings::get('supported_languages');

		$cufon_enabled	= $supported_lang[CURRENT_LANGUAGE]['direction'] !== 'rtl';
		$cufon_font		= 'qk.font.js';

		// Translators, only if the default font is incompatible with the chars of your 
		// language generate a new font (link: <http://cufon.shoqolate.com/generate/>) and add
		// your case in switch bellow. Important: use a licensed font and harmonic with design

		switch (CURRENT_LANGUAGE)
		{
			case 'zh':
				$cufon_enabled	= FALSE;
				break;
			case 'ar':
			case 'he':
				$cufon_enabled	= TRUE;
			case 'ru':
				$cufon_font		= 'times.font.js';
				break;
		}

		Settings::set('theme_default', compact('cufon_enabled', 'cufon_font'));
	}
}

/* End of file theme.php */