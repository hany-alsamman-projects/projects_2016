<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2013, CODEX.COM. All Rights Reserved.                    |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER CODEX.COM TEAM (PRIVETE ACCESS ONLY)		|
'---------------------------------------------------------------------------'
*/

/**
 * USERCP.php
 *
 * @package WIX
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 �
 * @access TEAM
 */

class API extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;


    /**
     * USERCP::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        global $INFO;
		
		$this->ACTION = $_GET['action'];
        
        $this->cofings = $INFO;
        
		$this->smarty = $smarty;

     }


    function isValidMd5($md5 ='')
    {
        return   preg_match('/^[a-f0-9]{32}$/', $md5);
    }


    /**
     * USERCP::USERCP_PROCESS()
     * 
     * @return
     */
    public function EXPORT_PROCESS(){


        $result = mysql_query("SELECT d_name_en FROM `departments` WHERE `d_type` = 'city' and `d_active` = '1'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);


        // The names of the root node and the node that will contain a row
        $root_element = "response";
        $row_element = "city";

        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));

        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {

            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element));

            // Loop the columns
            foreach ($row as $col => $val) {

                if($col == 'd_name_en'){
                    $col = 'city_name';
                }

                // if($col != 'd_name_ar' and $col != 'd_type' and $col != 'id' && $col != 'd_active'){
                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));
                //}

            }

        }

        // Output as string
        echo $dom->saveXML();
        
    }

    /**
     * USERCP::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}