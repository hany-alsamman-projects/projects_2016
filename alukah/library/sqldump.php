<?php

//$link = mysql_connect('localhost', 'root', '123');
//        mysql_select_db('namaa', $link);
//        
//if (!$link) {
//    die('Could not connect: ' . mysql_error());
//}

require_once ('../sources/configs.php'); //configs
require_once ('../sources/profiler.php'); //configs

class SQLDUMP extends CORE{
	
	var $cached_tables	= array();
	var $str_gzip_header = "\x1f\x8b\x08\x00\x00\x00\x00\x00";

    public function __construct()
    {
    	$link = parent::connection(); //create new connection
    	$query_ids = mysql_query($the_query, $link);
    }
    
    function get_table_names()
    {
	    if( is_array($this->cached_tables) AND count($this->cached_tables) )
	    {
		    return $this->cached_tables;
	    }
	    
		$result     = mysql_list_tables($this->DB_NAME);
		$num_tables = @mysql_numrows($result);
		for ($i = 0; $i < $num_tables; $i++)
		{
			$this->cached_tables[] = mysql_tablename($result, $i);
		}
		
		return $this->cached_tables;
   	}
   	
   	
    function fetch_row($query_id = "")
    {
    	if ($query_id == "")
    	{
    		$query_id = $query_ids;
    	}
    	
        $record_row = mysql_fetch_array($query_id, MYSQL_ASSOC);
        
        return $record_row;
    }
    
    function gzip_four_chars($val)
	{
		for ($i = 0; $i < 4; $i ++)
		{
			$return .= chr($val % 256);
			$val     = floor($val / 256);
		}
		
		return $return;
	} 
    
	//-----------------------------------------
	// sql_strip_ticks from field names
	//-----------------------------------------
	
	function sql_strip_ticks($data)
	{
		return str_replace( "`", "", $data );
	}
	
	function query($the_query){
		global $link;
		return mysql_query($the_query, $link);
	}
	
	/*-------------------------------------------------------------------------*/
    // Return an array of fields
    /*-------------------------------------------------------------------------*/
    
    function get_result_fields($query_id="")
    {
    	if ( ! $query_id )
   		{
    		$query_id = $query_ids;
    	}
    	
		while ($field = mysql_fetch_field($query_id))
		{
            $Fields[] = $field;
		}
		
		return $Fields;
   	}
   	
    /*-------------------------------------------------------------------------*/
    // Fetch the number of rows in a result set
    /*-------------------------------------------------------------------------*/
    
    function get_num_rows( $query_id="" )
    {    	
    	if ( ! $query_id )
   		{
    		$query_id = $query_ids;
    	}
    	
        return mysql_num_rows($query_id);
    }
    
	//-----------------------------------------
	// Add slashes to single quotes to stop sql breaks
	//-----------------------------------------
	
	function sql_add_slashes($data)
	{
		$data = str_replace('\\', '\\\\', $data);
        $data = str_replace('\'', '\\\'', $data);
        $data = str_replace("\r", '\r'  , $data);
        $data = str_replace("\n", '\n'  , $data);
        
        return $data;
	}
    
	//-----------------------------------------
	// Internal handler to return content from table
	//-----------------------------------------
	
	function get_table_sql($tbl, $create_tbl, $skip=0, $get_data=0)
	{
		
		if ($create_tbl)
		{
			
			$q =  mysql_query("SHOW CREATE TABLE `$tbl`");
			
			$ctable = mysql_fetch_array($q); //////
			
			//echo sql_strip_ticks($ctable['Create Table']).";\n";

			echo $ctable['Create Table'].";\n";
		}
		
		// Are we skipping? Woohoo, where's me rope?!
		
		if ($skip == 1)
		{
			if ($tbl == 'additional_pages' and $tbl == 'announcements' and $tbl == 'global' and $tbl == 'members' and $tbl == 'subscribe')
			{
				return false;
			}
		}
		
		// Get the data
		if ($get_data == 1)
		{
		
		$my_data = mysql_query("SELECT * FROM `$tbl`");
		
		// Check to make sure rows are in this
		// table, if not return.
		
		$row_count = $this->get_num_rows($my_data);
		
		if ($row_count < 1)
		{
			return TRUE;
		}
		
		//-----------------------------------------
		// Get col names
		//-----------------------------------------
		
		$f_list = "";
	
		$fields = $this->get_result_fields($my_data);
		
		$cnt = count($fields);
		
		for( $i = 0; $i < $cnt; $i++ )
		{
			$f_list .= '`'.$fields[$i]->name.'`'. ", ";
		}
		
		$f_list = preg_replace( "/, $/", "", $f_list );
		
		while ( $row = $this->fetch_row($my_data) )
		{
			//-----------------------------------------
			// Get col data
			//-----------------------------------------
			
			$d_list = "";
			
			for( $i = 0; $i < $cnt; $i++ )
			{
				if ( ! isset($row[ $fields[$i]->name ]) )
				{
					$d_list .= "NULL,";
				}
				elseif ( $row[ $fields[$i]->name ] != '' )
				{
					$d_list .= "'".$this->sql_add_slashes($row[ $fields[$i]->name ]). "',";
				}
				else
				{
					$d_list .= "'',";
				}
			}
			
			$d_list = preg_replace( "/,$/", "", $d_list );
			
			echo "INSERT INTO `$tbl` ($f_list) VALUES($d_list);\n";
		}
		
		}
		
		return TRUE;
		
	}
   	
   	
	function do_safe_backup($filename)
	{
		
		//global $str_gzip_header;
		
			// Auto all tables
			$skip        = 0;
			$create_tbl  = $_POST['structure'];
			$enable_gzip = $_POST['compress'];
			$get_data = $_POST['complete'];
		
		$output = "";
		
		@header("Pragma: no-cache");
		
		$do_gzip = 0;
		
		if( $enable_gzip )
		{
			$phpver = phpversion();

			if($phpver >= "4.0")
			{
				if(extension_loaded("zlib"))
				{
					$do_gzip = 1;
				}
			}
		}
		
		if( $do_gzip != 0 )
		{
			@ob_start();
			@ob_implicit_flush(0);
			header("Content-Type: text/x-delimtext; name=\"$filename.sql.gz\"");
			header("Content-disposition: attachment; filename=$filename.sql.gz");
		}
		else
		{
			header("Content-Type: text/x-delimtext; name=\"$filename.sql\"");
			header("Content-disposition: attachment; filename=$filename.sql");
		}
		
		//-----------------------------------------
		// Get tables to work on
		//-----------------------------------------
		
		print '-- CODEXC.COM SQL Dump'."\n";
		print '-- version 1.0.1'."\n";
		print '-- http://www.CODEXC.COM'."\n\n";
		
		echo 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";'."\n\n";
		
		//header('Content-type: text/html; charset=UTF-8');
		
		if ($tbl_name == "")
		{
			$tmp_tbl = $this->get_table_names();
				
			foreach($tmp_tbl as $tbl)
			{

				if ($tbl)
				{
					// We've started our headers, so print as we go to stop
					// poss memory problems
					
					print '-- Table structure for table `'.$tbl.'`'."\n\n";
					
					$this->get_table_sql($tbl, $create_tbl, $skip, $get_data);
					
					print '-- --------------------------------------------------------'."\n\n";
				}
			}
		}
		else
		{
			$this->get_table_sql($tbl_name, $create_tbl, $skip, $get_data);
		}
		
		//$txtcontents = ob_get_contents();
		
		//file_put_contents('hany.sql',$txtcontents);
		
		//-----------------------------------------
		// GZIP?
		//-----------------------------------------
		
		if($do_gzip)
		{
			$size     = ob_get_length();
			$crc      = crc32(ob_get_contents());
			$contents = gzcompress(ob_get_contents());
			ob_end_clean();
			echo $this->str_gzip_header
				.substr($contents, 0, strlen($contents) - 4)
				.$this->gzip_four_chars($crc)
				.$this->gzip_four_chars($size);
		}
		
		exit();
	}
	
}
@session_start();

if(session_is_registered("admin")){
	
	$DUMP = new SQLDUMP();
	
	$DUMP->do_safe_backup('backup');	
	
}else{
	
print 'out ya rabit :)';

}
?>