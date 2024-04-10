<?php

/**
 * api.php
 *
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @pattern private
 * @access TEAM
 */

class API extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;
	var $cofings;


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


    public function GET_BOOKS(){

        ## account "ID"
        $type_app = trim($_REQUEST['type_app']);

        $extra_tags = trim($_REQUEST['extra_tags']);

        if($extra_tags == true) $extra_tags = ', `book_price`'; else $extra_tags = false;

        $result = @mysql_query("SELECT id as `book_number`, `book_summary` , `store_id`, book_name,book_image, book_extra AS book_dl, `book_dir` as book_direction, `publish_date`, `sort_id` $extra_tags FROM `books` WHERE `parent` = '0' and `book_type` = '{$type_app}'  ORDER BY sort_id ASC");

        if( !mysql_num_rows($result) ){
            FUNCTIONS::xml_msg('0');
            exit();
        }

        // The names of the root node and the node that will contain a row
        $root_element = "response";


        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {
            $row_element_s1 = "books";
            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));
            // Loop the columns
            foreach ($row as $col => $val) {

                if($col == 'book_direction'){
                    if($val == 1){
                        $val = 'ltr';
                    }elseif($val == 2){
                        $val = 'rtl';
                    }
                }


                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));
            }
        }

        header("Content-type: text/xml; charset=utf-8");
        // Output as string
        echo $dom->saveXML();
    }


    public function GET_SUB_BOOKS(){

        ## account "ID"
        $type_app = trim($_REQUEST['type_app']);

        $extra_tags = trim($_REQUEST['extra_tags']);

        if($extra_tags == true) $extra_tags = ', `book_price` , `store_id` AS book_product_id'; else $extra_tags = false;

        $result = @mysql_query("SELECT `parent` as main_book_id, `parent` as main_book_image_link, book_name AS sub_book_name,book_image AS sub_book_image, book_extra AS sub_book_dl, `book_dir` AS sub_book_direction, `store_id` as sub_book_store_id , `book_summary` as sub_book_summary, `sort_id` FROM `books` WHERE `parent` != '0' and `book_type` = '{$type_app}' ORDER BY sort_id ASC");

        if( !mysql_num_rows($result) ){
            FUNCTIONS::xml_msg('0');
            exit();
        }

        // The names of the root node and the node that will contain a row
        $root_element = "response";


        // Create the DOMDocument and the root node
        $dom = new DOMDocument('1.0', 'utf-8');
        $rootNode = $dom->appendChild($dom->createElement($root_element));


        // Loop the DB results
        while ($row = mysql_fetch_assoc($result)) {
            $row_element_s1 = "sub_books";
            // Create a row node
            $rowNode = $rootNode->appendChild($dom->createElement($row_element_s1));
            // Loop the columns
            foreach ($row as $col => $val) {

                if($col == 'sub_book_direction'){
                    if($val == 1){
                        $val = 'ltr';
                    }elseif($val == 2){
                        $val = 'rtl';
                    }
                }

                if($col == 'main_book_image_link'){
                    if($val == true){
                        $val = mysql_result(mysql_query("SELECT book_image FROM `books` WHERE `id` = '{$val}' LIMIT 1"),0 ) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
                    }
                }

                // Create the column node and add the value in a CDATA section
                $rowNode->appendChild($dom->createElement($col))->appendChild($dom->createCDATASection($val));
            }
        }

        header("Content-type: text/xml; charset=utf-8");
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

