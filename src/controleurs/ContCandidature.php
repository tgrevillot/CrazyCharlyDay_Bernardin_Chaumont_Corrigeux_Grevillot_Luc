<?php

namespace justjob\controleurs;

use justjob\modeles as m;
use justjob\vues as v;


class ContCandidature {

  function afficherTout($id){
    $user = m\Users::where("idUser","=",$id)->get();
    $candidature = m\Candidature::where("idCandidat","=",$user->idUser);

    $vue = new v\VueCandidature(),
    $vue->render();
  }
}
