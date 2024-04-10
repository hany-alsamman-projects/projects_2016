<?php
class SETTINGS {
	function rebuild_config( $new = "" )
	{
		//-----------------------------------------
		// Check to make sure this is a valid array
		//-----------------------------------------
		if (! is_array($new) )
		{
			//Error whilst attempting to rebuild the board config file, attempt aborted
		}
		//-----------------------------------------
		// Do we have anything to save out?
		//-----------------------------------------
		if ( count($new) < 1 )
		{
			return "";
		}
		//-----------------------------------------
		// Get an up to date copy of the config file
		// (Imports $INFO)
		//-----------------------------------------
		require SITE_PATH.'/sources/configs.php';
		//-----------------------------------------
		// Rebuild the $INFO hash
		//-----------------------------------------
		foreach( $new as $k => $v )
		{
			// Update the old...
			$v = preg_replace( "/'/", "\\'" , $v );
			$v = preg_replace( "/\r/", ""   , $v );
			$INFO[ $k ] = $v;
		}
		//-----------------------------------------
		// Rename the old config file
		//-----------------------------------------
		@rename( SITE_PATH.'/sources/configs.php', SITE_PATH.'/sources/configs-bak.php' );
		@chmod( SITE_PATH.'/sources/configs-bak.php', 0777);
		//-----------------------------------------
		// Rebuild the old file
		//-----------------------------------------
		ksort($INFO);
		$file_string = "<?php\n";
		foreach( $INFO as $k => $v )
		{
			if ($k == 'skin' or $k == 'languages')
			{
				// Protect serailized arrays..
				$v = stripslashes($v);
				$v = addslashes($v);
			}
			$file_string .= '$INFO['."'".$k."'".']'."\t\t\t=\t'".$v."';\n";
		}
		$file_string .= "\n".'?'.'>';   // Question mark + greater than together break syntax hi-lighting in BBEdit 6 :p
		if ( $fh = fopen( SITE_PATH.'/sources/configs.php', 'w' ) )
		{
			fwrite($fh, $file_string, strlen($file_string) );
			fclose($fh);
		}
		else
		{
			//Fatal Error: Could not open conf_global for writing - no changes applied. Try changing the CHMOD to 0777
		}
	}
	function save_config( $new )
	{
		$master = array();
		if ( is_array($new) )
		{
			if ( count($new) > 0 )
			{
				foreach( $new as $k => $v )
				{
					// Handle special..
					if ($field == 'img_ext' or $field == 'avatar_ext' or $field == 'photo_ext')
					{
						$_POST[ $k ] = preg_replace( "/[\.\s]/", "" , $_POST[ $k ] );
						$_POST[ $k ] = str_replace('|', "&#124;", $_POST[ $k ]);
						$_POST[ $k ] = preg_replace( "/,/"     , '|', $_POST[ $k ] );
					}
					else if ($k == 'SITE_NAMEssss')
					{
						$_POST[ $k ] = str_replace("Namaa", "hany", $_POST[ $k ]);
					}
					if ( $k == 'SITE_DIR' OR $k == 'SITE_PATH')
					{
						$_POST[ $k ] = str_replace( "'", "&#39;", $_POST[ $k ] );
					}
					else
					{
						$_POST[ $k ] = str_replace( "'", "&#39;", stripslashes($_POST[ $k ]) );
					}
					$master[ $k ] = stripslashes($_POST[ $k ]);
				}
				SETTINGS::rebuild_config($master);
			}
		}
		//message
	}
}
?>