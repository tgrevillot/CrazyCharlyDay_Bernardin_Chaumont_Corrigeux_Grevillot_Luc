<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;

class ContOffre{

  function creerOffreForm(){
    $vue = new v\VueOffre();
    $vue->render(1);
  }

  function creerOffre($nom,$employeur,$profil,$duree,$lieu,$etat,$cat){
    $o = new m\Offre();
    $o->nom = $nom;
    $o->idEmployeur = $employeur;
    $o->profil = $profil;
    $o->duree = $duree;
    $o->lieu = $lieu;
    $o->etat = $etat;
    $o->idCategorie = $cat;
    $o->save();
    $vue = new v\VueOffre([$o,$employeur]);
    $vue->render(2);
  }

  function afficheDetail($id){
    $offre = m\Offre::find($id);
    $employeur = m\Utilisateur::where('id','=',$offre->idEmployeur)->first();
    $vue = new v\VueOffre([$offre,$employeur]);
    $vue->render(2);
  }

  function afficherOffresCat($cat){
    $categorie = m\Categorie::where('nom','=',$cat)->first();
    $offres = m\Offre::where('idCategorie','=',$categorie->id)->get();
    $vue = new v\VueOffre([$offres,$categorie]);
    $vue->render(3);
  }

  function afficherOffres(){
    $offres = m\Offre::select('*')->get();
    $vue = new v\VueOffre([$offres]);
    $vue->render(3);
  }

  function afficherOffresEmployeur($id){
    $offres = m\Offre::where('idEmployeur','=',$id)->get();
    $vue = new v\VueOffre([$offres]);
    $vue->render(3);
  }
}

?>
