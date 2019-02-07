<?php

require_once 'vendor/autoload.php';

use \justjob\bd\ConnectionDB as ConnectionDB;
//use \justjob\controleurs\ContCandidature as ContCandidature;

session_start();

//$test = new ContCandidature();
ConnectionDB::start('src/conf/conf.ini');

$app = new \Slim\Slim();

$app->run();
