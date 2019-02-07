<?php
/**
 * Created by PhpStorm.
 * User: terry
 * Date: 07/02/19
 * Time: 20:05
 */

namespace justjob\modeles;
use Illuminate\Database\Eloquent\Model as Model;

class Transport extends Model {
    protected $table = 'transport';
    protected $primaryKey = 'idTransport';
    public $timestamps = true;

    public function offre () {
        return $this->belongsTo("\justjob\modeles\Offre", "idOffre");
    }

    public function transporteur() {
        return $this->belongsTo("\justjob\modeles\Utilisateur", "idTransporteur");
    }

    public function employe() {
        return $this->belongsTo("\justjob\modeles\Utilisateur", "idEmploye");
    }
}