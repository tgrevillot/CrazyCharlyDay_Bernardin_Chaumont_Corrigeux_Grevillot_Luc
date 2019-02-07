<?php

namespace justjob\modeles;
Use \Illuminate\Database\Eloquent\Model as Model;

class Categorie extends Model{
  protected $table = 'categorie';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function offres(){
    return $this->hasMany('\justjob\modeles\Offre','idCategorie');
  }
}
