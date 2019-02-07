<?php

class VueAccueil {
    
    
    
    
    
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
            
                <ul class="menu">
                    <a href="$lienAccueil">Accueil</a>
                    <a href="map.php">Offres</a>
                    <a href="#">a completer</a>
                    <a href="#">Compte</a>
                    <a href="deconnexion.php">Deconnexion</a>
                    <label for="chk" class="hide-menu-btn">
                        <i class="fas fa-times"></i>
                    </label>
                </ul>
            </div>
EOF;
    return $page
}
