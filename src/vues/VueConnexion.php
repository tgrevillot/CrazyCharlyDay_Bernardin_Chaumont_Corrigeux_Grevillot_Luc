<?php
namespace justjob\vues;

class VueConnexion{
    protected $typepage, $data;
    
    public function __construct($type, $data){
        $this->typepage=$type;
        $this->data = $data;
    }
    
    public function render($erreur){
        $err="";
        switch($erreur){
            case "ER_CONNEXION" :{
                $err="<p class=\"erreur\">Mail ou mot de passe incorrect</p>";
                break;
            }
            case "ER_INSCRIPTION1" :{
                $err="<p class=\"erreur\">Les mots de passe sont différents</p>";
                break;
            }
            case "ER_INSCRIPTION2" :{
                $err="<p class=\"erreur\">Mail non disponible</p>";
                break;
            }
            case "ER_INSCRIPTION3":{
                $err='<p class=erreur>Votre mot de passe doit contenir au moins 6 caractères dont au moins une majuscule, une minuscule et un chiffre !</p>';
                break;
            }
            case "ER_INSCRIPTION":
                $err='<p class=\"erreur\">Inscription impossible</p>';
                break;
        }
        
        $contenu ="<h1>Erreur de contenu</h1>";
        $style="<link rel='stylesheet'  href='./css/bootstrap.min.css'/>
                <link rel='stylesheet'  href='./css/connexion.css'/>";
        switch($this->typepage){
            case "connexion":{
                $contenu = $this->connexion();
                break;
            }
            case "inscription":{
                $contenu = $this->inscription();
                break;
            }
            case "invite": {
                $contenu = $this->invites();
                break;
            }
        }
        
        $html =  <<< END
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
END;
        echo $html;
    }   
    
    public function inscription(){
        $app = \Slim\Slim::getInstance();
        $lienConnec = $app->urlFor('formConnexion');
        $inscription = $app->urlFor('inscription');
        
        $html = <<<END
        <form method="POST" action="$inscription">
            <img class="mb-2" src="./img/logo.png" alt="" width="320" height="150">
            <h1>Inscription</h1>
            <p><input type="text" name="prenom" class="form-control" aria-describedby="emailHelp" placeholder="Prénom" required></p>
            <p><input type="text" name="nom" class="form-control" aria-describedby="emailHelp" placeholder="Nom" required></p>
            <p><input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Adresse mail" required></p>
            <p><input type="text" name="pseudo" class="form-control" aria-describedby="emailHelp" placeholder="Pseudo" required></p>
            <p><input type="password" name="password" class="form-control" aria-describedby="emailHelp" placeholder="Mot de passe" required></p>
            <p><input type="password" name="confirmPass" class="form-control" aria-describedby="emailHelp" placeholder="Confirmer mot de passe" required></p>
            <p><input type="checkbox" name="candidat" id="candidat">  candidat   <input type="checkbox" name="employeur" id="employeur">  employeur</p>
            <p><a href=$lienConnec><label class="annul btn btn-secondary">Annuler</label></a><button type="submit" class="btn btn-primary" name="inscription" value="inscription">Inscription</button></p>
        </form>
END;
        return $html;
    }
    
    public function connexion(){
        $app = \Slim\Slim::getInstance();
        $lien=$app->urlFor('formInscription');
        $connexion = $app->urlFor("connexion");
            
        $html = <<<END
        <form class="form-signin" method="POST" action="$connexion">
            <img class="mb-5" src="./img/logo.png" alt="" width="320" height="150">
            <h1>Connexion</h1>
            <p><input required type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Adresse mail"></p>
            <p><input type="password" name="pass" class="form-control" id="pass" aria-describedby="emailHelp" placeholder="Mot de passe" required></p>
            <a href=$lien><p class="text-muted">S'inscrire.</p></a>
            <p><button type="submit" class="btn btn-primary" name="connexion" value="connec">Connexion</button></p>
            <p><a href=""><button class="btn btn-primary" name="invite" value="invite">Se connecter en tant qu'invité</button></a></p>
        </form>
END;
        return $html;
    }
    
    /*public function invites() {
        for($this->data as $value) {
            
        }
    }*/
}