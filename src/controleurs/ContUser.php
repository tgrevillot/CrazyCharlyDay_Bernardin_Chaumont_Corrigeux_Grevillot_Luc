<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;


class ContUser {

  private $app;

  function __construct(){
    $this->app = \Slim\Slim::getInstance();
  }

  function afficherCompte(){
    $user = m\Utilisateur::where("id","=",$_SESSION['profile']['id'])->first();

    $vue = new v\VueUser(array("utilisateur" => $user));
    $vue->render('COMPTE');
  }

}
