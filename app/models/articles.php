<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 12:22
 */

require_once MOD . 'superModel.php';

function listeArticles()
{
    $bdd = connexionBDD();
    $listeArticles = [];

    $sql = "select id, title, content, date from articles order by date DESC";
    if($action = $bdd->query($sql)){
//		$action->bind_param("ss",$_login, $_mdp);
        if($action->field_count > 0){
            while($article = $action->fetch_assoc()){
                $listeArticles[] = $article;
            }
        }
        $action->close();
    }
    return $listeArticles;
}

function ajoutArticle($data)
{
    $_title =  htmlentities($data['titre']);
    $_content =  htmlentities($data['content']);
    $bdd = connexionBDD();
    $sql = "INSERT INTO `articles` (`id`, `title`, `date`, `auteur_id`, `content`, `picture`)
VALUES (NULL, ?, CURRENT_TIMESTAMP, ?, ?, NULL);";
    if($action = $bdd->prepare($sql)){
        $action->bind_param("sis",$_title, $_SESSION['auteur']['id'], $_content);
        $action->execute();
//        $action->bind_result($id, $name, $lastname);
//        $action->fetch();

        $action->close();
        /*        if(!empty($id)){
                    session_start();
                    $_SESSION['auteur'] = [
                        'id'=>$id,
                        'prenom'=>$name,
                        'nom'=>$lastname,
                        'pseudo'=>$_login
                    ];*/
        return true;
    }
    return false;

}

function recupArticle($id)
{
    $bdd = connexionBDD();
    $article = [];

    $sql = "select id, title, content, date from articles where id = $id LIMIT 0,1";
    if($action = $bdd->query($sql)){
        if($action->field_count > 0){
            $article = $action->fetch_assoc();
        }
    }
    $action->close();
    return $article;
}

function updateArticle($data)
{
    $_title =  htmlentities($data['titre']);
    $_content =  htmlentities($data['content']);
    $id =  intval($data['id']);

    $bdd = connexionBDD();
    $sql = "UPDATE `articles` set `title` = ?, `content` = ? where id = ?;";
    if($action = $bdd->prepare($sql)){
        $action->bind_param("ssi",$_title, $_content, $id);
        $action->execute();
        $action->close();
        return true;
    }
    return false;

}

function supprimerArticle($data)
{
    if($id =  intval($data['article'])){

        $bdd = connexionBDD();
        $sql = "DELETE FROM `articles` WHERE `id` = ? ;";
        if($action = $bdd->prepare($sql)){
            $action->bind_param("i", $id);
            $action->execute();
            $action->close();
            return true;
        }
    }

    return false;
}

