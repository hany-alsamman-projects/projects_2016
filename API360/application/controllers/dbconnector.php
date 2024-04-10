<?php
/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 vipit.sa
 * @version 2.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */
 
class dbconnector
{
    private static $_singleton;
    private $_connection;
    protected $HOST = 'localhost';
    protected $USER_NAME = 'root'; //DB user
    protected $USER_PASSWORD = '123'; //DB password
    protected $DB_NAME = 'api'; //DB selected

  /**
   * SITE_DB::__construct()
   * 
   * @return
   */
    private function __construct()
    {
        $this->_connection = mysql_connect($this->HOST, $this->USER_NAME, $this->USER_PASSWORD) or die("Sorry, Cannot perform database!");
        mysql_select_db($this->DB_NAME, $this->_connection) or die("Sorry, Cannot open database!");
        mysql_set_charset("UTF8", $this->_connection);
        mysql_query("SET NAMES 'utf8'");
        register_shutdown_function(array(&$this, 'close'));
    }

  /**
   * SITE_DB::getInstance()
   * 
   * @return
   */
    public static function getInstance()
    {
        if (is_null(self::$_singleton)) {
            $class = __class__;
            self::$_singleton = new $class;
        }

        return self::$_singleton;
    }
    
  /**
   * SITE_DB::close()
   * 
   * @return
   */
	public function close() {
		mysql_close($this->_connection);
	}

  /**
   * SITE_DB::__clone()
   * 
   * @return
   */
    public function __clone()
    {
        trigger_error('It is impossible to clone singleton', E_USER_ERROR);
    }

}
?>
