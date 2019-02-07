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
    $v = new VueConnexion("connexion", null);
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
});

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
