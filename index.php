<?php

require_once 'vendor/autoload.php';

use \justjob\bd\ConnectionDB as ConnectionDB;
use \justjob\controleurs as c;

use \justjob\vues\VueConnexion as VueConnexion;
use \justjob\controleurs\ControleAuthentification as ControleAuthentification;

//use \justjob\controleurs\ContCandidature as ContCandidature;

session_start();

//$test = new ContCandidature();
ConnectionDB::start('src/conf/conf.ini');

$app = new \Slim\Slim();

$app->get("/", function() {
    $v = new VueConnexion("connexion", null);
    $v->render("");
})->name('formConnexion');

$app->get('/candidatures/:id',function($id){
    $c = new c\ContCandidature();
    $c->afficherTout($id);
});


$app->get("/chooseAccount", function() {
    ControleAuthentification::chooseUserAccount();
})->name("inviteChooseAccount");

$app->get("/connectAs/:uid", function($uid) {
    ControleAuthentification::loadProfile($uid);
    //TODO : REDIRIGER VERS LA PAGE ACCUEIL :
    //$app->redirectTo("nomDeLaRoute");
})->name("connectAs");

$app->get('/candidature/:id/:token',function($id,$token){
    $c = new c\ContCandidature();
    $c->afficherCandidature($id,$token);
})->name('afficherCandidature');


$app->get('/modifierCandidature/:id/:token',function($id,$token){
    $c = new c\ContCandidature();
    $c->modifierCandidature($id,$token);
})->name('modifierCandidature');

$app->get('/formInscription',function(){
    $v = new VueConnexion("inscription", null);
    $v->render("");
})->name('formInscription');

$app->get('/accueil', function() {
    //$v = new VueAccueil();
    //$v->render();
})->name('accueil');
$app->run();
