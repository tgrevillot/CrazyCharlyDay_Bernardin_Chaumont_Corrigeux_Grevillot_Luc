<?php

namespace justjob\vues;
use justjob\modeles as m;

class VueUser{

  private $utilisateur, $app;

  public function __construct($tab = array()){

    if(isset($tab['utilisateur'])){
      $this->utilisateur = $tab['utilisateur'];
    }

    $this->app = \Slim\Slim::getInstance();
  }

  private function afficherCompte(){
    $html = '<p>'.$this->utilisateur->id.'</p>';

    return $html;
  }

  public function render($param){
    $app = \Slim\Slim::getInstance();
    $lienAccueil = $app->urlFor("accueil");
    $contenu = "<h1>ERREUR !</h1>";
    $title = "justjob";
    $path = "";

    switch($param){
      case 'COMPTE':{
        $contenu = $this->afficherCompte();
        $path = "../";
        break;
      }
    }


    $lienCandidature = $app->urlFor("candidatures",array("id" => $_SESSION['profile']['id']));
    $lienOffre = $app->urlFor("afficherOffres");
    $lienCompte = $app->urlFor("compte",array('id' => $this->utilisateur->id));
    $lienCovoiturage = $app->urlFor("viewCovoiturage");

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
                    <link rel="icon" href="$path./img/favicon.png"
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
                        <li class="nav-item active">
                            <a class="nav-link" href="$lienCovoiturage">Transport<span class="sr-only">(current)</span></a>
                        </li>
                      </ul>
                    </div>
                    <a class="nav-item " href=$lienCompte>
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
