<?php

require_once 'vendor/autoload.php';

use \justjob\bd\ConnectionDB as ConnectionDB;
use \justjob\controleurs as c;
use justjob\controleurs\ControleAuthentification as ControleAuthentification;
use \justjob\vues\VueConnexion as VueConnexion;


session_start();

//$test = new ContCandidature();
ConnectionDB::start('src/conf/conf.ini');

$app = new \Slim\Slim();

//Page d'accueil
$app->get("/", function() {
    $v = new VueConnexion("connexion", null);
    echo $v->render("");
})->name('formConnexion');

$app->get('/candidatures/:id',function($id){
    $c = new c\ContCandidature();
    $c->afficherTout($id);
});

//Envoie la liste des utilisateurs disponibles
$app->get("/chooseAccount", function() {
    ControleAuthentification::chooseUserAccount();
})->name("inviteChooseAccount");

$app->get('/candidature/:id/:token',function($id,$token){
    $c = new c\ContCandidature();
    $c->afficherCandidature($id,$token);
})->name('afficherCandidature');


$app->get('/modifierCandidature/:id/:token',function($id,$token){
    $c = new c\ContCandidature();
    $c->modifierCandidature($id,$token);
})->name('modifierCandidature');


//Envoie le formulaire d'inscription
$app->post('/modifierCandidature/:id/:token',function($id,$token){
  $c = new c\ContCandidature();
  $c->modifierCandidatureValide($id,$token);
})->name('validerModification');

$app->post('/supprimerCandidature/:id/:token',function($id,$token){
  $c = new c\ContCandidature();
  $c->supprimerCandidature($id,$token);
})->name('supprimerCandidature');


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
    $v = new VueAccueil();
    echo $v->render();
})->name('accueil');

$app->get('/creerOffre', function(){
  $c = new c\ContOffre();
  $c->creerOffreForm();
});

$app->post('/creerOffre', function(){
  $c = new c\ContOffre();
  $c->creerOffre($_POST['nom'],$_POST['employeur'],$_POST['profil'],$_POST['duree'],$_POST['lieu'],$_POST['etat'],$_POST['cat']);
});

$app->get('/afficherDetailOffre/:id', function($id){
  $c = new c\ContOffre();
  $c->afficheDetail($id);
})->name('offre');

$app->get('/afficherOffresCat/:cat', function($cat){
  $c = new c\ContOffre();
  $c->afficherOffresCat($cat);
});

$app->get('/afficherOffres', function(){
  $c = new c\ContOffre();
  $c->afficherOffres();
});

$app->get('/afficherOffresEmployeur/:employeur', function($employeur){
  $c = new c\ContOffre();
  $c->creerOffreForm($employeur);
});

$app->run();
