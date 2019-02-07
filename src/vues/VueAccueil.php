<?php

namespace justjob\vues;

class VueAccueil {

  private $utilisateur, $app;

  public function __construct($tab = array()){

    if(isset($tab['utilisateur'])){
      $this->utilisateur = $tab['utilisateur'];
    }

    $this->app = \Slim\Slim::getInstance();
  }

    public function render(){
        $app = \Slim\Slim::getInstance();

        $lienAccueil = $app->urlFor("accueil");

        $lienCandidature = $app->urlFor("candidatures",array("id" => $_SESSION['profile']['id']));
        $lienOffre = $app->urlFor("afficherOffres");
        $lienCovoiturage = $app->urlFor("viewCovoiturage");
        $lienCompte = $app->urlFor("compte",array('id' => $this->utilisateur->id));

        $html = <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <link rel="icon" href="./img/favicon.png">
                <title>Accueil</title>
                <link rel='stylesheet'  href='./css/bootstrap.min.css'/>
                <link rel='stylesheet'  href='./css/accueil.css'/>
            </head>

            <body>
                <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <a class="navbar-brand" href="$lienAccueil">
                    <img class="logo" src="./img/logo.png" width="120" height="50" alt="">
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
                                <a class="nav-link" href="$lienCandidature">Candidatures<span class="sr-only">(current)</span>
                                </a>
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
                        <img src="./img/profil.png" width="40" height="40" alt="">
                    </a>
                </nav>
            </body>
END;
        echo $html;
    }

    public function afficherPageDaccueil() {
        //Lien vers une page avec paramètres :
        //$lien = $this->slim->urlFor("nomRoute", array("nomParametre" => 1, "nomParametre2" => "truc"));
        $lienAccueil = $this->slim->urlFor("Accueil");

        $page = <<<EOF
            <div class="header">
                <h2 class="logo">justJob</h2>
                <input type="checkbox" id="chk">
                <label for="chk" class="show-menu-btn">
                    <i class="fas fa-ellipsis-h"></i>
                </label>
EOF;
        return $page;
    }
}
