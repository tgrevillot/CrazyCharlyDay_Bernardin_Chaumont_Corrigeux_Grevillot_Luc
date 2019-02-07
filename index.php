<?php
require_once 'vendor/autoload.php';
$app = new \Slim\Slim();
use \Illuminate\Database\Capsule\Manager as DB;


$db = new DB();
$info= parse_ini_file('src/conf/conf.ini');
$db->addConnection($info);
$db->setAsGlobal();
$db->bootEloquent();
session_start();


$app->run();
