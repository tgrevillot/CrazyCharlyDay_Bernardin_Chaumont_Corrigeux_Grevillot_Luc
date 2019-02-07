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
    $content = "";
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

    foreach($offres as $value){
      $url = $app->urlFor('afficherOffreById',["id" =>$value->id] ) ;
      $content = $content."Offre <a href='$url'>$value->id</a><br><br> $value->nom<br>";
    }

    return $content;

  }

  public function render($sel){
    switch($sel){
      case self::CREER_OFFRE:
        $content = $this->creerOffreForm();
        break;
      case self::AFFICHER_DETAIL:
        $content = $this->afficheDetail();
        break;
      case self::AFFICHER_OFFRES:
        $content = $this->afficherOffres();
        break;
    }
    $html = <<< END
        <!DOCTYPE HTML>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Offre</title>
    <link rel="stylesheet" href="../.././src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../.././src/css/principale.css">
  </head>

  <body>
    $content
  </body>
  </html>
END;
    echo $html;
  }
}
?>
