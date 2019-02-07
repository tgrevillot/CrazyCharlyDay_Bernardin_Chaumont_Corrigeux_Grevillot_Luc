<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;


class ContCandidature {

  function afficherTout($id){
    $user = m\Utilisateur::where("id","=",$id)->first();
    $candidatures = m\Candidature::where("idUtilisateur","=",$user->id)->get();

    $vue = new v\VueCandidature(array('candidatures' => $candidatures, 'utilisateur' => $user));
    $vue->render('CANDIDATURES');
  }


  function afficherCandidature($id,$token){
    $candidature = m\Candidature::where("token","=",$token)->first();

    $vue = new v\VueCandidature(array('candidatures' => $candidature));
    $vue->render('CANDIDATURE');
  }

  function modifierCandidature($id,$token){
    $candidature = m\Candidature::where("token","=",$token)->first();

    $vue = new v\VueCandidature(array('candidatures' => $candidature));
    $vue->render('MODIFIER');
  }
}
