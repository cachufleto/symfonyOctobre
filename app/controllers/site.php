<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 12:20
 */

require_once CONT . 'superController.php';
require_once MOD . 'site.php';

function connexion(){

    $alert = "";
    $error = false;

    if($_POST){
        // valider les informations
        if(!isset($_POST['login']) OR empty($_POST['login'])){
            $error = true;
            $alert .= "Vous devez renseigner votre login<br>";
        }

        if(!isset($_POST['mdp']) OR empty($_POST['mdp'])){
            $error = true;
            $alert .= "Vous devez renseigner votre Mot de passe<br>";
        }

        if(!$error && connexionAuteur($_POST)){
            header('Location:?page=ajouter');
            exit;
        } else {
            $alert .= "Nous ne vous avons pas trouvé parmis nos auteurs<br>Merci de verifier votre login et mot de passe<br>";
        }
    }

    render('site'.DS.'connexion', [
        'title' => "CONNEXION",
        'alert' => $alert,
        'message' => "",
        'login' => isset($_POST['login'])? $_POST['login'] : ''
    ]);

}

function deconnexion(){
    session(false);
}
