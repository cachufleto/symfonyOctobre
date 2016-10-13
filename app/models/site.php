<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 12:27
 */

require_once MOD . 'superModel.php';

function connexionAuteur(array $data)
{
    $_login = htmlentities($data['login']);
    $_mdp = htmlentities($data['mdp']);
    $bdd = connexionBDD();
    $sql = "select id, name, lastname from auteurs where login =? AND mdp=? LIMIT 0,1";
    if($action = $bdd->prepare($sql)){
        $action->bind_param("ss",$_login, $_mdp);
        $action->execute();
        $action->bind_result($id, $name, $lastname);
        $action->fetch();

        $action->close();
        if(!empty($id)){
            session_start();
            $_SESSION['auteur'] = [
                'id'=>$id,
                'prenom'=>$name,
                'nom'=>$lastname,
                'pseudo'=>$_login
            ];
            return true;
        }
    }
    return false;
}
