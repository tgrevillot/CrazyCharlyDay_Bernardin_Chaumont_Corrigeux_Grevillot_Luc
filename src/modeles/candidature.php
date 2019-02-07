<?php

namespace justjob\modeles;

use \Illuminate\Database\Eloquent\Model as Model;

class Candidature extends Model{

  protected $table = 'candidature';
  protected $primaryKey = 'idCandidature';
  public $timestamps = false;

  /**
  public function candidature() {
    return $this->belongsTo('\wishlist\models\Liste','liste_id');
  }

  **/
}
