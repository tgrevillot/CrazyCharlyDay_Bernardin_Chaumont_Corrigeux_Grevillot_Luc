<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;


class ContCandidature {

  private $app;

  function __construct(){
    $this->app = \Slim\Slim::getInstance();
  }

  function afficherTout($id){
    $user = m\Utilisateur::where("id","=",$id)->first();
    $candidatures = m\Candidature::where("idUtilisateur","=",$user->id)->get();

    $vue = new v\VueCandidature(array('candidatures' => $candidatures, 'utilisateur' => $user));
    $vue->render('CANDIDATURES');
  }


  function afficherCandidature($id,$token){
    $user = m\Utilisateur::where("id","=",$id)->first();
    $candidature = m\Candidature::where("token","=",$token)->first();

    $vue = new v\VueCandidature(array('candidatures' => $candidature, 'utilisateur' => $user));
    $vue->render('CANDIDATURE');
  }

  function modifierCandidature($id,$token){
    $user = m\Utilisateur::where("id","=",$id)->first();
    $candidature = m\Candidature::where("token","=",$token)->first();

    $vue = new v\VueCandidature(array('candidatures' => $candidature, 'utilisateur' => $user));
    $vue->render('MODIFIER');
  }

  function modifierCandidatureValide($id,$token){
    $candidature = m\Candidature::where("token","=",$token)->first();
    if(isset($_POST['adresseD'])){
      $candidature->adresseD = $_POST['adresseD'];
    }
    $candidature->save();
    $this->app->redirect($this->app->urlFor('afficherCandidature',array('id' => $id, 'token' => $token)));
  }

  function supprimerCandidature($id,$token){
    $candidature = m\Candidature::where("token","=",$token)->first();
    $candidature->delete();

    $this->app->redirect($this->app->urlFor('candidatures',array('id' => $id)));
  }
}
