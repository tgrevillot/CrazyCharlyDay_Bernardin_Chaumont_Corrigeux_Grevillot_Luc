<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;

class ContOffre{

  function creerOffreForm(){
    $vue = new v\VueOffre();
    $vue->render();
  }

  function creerOffre($employeur,$profil,$duree,$lieu,$etat,$cat){
    $o = new Offre();
    $o->idEmployeur = $employeur;
    $o->profil = $profil;
    $o->duree = $duree;
    $o->lieu = $lieu;
    $o->etat = $etat;
    $o->idCategorie = $cat;
    $o->save();
    $vue = new v\VueOffre();
    $vue->render();
  }

  function afficheDetail($id){
    $offre = m\Offre::find($id);
    $vue = new v\VueOffre([$offre]);
    $vue->render();
  }

  function afficherOffresCat($cat){
    $categorie = m\Categorie::where('nom','=',$cat);
    $offres = m\Offre::where('idCategorie','=',$categorie->id)->get();
    $vue = new v\VueOffre([$categorie,$offres]);
    $vue->render();
  }

  function afficherOffres(){
    $offres = m\Offre::all();
    $vue = new v\VueOffre([$offres]);
    $vue->render();
  }
}

?>
