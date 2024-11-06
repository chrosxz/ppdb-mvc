<?php
require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

//echo getenv('APP_ENV');
//echo $_ENV['APP_NAME'];

define('ROOT', realpath(__DIR__ . '/../'));


$connection = array(
    'dsn'      =>'mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD')  // use your actual password here
)


?>