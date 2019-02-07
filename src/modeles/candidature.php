<?php

namespace justjob\modeles;

use \Illuminate\Database\Eloquent\Model as Model;

class Candidature extends Model{

  protected $table = 'candidature';
  protected $primaryKey = 'idCandidature';
  public $timestamps = false;

  public function offre(){
    return $this->belongsTo('\justjob\modeles\Offre','idOffre');
  }

  public function utilisateur(){
    return $this->belongsTo('\justjob\modeles\utilisateur','id');
  }
}
