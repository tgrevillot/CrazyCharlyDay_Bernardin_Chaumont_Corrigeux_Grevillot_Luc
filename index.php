<?php

require_once 'vendor/autoload.php';

use \justjob\bd\ConnectionDB as ConnectionDB;
use \justjob\controleurs as c;

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

$app->get('/candidatures/:id',function($id){
    $c = new c\ContCandidature();
    $c->afficherTout($id);
});


$app->get('/candidature/:id/:token',function($id,$token){
    $c = new c\ContCandidature();
    $c->afficherCandidature($id,$token);
})->name('afficherCandidature');


$app->get('/modifierCandidature/:id/:token',function($id,$token){
    $c = new c\ContCandidature();
    $c->modifierCandidature($id,$token);
})->name('modifierCandidature');

$app->get('/formInscription',function(){
    $v = new VueConnexion("inscription");
    echo $v->render("");
})->name('formInscription');

<<<<<<< HEAD
=======
$app->get('/accueil', function() {
    $v = new VueAccueil(),
    echo $v->render();
})->name('accueil');

>>>>>>> eb0f121ea687da48dfa7a76c6ea9fda0994bb935
$app->run();
