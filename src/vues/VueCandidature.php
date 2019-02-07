<?php

namespace justjob\vues;

class VueCandidature{

  private $candidatures, $utilisateur, $app;

  public function __construct($tab = array()){
    if(isset($tab['candidatures'])){
      $this->candidatures = $tab['candidatures'];
    }
    if(isset($tab['utilisateur'])){
      $this->utilisateur = $tab['utilisateur'];
    }

    $this->app = \Slim\Slim::getInstance();
  }


  public function afficherCandidature(){
    $html = '<div class="container">';

    $html .= '<div class="row">';
    $html .= '<h1>Candidature de l\'utilisateur '.$this->candidatures->nom.'</h1>';
    $html .= '<ul>';

    $html .= '<li>'.$this->candidatures->etat.'</li>';
    $html .= '<li>'.$this->candidatures->description.'</li>';
    $html .= '<li>'.$this->candidatures->adresseD.'</li>';
    $html .= '<li>'.$this->candidatures->adresseA.'</li>';

    $html .= '</ul>';

    $modifierC = $this->app->urlFor('modifierCandidature',array('id' => $this->utilisateur->id, 'token' => $this->candidatures->token));

    $html .= '<form method="GET" action= "'.$modifierC.'">';
    $html .= '<button class="btn" value="modifierCandidature">Modifier la candidature</button>';
    $html .= '</form>';
    $html .= '</div></div>';
    return $html;
  }

  public function modifierCandidature(){
    $html = '<div class="container">';

    $html .= '<div class="row">';
    $html .= '<h1>Candidature de l\'utilisateur '.$this->candidatures->nom.'</h1>';
    $html .= '<ul>';

    $html .= '<li>'.$this->candidatures->etat.'</li>';
    $html .= '<li>'.$this->candidatures->description.'</li>';

    $html .= '</ul>';

    $modifier_C = $this->app->urlFor('validerModification',array('id' => $this->utilisateur->id, 'token' => $this->candidatures->token));
    $suppimerC = $this->app->urlFor('supprimerCandidature',array('id' => $this->utilisateur->id, 'token' => $this->candidatures->token));

    $html .= '<form method="POST" action= "'.$modifier_C.'">';
    $html .= '<input type="text" name="adresseD" class="form-control" placeholder="adresseD" value="'.$this->candidatures->adresseD.'">';
    $html .= '<button class="btn" value="validerModification">Valider la modification</button>';
    $html .= '</form>';
    $html .= '<form method="POST" action= "'.$suppimerC.'">';
    $html .= '<button class="btn" value="supprimerCandidature">Supprimer la candidature</button>';
    $html .= '</form>';
    $html .= '</div></div>';
    return $html;
  }

  public function afficheToutesCandidatures(){
    $html = '<div class="container">';

    $html .= '<div class="row">';
    $html .= '<h1>Candidature de l\'utilisateur '.$this->utilisateur->id.'</h1>';
    $html .= '<ul>';

    if(isset($this->candidatures)){
      foreach($this->candidatures as $value) {
        $lien = $lien = $this->app->urlFor('afficherCandidature', array('token' => $value->token, 'id' => $this->utilisateur->id));
        $html .= '<li><a href ='. $lien.'>'.$value->nom.'</li>';
      }
    }

    $html .= '</ul>';
    $html .= '</div></div>';
    return $html;
  }

  public function render($param){
    $contenu = "<h1>ERREUR !</h1>";
    $title = "justjob";
    $path = "";

    switch($param){
      case 'CANDIDATURES':{
        $contenu = $this->afficheToutesCandidatures();
        $path = "../";
        break;
      }
      case 'CANDIDATURE' : {
        $contenu = $this->afficherCandidature();
        $path = "../../";
        break;
      }
      case 'MODIFIER' : {
        $contenu = $this->modifierCandidature();
        $path = "../../";
        break;
      }
    }
    $html = <<< END
        <!DOCTYPE HTML>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>$title</title>
    <link rel="stylesheet" href="$path./css/bootstrap.min.css">
  </head>

  <body>
    $contenu
  </body>
  </html>
END;
    echo $html;
  }
}
 ?>
