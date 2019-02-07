<?php

require_once 'vendor/autoload.php';

use \justjob\bd\ConnectionDB as ConnectionDB;
use \justjob\controleurs as c;

use \justjob\vues\VueConnexion as VueConnexion;
use \justjob\controleurs\ControleAuthentification as ControleAuthentification;


session_start();

//$test = new ContCandidature();
ConnectionDB::start('src/conf/conf.ini');

$app = new \Slim\Slim();

//Page d'accueil
$app->get("/", function() {
    $v = new VueConnexion("connexion", null);
    $v->render("");
})->name('formConnexion');

$app->get('/candidatures/:id',function($id){
    $c = new c\ContCandidature();
    $c->afficherTout($id);
});

//Envoie la liste des utilisateurs disponibles
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

//Envoie le formulaire d'inscription
$app->get('/formInscription',function(){
    $v = new VueConnexion("inscription", null);
    $v->render("");
})->name('formInscription');

//On va vérifier que la connexion est possible
$app->post("/connexion", function() {
    $a = \Slim\Slim::getInstance();
    if(ControleAuthentification::authenticate($_POST['email'], $_POST['pass']))
        $a->redirectTo("accueil");
    else {
        $v = new VueConnexion("connexion", null);
        $v->render("ER_CONNEXION");
    }
})->name("connexion");

//On va inscrire l'utilisateur dans la bdd
$app->post("/inscription", function() {
    $a = \Slim\Slim::getInstance();
    if(ControleAuthentification::createUser())
        $a->redirectTo('accueil');
    else {
        $v = new VueConnexion("inscription", null);
        $v->render("ER_INSCRIPTION");
    }
})->name("inscription");

$app->get('/accueil', function() {
    //$v = new VueAccueil();
    //$v->render();
    if(isset($_SESSION['profile']))
        echo "Connecté";
    else
        echo "Non connecté";
})->name('accueil');
$app->run();
