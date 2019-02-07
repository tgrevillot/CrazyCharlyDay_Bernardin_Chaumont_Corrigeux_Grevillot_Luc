<?php

namespace justjob\vues;
use justjob\modeles as m;

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
    $html .= '<h1 class="titreCand">Candidatures de '.$this->utilisateur->pseudo.'</h1>';

    $html .= '<div class="row1">';
    $html .= '<div class="row2">';
    $html .= '<h2> Détail de l\'offre</h2>';
    $html .= '<div class="row3">';

    $offre = m\Offre::where("id","=",$this->candidatures->idOffre)->first();
    $html .='<div class="col-sm-4">'.$offre->nom.'</div>';
    $html .='<div class="col-sm-4">'.$offre->profil.'</div>';
    $html .='<div class="col-sm-4">'.$offre->duree.'</div>';
    $html .='<div class="col-sm-4">'.$offre->lieu.'</div>';

    $categorie = m\Categorie::where("id","=",$offre->idCategorie)->first();
    $html .='<div class="col-sm-4">'.$categorie->nom.'</div>';
    $html .= '</div></div>';

    $html .= '<div class="row2">';
    $html .= '<h2> Détail de la candidature</h2>';
    $html .= '<div>';
    $html .= '<div class="row3">';
    $html .= '<div class="col-sm-4">'.$this->candidatures->etat.'</div>';
    $html .= '<div class="col-sm-4">'.$this->candidatures->adresseD.'</div>';
    $html .= '</div></div></div>';

    $modifierC = $this->app->urlFor('modifierCandidature',array('id' => $this->utilisateur->id, 'token' => $this->candidatures->token));
    $html .= '</div></div>';

    if($_SESSION['profile']['role'] == 2){
      $html .= '<div class="row">';
      $html .= '<form method="GET" action= "'.$modifierC.'">';
      $html .= '<button class="btn" value="modifierCandidature">Modifier la candidature</button>';
      $html .= '</form>';
      $html .= '</div>';
    }else if($_SESSION['profile']['role'] == 1) {
      $attente = $this->candidatures->etat;
      if($attente == "attente"){
        $html .= '<div class="row">';
        $html .= '<form method="GET" action= "'.$modifierC.'">';
        $html .= '<button class="btn" value="modifierCandidature ">Modifier la candidature</button>';
        $html .= '</form>';
        $html .= '</div>';
      }else{
        $html .= '<div class="row">';
        $html .= '<form method="GET" action= "'.$modifierC.'">';
        $html .= '<button class="btn" value="modifierCandidature" disabled>Modifier la candidature</button>';
        $html .= '</form>';
        $html .= '</div>';
      }
    }

    return $html;
  }

  public function modifierCandidature(){
    $html = '<div class="container">';

    $html .= '<div class="row">';
    $html .= '<h1 class="titreCand">Candidatures de '.$this->utilisateur->pseudo.'</h1>';

    $html .= '<div class="row1">';
    $html .= '<h2> Formulaire de modification : </h2>';

    $modifier_C = $this->app->urlFor('validerModification',array('id' => $this->utilisateur->id, 'token' => $this->candidatures->token));
    $suppimerC = $this->app->urlFor('supprimerCandidature',array('id' => $this->utilisateur->id, 'token' => $this->candidatures->token));

    if($_SESSION['profile']['role'] == 2){
      $html .= '<div class="row4">';
      $html .= '<form method="POST" action= "'.$modifier_C.'">';
      $html .= '<input type="text" name="adresseD" class="form-control" placeholder="adresseD" value="'.$this->candidatures->adresseD.'">';
      $html .= '<button class="btn" value="validerModification">Valider la modification</button>';
      $html .= '</form>';
      $html .= '<form method="POST" action= "'.$suppimerC.'">';
      $html .= '<button class="btn" value="supprimerCandidature">Supprimer la candidature</button>';
      $html .= '</form>';
      $html .= '</div>';

  }else if($_SESSION['profile']['role'] == 1) {
    $html .= '<div class="row4">';
    $html .= '<form method="POST" action= "'.$modifier_C.'">';
    $html .= '<input type="text" name="adresseD" class="form-control" placeholder="adresseD" value="'.$this->candidatures->etat.'">';
    $html .= '<button class="btn" value="validerModification">Valider la modification</button>';
    $html .= '</form>';
    $html .= '<form method="POST" action= "'.$suppimerC.'">';
    $html .= '<button class="btn" value="supprimerCandidature">Supprimer la candidature</button>';
    $html .= '</form>';
    $html .= '</div>';
  }

    $html .= '</div></div></div>';
    return $html;
  }

  public function afficheToutesCandidatures(){
    $html = '<div class="container">';

    $html .= '<div class="row">';
    $html .= '<h1 class="titreCand">Candidatures de '.$this->utilisateur->pseudo.'</h1>';
    $html .= '<div class="row3">';
    if(isset($this->candidatures)){
      foreach($this->candidatures as $value) {
        $lien = $lien = $this->app->urlFor('afficherCandidature', array('token' => $value->token, 'id' => $this->utilisateur->id));
        $html .='<div class="col-sm-4"><a href ='. $lien.'>'.$value->nom.'</div>';
      }
    }
    $html .= '</div>';
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


    $lienCandidature = $app->urlFor("candidatures",array("id" => $_SESSION['profile']['id']));
    $lienOffre = $app->urlFor("afficherOffres");

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
                          <a class="nav-link" href="$lienCandidature">Candidatures<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="$lienOffre">Offres d'emplois<span class="sr-only">(current)</span></a>
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
