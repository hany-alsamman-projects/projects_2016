<?php

/** Autoload any classes that are required **/

function __autoload($className)
{
    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.php')) {
        require_once (ROOT . DS . 'library' . DS . strtolower($className) . '.php');
    } else
        if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower
            ($className) . '.php')) {
            require_once (ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) .
                '.php');
        } else
            if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) .
                '.php')) {
                require_once (ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) .
                    '.php');
            } else
                if (file_exists(ROOT . DS . 'admin' . DS . $className . '.php')) {
                    require_once (ROOT . DS . 'admin' . DS . $className . '.php');
                } else {
                    /* Error Generation Code Here */
                }

}

## It's likely you're using a version of php
spl_autoload_register('__autoload');

/**
 * Set site lang
 */
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    // register the session and set the cookie
    $_SESSION['lang'] = $lang;
    
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
} else
    if (isset($_SESSION['lang'])) {
        $lang = $_SESSION['lang'];
    } else
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        } else {
            $lang = 'en';
        }

define("LANG_FILE", ($lang == 'ar') ? "lang.ar.php" : "lang.en.php" );

define("LANG_EXT", ($lang == 'ar') ? "ar" : "en" );

?>