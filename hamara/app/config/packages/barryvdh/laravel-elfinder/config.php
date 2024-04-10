<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */

    'dir' => 'upload',

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    | https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
    |
    */

    'roots'  => array(
        array(
            'driver' => 'LocalFileSystem',
            'path'   =>  base_path() . '/upload',
            'URL'    =>  Config::get('app.url') . '/upload',
            'accessControl' => 'access' ,            // disable and hide dot starting
            'attributes' => array(
                array( // hide readmes
                       'pattern' => '/.htacess/',
                       'read' => false,
                       'write' => false,
                       'hidden' => true,
                       'locked' => false
                ),
            ),
        )
    )

);
