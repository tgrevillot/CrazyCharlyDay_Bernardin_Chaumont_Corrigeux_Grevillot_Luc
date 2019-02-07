<?php

require_once 'vendor/autoload.php';

use \justjob\bd\ConnectionDB as ConnectionDB;
use \justjob\vues\VueConnexion as VueConnexion;
//use \justjob\controleurs\ContCandidature as ContCandidature;

session_start();

//$test = new ContCandidature();
ConnectionDB::start('src/conf/conf.ini');

$app = new \Slim\Slim();

$app->get("/", function() {
    $v = new VueConnexion("connexion");
    echo $v->render("");
})->name('formConnexion');

$app->get('/candidatures/$id',function($id){
    $c = new c\ContCandidature();
    $c->afficherTout($id);
});

$app->get('/formInscription',function(){
    $v = new VueConnexion("inscription");
    echo $v->render("");
})->name('formInscription');

$app->run();