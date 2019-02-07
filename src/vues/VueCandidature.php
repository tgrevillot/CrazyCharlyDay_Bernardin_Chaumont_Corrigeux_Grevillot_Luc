<?php

namespace justjob\vues;

class VueCandidature{

  public function __construct(){

  }

  public function afficheToutesCandidatures(){
    $html = '';
    
    return $html;
  }

  public function render($param){
    $contenu = "<h1>ERREUR !</h1>";

    switch($param){
      case 'CANDIDATURES'{
        $contenu = $this->afficheToutesCandidatures();
        break;
      }
    }
  }
}
 ?>
