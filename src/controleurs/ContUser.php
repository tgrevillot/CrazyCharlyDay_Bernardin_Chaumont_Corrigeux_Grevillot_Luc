<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;


class ContUser {

  private $app;

  function __construct(){
    $this->app = \Slim\Slim::getInstance();
  }

  function afficherCompte($id){
    $user = m\Candidature::where("id","=",$id)->first();

    $vue = v\VueUser(array("utilisateur" => $user));
    $vue->render('COMPTE');
  }

}
