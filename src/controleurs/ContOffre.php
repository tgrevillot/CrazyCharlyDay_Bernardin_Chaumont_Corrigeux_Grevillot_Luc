<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;
use justjob\controleurs\ControleAuthentification as ControleAuthentification;

class ContOffre {

  function creerOffreForm(){
    $vue = new v\VueOffre();
    $vue->render(1);
  }

  function creerOffre($nom, $profil,$duree,$lieu,$etat,$cat){
    if(ControleAuthentification::checkRight(ControleAuthentification::ROLE_EMPLOYEUR)) {
      $o = new m\Offre();
      $o->nom = filter_var($nom, FILTER_SANITIZE_STRING);
      $o->idEmployeur = filter_var($_SESSION['profile']['id'], FILTER_SANITIZE_NUMBER_INT);
      $o->profil = filter_var($profil, FILTER_SANITIZE_STRING);
      $o->duree = filter_var($duree, FILTER_SANITIZE_STRING);
      $o->lieu = filter_var($lieu, FILTER_SANITIZE_STRING);
      $o->etat = filter_var($etat, FILTER_SANITIZE_STRING);
      $o->idCategorie = filter_var($cat, FILTER_SANITIZE_NUMBER_INT);
      $o->save();

      $context = \Slim\Slim::getInstance();
      $context->redirectTo("afficherOffreById", array("id" => $o->id));
    } else
      $this->goBackToHome();
  }

  function afficheDetail($id){
    if(isset($_SESSION['profile'])) {
      $offre = m\Offre::find($id);
      $employeur = m\Utilisateur::find($offre['id']);

      $vue = new v\VueOffre([$offre, $employeur]);
      echo $vue->render(v\VueOffre::AFFICHER_DETAIL);
    } else
      $this->goBackToHome();
  }

  function afficherOffresCat($cat){
    if(isset($_SESSION['profile'])) {
      $categorie = m\Categorie::where('nom', '=', $cat)->first();
      $offres = m\Offre::where('idCategorie', '=', $categorie->id)->get();
      $vue = new v\VueOffre([$offres, $categorie]);
      echo $vue->render(v\VueOffre::AFFICHER_OFFRES);
    } else
        $this->goBackToHome();
  }

  function afficherOffres(){
    if(isset($_SESSION['profile'])) {
      $offres = m\Offre::all();

      $vue = new v\VueOffre([$offres]);
      echo $vue->render(v\VueOffre::AFFICHER_OFFRES);
    } else
      $this->goBackToHome();
  }

  function afficherOffresEmployeur(){
    if(ControleAuthentification::checkRight(ControleAuthentification::ROLE_EMPLOYEUR)) {
      $offres = m\Offre::where('idEmployeur', '=', $_SESSION['profile']['id'])->get();
      $vue = new v\VueOffre([$offres]);
      echo $vue->render(v\VueOffre::AFFICHER_OFFRES);
    } else
      $this->goBackToHome();
  }

  private function goBackToHome() {
    $app = \Slim\Slim::getInstance();
    $app->redirectTo("accueil");
  }
}
