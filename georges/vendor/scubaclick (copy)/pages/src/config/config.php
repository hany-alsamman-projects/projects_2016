<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Holds the default db connection
    |--------------------------------------------------------------------------
    | This should be set to your default connection as specified in 
    | app/config/database.php. For multi-tenant setups this connection
    | can be changed at runtime, so we hardcode it here again.
    */
    'default_connection' => 'master',

    /*
    |--------------------------------------------------------------------------
    | Holds the foreign user id table
    |--------------------------------------------------------------------------
    | Can be set to just a string, like `users`. The anonymous function below
    | allows setting the foreign key on a different database, e.g.
    | on a multi-tenant setup
    */

    'user_id_foreign' => function() {
        $db      = Config::get('database.connections');
        $default = Config::get('pages::default_connection');

        $prefix   = $db[$default]['prefix'];
        $database = $db[$default]['database'];

        return new \Illuminate\Database\Query\Expression($database .'.'. $prefix .'users');
    },

    /*
    |--------------------------------------------------------------------------
    | URL Prefix
    |--------------------------------------------------------------------------
    | URLs get generated with URL::to, so if your routes are prefixed, then
    | add these below. Anonymous functions can also be used.
    */
    'prefix' => array(
        'page' => '',
        'post' => '',
    ),
);
