<?php
namespace justjob\vues;

class VueConnexion{
    protected $typepage;
    
    public function __construct($type){
        $this->typepage=$type;
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
        }
        
        $contenu ="<h1>Erreur de contenu</h1>";
        $style="<link rel='stylesheet'  href='./css/bootstrap.min.css'/>
                <link rel='stylesheet'  href='./css/Connexion.css'/>";
        switch($this->typepage){
            case "connexion":{
                $contenu = $this->connexion();
                break;
            }
            case "inscription":{
                $contenu = $this->inscription();
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
    
    /*public function inscription(){
        $app = \Slim\Slim::getInstance();
        $lienConnec = $app->urlFor('connexion');
        $inscription = $app->urlFor('insriptionPost');
        
        $html = <<<END
        <form method="POST" action="$inscription">
                        <img class="mb-2" src="./src/img/logo.png" alt="" width="160" height="72">
                            <h1>Inscription</h1>
                         <p>
                                    <input type="text" name="prenom" class="form-control" aria-describedby="emailHelp" placeholder="Prénom" required>
                                </p>
                                <p>
                                    <input type="text" name="nom" class="form-control" aria-describedby="emailHelp" placeholder="Nom" required>
                                </p>
                                <p>
                                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Adresse mail" required>
                                </p>
                                <p>
                                   <input type="text" name="pseudo" class="form-control" aria-describedby="emailHelp" placeholder="Pseudo" required>
                                </p>
                                <p>
                                    <input type="password" name="mdp" class="form-control" aria-describedby="emailHelp" placeholder="Mot de passe" required>
                                </p>
                                <p>
                                    <input type="password" name="mdpc" class="form-control" aria-describedby="emailHelp" placeholder="Confirmez mot de passe" required>
                                </p>
                               
                                <p>
                                    <a href=$lienConnec>
                                        <label class="btn btn-secondary">Annuler</label>
                                    </a>
                                    <button type="submit" class="btn btn-primary" name="inscription" value="inscription">Inscription</button>
                                </p>
                            </form>
END;
        return $html;
    }*/
    
    public function connexion(){
        $app = \Slim\Slim::getInstance();
        //$lien=$app->urlFor('Inscription');
        $lien = "";
        //$connexion = $app->urlFor('connexionPost');
        $connexion = "";
            
        $html = <<<END
         <form class="form-signin" method="POST" action="$connexion">
                            <img class="mb-5" src="./img/logo.png" alt="" width="160" height="72">
                            <h1>Connexion</h1>
                             <p>
                                    <input required type="email" name="mail" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="Votre adresse mail">
                                </p>
                                <p>
                                   <input type="password" name="pass" class="form-control" id="pass" aria-describedby="emailHelp" placeholder="Mot de passe" required>
                                </p>
                                    <a href=$lien><p class="text-muted">Vous n'avez pas de compte ? Inscrivez-vous !</p></a>
                                <p>
                                    <button type="submit" class="btn btn-primary" name="connexion" value="connec">Connexion</button>
                                </p>
                            </form>
END;
        return $html;
    }
}