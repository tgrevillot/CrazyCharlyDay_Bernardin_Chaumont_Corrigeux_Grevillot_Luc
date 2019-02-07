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
    $html .= '<ul class="listecand">';

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
    $html .= '<ul class="listecand">';

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
    $html .= '<h1 class="titreCand">Candidatures de l\'utilisateur '.$this->utilisateur->id.'</h1>';
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
    $app = \Slim\Slim::getInstance();        
    $lienAccueil = $app->urlFor("accueil");
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
                    <link rel="stylesheet" href="$path./css/accueil.css">
                    <link rel="stylesheet" href="$path./css/candidatures.css">
                </head>

                <body>
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <a class="navbar-brand" href="$lienAccueil">
                    <img class="logo" src="$path./img/logo.png" width="120" height="50" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <form class="form-inline my-2 my-md-0 method="GET" action="">
                        <input class="form-control" type="text" name="search" placeholder="Rechercher">
                    </form> 
                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="">Candidatures<span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="">Offres d'emplois<span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                    <a class="nav-item " href=>
                        <img src="$path./img/profil.png" width="40" height="40" alt="">
                    </a>
                    </nav>
                    $contenu
                </body>
            </html>
END;
    echo $html;
  }
}
 ?>
