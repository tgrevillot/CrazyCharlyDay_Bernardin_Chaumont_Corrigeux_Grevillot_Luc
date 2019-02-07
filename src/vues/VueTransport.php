<?php
/**
 * Created by PhpStorm.
 * User: terry
 * Date: 07/02/19
 * Time: 21:36
 */

namespace justjob\vues;


class VueTransport {

    const AFFICHELISTECOVOIT = 0;
    private $selecteur, $data;

    public function __construct($sel, $data) {
        $this->selecteur = $sel;
        $this->data = $data;
    }

    public function render() {
        $style = "";
        $err = "";
        $contenu = "";
        switch($this->selecteur) {
            case self::AFFICHELISTECOVOIT:
                $contenu = $this->afficherNotYetImplemented();
                break;
        }
        $page = <<<EOF
        <!DOCTYPE html>
        <html>
            <head>
                <link rel="icon" href="./img/favicon.png">
                <meta charset="utf-8">
                <title>Authentification</title>
        $style
            </head>
            <body class="text-center">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-4 justify-content-md-center">

        $contenu
                        $err

                        </div>
                    </div>
                </div>
            </body>
        </html>
EOF;
        echo $page;
    }

    public function afficherListeCovoit() {
        var_dump($this->data);
        $val = "";
        foreach($this->data as $value) {
            $val = $val . "<p>" . $value[4] .  " description : " . $value[5] ."</p>";
        }
        return $val;
    }

    public function afficherNotYetImplemented() {
        return "<h1 class='display-4'>NOT YET IMPLEMENTED</h1>";
    }



}