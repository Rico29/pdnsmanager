<?php
// TODO Move all settings to database that are not needed to connect to the database
// TO DISCUSS Should API settings be moved to DB too or stay here?

$config = ['settings' => [
    // Default settings for the slim based API
    'httpVersion'            => '2.0',
    'displayErrorDetails'    => false,

    // Default database settings
    'db' => [
        'type'       => 'mysql',
        'host'       => 'localhost',
        'user'       => 'powerdns',
        'password'   => '',
        'port'       => '3306',
        'name'       => 'powerdns',
    ],

    // TODO Move this to database
    // Default Security settings
    'security' => [
        'nonce_lifetime'    => 15,        
    ]
]];

include 'config-user.php';
$config = array_replace_recursive($config, $config_user);
?>