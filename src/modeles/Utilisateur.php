<?php

namespace justjob\modeles;
Use \Illuminate\Database\Eloquent\Model as Model;

class Utilisateur extends Model{
  protected $table = 'user';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function offres(){
    return $this->hasMany('\justjob\modeles\Offre','idEmployeur');
  }

  public function candidatures(){
    return $this->hasMany('\justjob\modeles\Candidature','idUtilisateur');
  }

  public function voyageTransporteur() {
      return $this->hasMany("\justjob\modeles\Transport", "idTransport");
  }

  public function voyageEmploye() {
      return $this->hasMany("\justjob\modeles\Transport", "idEmploye");
  }

}
