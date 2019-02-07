<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;


class ContCandidature {

  function afficherTout($id){
    $user = m\Users::where("id","=",$id)->get();
    $candidature = m\Candidature::where("idUtilisateur","=",$user->id);

    $vue = new v\VueCandidature(),
    $vue->render();
  }
}
