<?php
/**
 * Created by PhpStorm.
 * User: terry
 * Date: 07/02/19
 * Time: 10:41
 */

namespace justjob\controleurs;
use justjob\modeles\Utilisateur as Utilisateur;
use justjob\vues\VueConnexion;


class ControleAuthentification {
    const ROLE_ADMIN = 0, ROLE_EMPLOYEUR = 1, ROLE_CANDIDAT = 2;

    /**
     * Inscris un utilisateur
     * @return bool
     *  Vrai si la création du compte a fonctionné
     */
    public static function createUser() {
        if(isset($_POST)) {
            if(isset($_POST['password'])) {
                if($_POST['confirmPass'] === $_POST['password']) {
                    $pass = $_POST['password'];
                    $numero = preg_match("@[0-9]@", $pass);
                    $specialCharacter = preg_match("/\W/", $pass);
                    $minuscule = preg_match("@[a-z]@", $pass);

                    if(strlen($pass) > 6 && $numero && $specialCharacter && $minuscule) {
                        $passHache = password_hash($pass, PASSWORD_DEFAULT);
                        $utilisateur = new Utilisateur();
                        $utilisateur->nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
                        $utilisateur->prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
                        $utilisateur->pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
                        $utilisateur->email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                        $utilisateur->password = $passHache;
                        if(isset($_POST['role'])){
                          $utilisateur->role = $_POST['role'];
                        }else{
                          $utilisateur->role = 0;
                        }

                        try {
                            if (!$utilisateur->email)
                                throw new \ErrorException();
                        } catch (\ErrorException $excep) {
                            echo("Erreur lors de la creation de votre compte : l'Email fournit est incorrect");
                            return false;
                        }
                        $utilisateur->save();
                        self::loadProfile($utilisateur->id);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Connecte un utilisateur
     * @param $email
     *      email de l'utilisateur
     * @param $password
     *      mot de passe de l'utilisateur
     * @return bool
     *      Vrai si la connexion a réussi
     */
    public static function authenticate($email, $password) {
            $hashPassword = Utilisateur::select("password")->where("email", $email)->first();
            if(!is_null($hashPassword)) {
                if(password_verify($password, $hashPassword->password)) {
                    $user_id = Utilisateur::select("id")->where("email", $email)->first();
                    self::loadprofile($user_id->id);
                    return true;
                }else
                    return false;
            }
            return false;
    }

    /**
     * Charge les informations du profile dans une variable de session
     * @param $uid
     *  id de l'utilisateur
     */
    public static function loadProfile($uid) {
        try {
            session_destroy();
        }catch(\Exception $e) {
            echo "La session n'a pas été détruite car elle n'existait pas !";
        }
        session_start();
        $infos = Utilisateur::select('nom', 'prenom', 'role')->where('id', '=', $uid)->first();


        $_SESSION['profile']['id'] = $uid;
        $_SESSION['profile']['prenom'] = $infos->prenom;
        $_SESSION['profile']['role'] = $infos->role;
        $_SESSION['profile']['nom'] = $infos->nom;
    }

    /**
     * Charge la liste des utilisateurs et l'affiche via la vue de connexion
     */
    public static function chooseUserAccount() {
        $listeUser = Utilisateur::all();
        $vue = new VueConnexion("invite", $listeUser);
        $vue->render("");
    }

    public static function checkRight($required) {
        return isset($_SESSION['profile']) && $_SESSION['profile']['role'] >= $required;
    }

    public static function logout() {
        try {
            session_destroy();
        }catch(\Exception $e) {

        }
        $app = \Slim\Slim::getInstance();
        $app->redirectTo("/");
    }

}
