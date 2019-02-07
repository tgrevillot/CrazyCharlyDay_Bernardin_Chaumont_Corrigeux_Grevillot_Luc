<?php

namespace justjob\modeles;
Use \Illuminate\Database\Eloquent\Model as Model;

class Offre extends Model{
  protected $table = 'offre';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function categorie(){
    return $this->belongsTo('\justjob\modeles\Categorie','idCategorie');
  }

  public function employeur(){
    return $this->belongsTo('\justjob\modeles\Utilisateur','idEmployeur')
  }

  public function candidatures(){
    return $this->hasMany('\justjob\modeles\Candidature','idOffre');
  }
}
