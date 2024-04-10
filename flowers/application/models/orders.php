<?php
/*
.---------------------------------------------------------------------------.
|   Version: 1.2 RC1                                                        |
|   Author: Hany alsamman (project administrator && original founder)       |
|   Copyright (c) 2010, 3NJOOM. All Rights Reserved.                  |
| ------------------------------------------------------------------------- |
|   License: DISTRIBUTED UNDER 3NJOOM TEAM (PRIVETE ACCESS ONLY)		    |
'---------------------------------------------------------------------------'
*/

/**
 * ORDERS.php
 *
 * @package LINKS
 * @author Hany alsamman < hany.alsamman@gmail.com >
 * @copyright 3NJOOM.COM
 * @version 1.2 RC1
 * @pattern private
 * @lastupdate 04/10/2008 11:46:11 ã
 * @access TEAM
 */

class ORDERS extends CONTROLLERS
{
	
	var $ACTION;
	var $CODE;
    var $mylang;


    /**
     * ORDERS::__construct()
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
    
    /**
     * ORDERS::ORDERS_PROCESS()
     * 
     * @return
     */
    public function ORDERS_PROCESS()
    {
               
        
    }
    
    /**
     * ORDERS::ORDER_ID()
     * 
     * @return
     */
    public function ORDER_ID()
    {

		$HasOrder = @mysql_result(mysql_query("SELECT id FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and FIND_IN_SET({$_GET['id']},product_id)"),0);
        
        if(is_int($HasOrder)) return $HasOrder;

        return false;
    }
    
    /**
     * ORDERS::ORDER_DELIVERY()
     * 
     * @return
     */
    public function ORDER_DELIVERY()
    {

		$HasOrder = @mysql_result(mysql_query("SELECT id FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and FIND_IN_SET({$_GET['id']},product_id)"),0);
        
        if($HasOrder != false){
            $my_delivery_date = @mysql_result(mysql_query("SELECT delivery_date FROM `orders` WHERE `id` = '{$HasOrder}'"),0);
            return date('d/m/Y @ H:i',$my_delivery_date);
        }
        
        return false;
    }
    
    /**
     * ORDERS::INSERT_ORDER()
     * 
     * @return
     */
    public function INSERT_ORDER()
    {

		$HasOrder = @mysql_result(mysql_query("SELECT id FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and FIND_IN_SET({$_POST['PROD_ID']},product_id) LIMIT 1"),0);

		if($HasOrder == false){
          
          ## get product price
          $price = @mysql_result(mysql_query("SELECT prodcut_price FROM `".$this->prefix_lang."_products` WHERE `id` = '{$_POST['PROD_ID']}'"),0);
          
          ## get full delivery date and extract the date only
          $onlydate = explode("/", $_POST['delivery_date']);
         
          ## extract the time
          $mydate = explode(" ", strchr($_POST['delivery_date'],'@') ); list($at, $time, $ampm) = $mydate;
        
          ## get the hours and miunte
          $mytime = explode(":", $time); list($hours, $min) = $mytime;
          
          ## convert to unnix time
          $myunix  = mktime($hours, $min, 0, $onlydate[1]  , $onlydate[0], $onlydate[2]);
          
          ## insert order
          mysql_query("INSERT INTO `orders` 
          (`id`,`sender_id`,`product_id`,`price`,`delivery_date`,`order_status`,`order_date`)
          VALUES
          (NULL,'{$_SESSION[user_id]}', '{$_POST['PROD_ID']}', '{$price}', '{$myunix}', 'pending', '".time()."')") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
          
          return mysql_insert_id();
          
        }## end        
        
        return $HasOrder;
    }
    
    
    /**
     * ORDERS::UPDATE_ORDER()
     * 
     * @return
     */
    public function UPDATE_ORDER()
    {

		$OrderId = @mysql_result(mysql_query("SELECT id FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and FIND_IN_SET({$_POST['product_id']},product_id) LIMIT 1"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

		if($OrderId){
          
          ## get product price
          $product_id = @mysql_result(mysql_query("SELECT product_id FROM `orders` WHERE `id` = '{$OrderId}'"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
          
          ## get extra product price
          $extra_price = @mysql_result(mysql_query("SELECT prodcut_price FROM `".$this->prefix_lang."_products` WHERE `id` = '{$_POST['extra_id']}'"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
          
          $Array = explode(",", $product_id);
          
          if(!in_array($_POST['extra_id'],$Array)){

    		  array_push($Array,$_POST['extra_id']);
    		  $NewIDs = implode(",", $Array);
              
              ## update order
              mysql_query("UPDATE `orders` SET `product_id` = '{$NewIDs}', `price` = price + $extra_price  WHERE `id` = '{$OrderId}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
            
              //echo $_POST['extra_id']; 
          }
          
          //echo $product_id;
          
        }## end 
        
        return false;                
    }
    
    /**
     * ORDERS::REMOVE_FROM_ORDER()
     * 
     * @return
     */
    public function REMOVE_FROM_ORDER()
    {
          
        $del_extra = $_POST['extra_id'];
        
        $product_id = $_POST['product_id'];
        
        $where = (!empty($del_extra)) ? "product_id IN ($product_id,$del_extra)" : "`product_id` = '$product_id'";

		$OrderId = @mysql_result(mysql_query("SELECT id FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}' and $where"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
		
        
        $prodcut_price = @mysql_result(mysql_query("SELECT prodcut_price FROM `".$this->prefix_lang."_products` WHERE `id` = '{$del_extra}'"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        

		if($OrderId){
          
          ## get product price
          $my_product_id = @mysql_result(mysql_query("SELECT product_id FROM `orders` WHERE `id` = '{$OrderId}'"),0) or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
          
          $Array = explode(",", $my_product_id);
          $NewArray = array();
          
              if(in_array($del_extra,$Array)){
                
                foreach ( $Array as $Value ) {
                	if ( $Value != $del_extra ) {
                		array_push($NewArray, "$Value");
                		$NewIDs = implode(",", $NewArray);
                	}   
                }
              
              ## update price
              mysql_query("UPDATE `orders` SET `price` =  price - $prodcut_price  WHERE `id` = '{$OrderId}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
              
              ## update order
              mysql_query("UPDATE `orders` SET `product_id` = '{$NewIDs}' WHERE `id` = '{$OrderId}'") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
              
              }
          
          return true;
          
        }## end 
        
        return false;
                
    }
    
    /**
     * ORDERS::INSERT_DETAILS()
     * 
     * @return
     */
    public function INSERT_DETAILS()
    {
        
        
        // we check if everything is filled in            
        if( !empty($_POST['senderto_name']) || !empty($_POST['senderto_address']) || !empty($_POST['senderto_phone']) || !empty($_POST['senderto_city']) || !empty($_POST['sender_oncard']) )
        {
          
            ## account user name
            $senderto_name = trim($_POST['senderto_name']);
    
            $senderto_phone = trim((int)$_POST['senderto_phone']);
            
            $senderto_address = trim($_POST['senderto_address']);
            
            $senderto_city = trim($_POST['senderto_city']);
            
            $sender_oncard = trim($_POST['sender_oncard']);
            
            mysql_query("UPDATE `orders` SET `senderto_name` = '{$senderto_name}',`senderto_phone` = '{$senderto_phone}',`senderto_address` = '{$senderto_address}',`senderto_city` = '{$senderto_city}',`sender_oncard` = '{$sender_oncard}' WHERE `id` = '{$_POST['OrderID']}' ") or FUNCTIONS::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
        
            return true; 
         }              
        
    }
    
    
    /**
     * ORDERS::EMPTY_CART()
     * 
     * @return
     */
    public function EMPTY_CART()
    {

		@mysql_query("DELETE FROM `orders` WHERE `sender_id` = '{$_SESSION['user_id']}'");
        
        if(mysql_affected_rows() > 0 ) return true;

        return false;
    }
    /**
     * ORDERS::__destruct()
     * 
     * @return
     */
    public function __destruct()
    {
    	
    }
    
}