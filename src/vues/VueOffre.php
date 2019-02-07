<?php

namespace justjob\vues;

class VueOffre{

  $tab;

  public function __construct($t = []){
    $tab = $t
  }

  function creerOffreForm(){
    $content = '<form id="form1" method="POST" action="liste">
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

  function afficheDetail(){
    $offre = $this->tab[0];
    $employeur = $this->tab[1];
    $content = "Offre ".$offre->id."<br>
    Employeur : ".$employeur->nom."<br>
    Profil recherché :<br>".$offre->profil."<br><br>".$offre->duree."<br>
    Lieu : ".$offre->lieu;
    return $content;
  }

  function afficherOffres(){
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
    foreach ($offres as $o) {
      $content = $content."Offre ".$o->id." ".$o->nom."<br>"
    }
    return $content;

  }

  public function render($sel){
    switch($sel){
      case 1:
        $content = $this->creerOffre();
      case 2:
        $content = $this->afficheDetail();
      case 3:
        $content = $this->afficherOffres();
    }
  }

?>
