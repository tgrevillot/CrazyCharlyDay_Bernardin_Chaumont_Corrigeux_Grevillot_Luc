<?php
/**
 * Created by PhpStorm.
 * User: terry
 * Date: 07/02/19
 * Time: 10:41
 */

namespace justjob\controleurs;
use justjob\modeles\Utilisateur as Utilisateur;


class ControleAuthentification {
    const ROLE_ADMIN = 0, ROLE_EMPLOYEUR = 1, ROLE_CANDIDAT = 2;

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
                        $utilisateur->email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                        $utilisateur->password = $passHache;
                        //TODO : RAMENER LA COUPE A LA MAISON
                        //TODO : IMPLEMENTER LES ROLES DE TOUT A CHACUN
                        $utilisateur->save();
                        try {
                            if (!$utilisateur->email)
                                throw new \ErrorException();
                        } catch (\ErrorException $excep) {
                            echo("Erreur lors de la creation de votre compte : l'Email fournit est incorrect");
                            return false;
                        }
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function authenticate($email, $password) {
        if(!isset($_SESSION['profile'])) {
            $hashPassword = Utilisateur::select("password")->where("email", $email)->first();
            if(!is_null($hashPassword)) {
                if(password_verify($password, $hashPassword->password)) {
                    $user_id = Utilisateur::select("id")->where("email", $email)->first();
                    self::loadprofile($user_id);
                    return true;
                }

            }
            return false;
        } else {
            return true;
        }
    }

    public static function loadProfile($uid) {
        try {
            session_destroy();
        }catch(\Exception $e) {
            echo "La session n'a pas été détruite car elle n'existait pas !";
        }
        session_start();
        $infos = Utilisateur::select('nom', 'prenom', 'role')->where('user_id', $uid)->first();
        $_SESSION['profile']['user_id'] = $uid;
        $_SESSION['profile']['prenom'] = $infos->prenom;
        $_SESSION['profile']['role'] = $infos->role;
        $_SESSION['profile']['nom'] = $infos->nom;
    }


}