<?php

class AFADAR_DB
{

    private static $_singleton;
    private $_connection;
    protected $HOST = 'localhost';
    protected $USER_NAME = 'root'; //DB user
    protected $USER_PASSWORD = '123'; //DB password
    protected $DB_NAME = 'sale'; //DB selected

    private function __construct()
    {
        $this->_connection = mysql_connect($this->HOST, $this->USER_NAME, $this->USER_PASSWORD) or die("Sorry, Cannot perform database!");
        mysql_select_db($this->DB_NAME, $this->_connection) or die("Sorry, Cannot open database!");
        register_shutdown_function(array(&$this, 'close'));
    }

    public static function getInstance()
    {
        if (is_null(self::$_singleton)) {
            $class = __class__;
            self::$_singleton = new $class;
        }

        return self::$_singleton;
    }

    public function close()
    {
        mysql_close($this->_connection);
    }

    public function __clone()
    {
        trigger_error('It is impossible to clone singleton', E_USER_ERROR);
    }
    
}
?>
