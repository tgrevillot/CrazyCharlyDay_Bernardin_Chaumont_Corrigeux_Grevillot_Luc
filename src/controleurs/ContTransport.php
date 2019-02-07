<?php
/**
 * Created by PhpStorm.
 * User: terry
 * Date: 07/02/19
 * Time: 19:54
 */

namespace justjob\controleurs;
use justjob\modeles\Candidature as Candidature;
use justjob\modeles\Transport as Transport;
use justjob\vues\VueTransport as VueTransport;


class ContTransport {

    public function getCandidatureCovoit() {
        $transports = Transport::where("comble", TRUE)->get();
        $tableauCandidatures = [];
        foreach($transports as $value)
            $tableauCandidatures[] = Candidature::where("idCandidature", " = ", $value->idCandidature)->first();

        $v = new VueTransport(VueTransport::AFFICHELISTECOVOIT, $tableauCandidatures);
        $v->render();
    }

    public function notYetImplemented() {
        $v = new VueTransport(VueTransport::AFFICHELISTECOVOIT, null);
        $v->render();
    }

}