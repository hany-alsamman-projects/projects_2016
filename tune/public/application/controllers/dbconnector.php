<?php

/**
 * http://en.wikipedia.org/wiki/Singleton_pattern#PHP
 */
 
class dbconnector
{
    private static $_singleton;
    private $_connection;
    protected $HOST = 'localhost';
    protected $USER_NAME = 'root'; //DB user
    protected $USER_PASSWORD = ''; //DB password
    protected $DB_NAME = 'forex'; //DB selected

  /**
   * SITE_DB::__construct()
   * 
   * @return
   */
    private function __construct()
    {
        $this->_connection = mysql_connect($this->HOST, $this->USER_NAME, $this->USER_PASSWORD) or die("Sorry, Cannot perform database!");
        mysql_set_charset('utf8',$this->_connection); 
        mysql_select_db($this->DB_NAME, $this->_connection) or die("Sorry, Cannot open database!");
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
