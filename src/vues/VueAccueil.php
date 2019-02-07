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
        
        $html = <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <link rel="icon" href="./img/favicon.png">
                <title>Accueil</title>
                <link rel='stylesheet'  href='./css/bootstrap.min.css'/>
                <link rel='stylesheet'  href='./css/connexion.css'/>
            </head>
            
            <body>
                <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <a class="navbar-brand" href="$lienAccueil">
                    <img src="$path./src/img/logo.png" width="120" height="50" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <form class="form-inline my-2 my-md-0 method="GET" action="$lienRecherche">
                        <input class="form-control" type="text" name="search" placeholder="Rechercher">
                    </form> 
                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listes</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a class="dropdown-item" href=$lienMesListes>Mes listes </a>
                                    <a class="dropdown-item" href=$lienListesPublic>Les listes du moment</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href=$lienCreateur>Liste des créateurs<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href=$lienContact>Contacts <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active" id="compte">
                                <a class="nav-link" href=$lienCompte>Mon compte <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                    <a class="nav-item " href=$lienCompte>
                        <img src="$path./src/img/profil.png" width="40" height="40" alt="">
                    </a>
                </nav>
            </body>                
END;
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
