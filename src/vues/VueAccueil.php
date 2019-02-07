<?php

namespace justjob\vues;

class VueAccueil {
    
    protected $typepage, $data;
    
    public function __construct($type, $data){
        $this->typepage=$type;
        $this->data = $data;
    }
    
    public function render(){
        switch($this->typepage){
            case "accueilAdmin":{
                $contenu = this->affichageAdmin();
                break;
            }
            
            case "accueilEmploye":{
                $contenu = this->affichageEmploye();
                break;
            }
            case "accueilEmployeur":{
                $contenu = this->affichageEmployeur();
                break;
            }
        }
    }
    public function afficherPageDaccueil() {
        //Lien vers une page avec paramètres :
        //$lien = $this->slim->urlFor("nomRoute", array("nomParametre" => 1, "nomParametre2" => "truc"));
        $lienAccueil = $this->slim->urlFor("Accueil");

        $page = <<< EOF
            <div class="header">
                <h2 class="logo">justJob</h2>
                <input type="checkbox" id="chk">
                <label for="chk" class="show-menu-btn">
                    <i class="fas fa-ellipsis-h"></i>
                </label>
            
            case "accueilEmploye":{
                $contenu = this->affichageEmploye();
                break;
            }
                
            case "accueilEmployeur":{
                $contenu = this->afficageEmployeur();
                break;
            }
        }
EOF;
        return $page;
    }
}
