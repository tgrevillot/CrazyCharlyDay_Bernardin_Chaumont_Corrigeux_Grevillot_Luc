<?php

namespace justjob\vues;

class VueOffre{

  protected $tab;
  const CREER_OFFRE = 1, AFFICHER_DETAIL = 2, AFFICHER_OFFRES = 3;

  public function __construct($t = []){
    $this->tab = $t;
  }

  private function creerOffreForm(){
    $content = '<form id="form1" method="POST" action="">
                  <input type="text" name="nom" placeholder="nom" required>
                  <input type="text" name="employeur" placeholder="employeur" required>
                  <input type="text" name="profil" placeholder="profil" required>
                  <input type="text" name="duree" placeholder="duree" required>
                  <input type="text" name="lieu" placeholder="lieu" required>
                  <input type="text" name="etat" placeholder="etat" required>
                  <input type="text" name="cat" placeholder="categorie" required>
                  <button type="submit">Valider</button>
                </form>';
    return $content;
  }

  private function afficheDetail(){
    $offre = $this->tab[0];
    $employeur = $this->tab[1];
    $content = "Offre ".$offre['id']."<br>
    Employeur : ".$employeur['nom']."<br>
    Profil recherché :<br>".$offre['profil']."<br><br>".$offre['duree']."<br>
    Lieu : ".$offre['lieu'];
    return $content;
  }

  private function afficherOffres(){
    $offres = $this->tab[0];
    
    /*
    if(isset($this->tab[1])){
      if($this->tab[1] instanceof Categorie){
        $content = "Catégorie : ".$this->tab[1]->nom."<br>";
      }else{
        $content = "Employeur : ".$this->tab[1]->nom."<br>";
      }
    }
    */
    $app =\Slim\Slim::getInstance();

      $content = <<<END
      <div class="list-group">
END;
      
    foreach($offres as $value){
        $url = $app->urlFor('afficherOffreById',["id" =>$value->id] ) ;
        $content .= <<<END
        <a href="$url" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Offre $value->id</h5>
            </div>
            <p class="mb-1">$value->nom</p>
        </a>
END;
    }
      $content .= "</div>";

    return $content;

  }

  public function render($sel){
    $app = \Slim\Slim::getInstance();
    $path = "";
    switch($sel){
      case self::CREER_OFFRE:
        $content = $this->creerOffreForm();
        $path = "../";
        break;
      case self::AFFICHER_DETAIL:
        $content = $this->afficheDetail();
        $path = "../";
        break;
      case self::AFFICHER_OFFRES:
        $content = $this->afficherOffres();
        $path = "";
        break;
    }
        $lienAccueil = $app->urlFor("accueil");

        $lienCandidature = $app->urlFor("candidatures",array("id" => $_SESSION['profile']['id']));
        $lienOffre = $app->urlFor("afficherOffres");

        $html = <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <link rel="icon" href="$path./img/favicon.png">
                <title>Offres d'emploi</title>
                <link rel='stylesheet' href='$path./css/bootstrap.min.css'/>
                <link rel='stylesheet' href='$path./css/accueil.css'/>
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
                                <a class="nav-link" href="$lienCandidature">Candidatures<span class="sr-only">(current)</span>
                                </a>
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
                $content
            </body>
END;
        return $html;
  }
}
?>
