<?php 

 $database_config =  [
    'driver' => 'mysql',
    // 'host' => '127.0.0.1',
    // 'database' => 'slimcv',
    // 'username' => 'root',
    // 'password' => '',
    'host' => 'localhost:3013',
    'database' => 'mysql_slimcv',
    'username' => 'root',
    'password' => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

// return $database_config;
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($database_config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

return $capsule;