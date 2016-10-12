<?php
// BDD
require_once 'session.php';
session();

require_once 'bdd.php';

$title = "AJOUTER";

$message = "Bonjour {$_SESSION['auteur']['prenom']} {$_SESSION['auteur']['nom']}";
$alert = "";
$error = false;

// On valide l'existance d'un ID
if(isset($_GET['article'])){
    // on verifie que il s'agit du même article
    if($_POST && intval($_POST['id']) == intval($_GET['article'])){
        // valider les informations
        if(!isset($_POST['titre']) OR empty($_POST['titre'])){
            $error = true;
            $alert .= "Vous devez renseigner le titre<br>";
        }

        if(!isset($_POST['content']) OR empty($_POST['content'])){
            $error = true;
            $alert .= "Vous devez renseigner le contenu<br>";
        }

        if(!$error && updateArticle($_POST)){
            unset($_POST);
            header('Location:ajouter.php');
            exit();
        }

    }

    $article = recupArticle(intval($_GET['article']));
    $titre = $article['title'];
    $content = $article['content'];
    $id = $article['id'];

} else {
    header('Location:ajouter.php');
    exit();
}

// on génere la liste des articles
include_once 'modifier.tpl.php';

function recupArticle($id)
{
    $bdd = connexionBDD();
    $article = [];

    $sql = "select id, title, content, date from articles where id = $id LIMIT 0,1";
    if($action = $bdd->query($sql)){
//		$action->bind_param("ss",$_login, $_mdp);
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