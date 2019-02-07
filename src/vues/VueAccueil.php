<?php

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
                $contenu = this->afficageEmployeur();
                break;
            }
        }
        
        
        
        
    }
}
