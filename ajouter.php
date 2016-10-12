<?php
// BDD
require_once 'session.php';
session();

require_once 'bdd.php';

$title = "AJOUTER";

$message = "Bonjour {$_SESSION['auteur']['prenom']} {$_SESSION['auteur']['nom']}";
$alert = "";
$error = false;

if($_POST){
    // valider les informations
    if(!isset($_POST['titre']) OR empty($_POST['titre'])){
        $error = true;
        $alert .= "Vous devez renseigner le titre<br>";
    }

    if(!isset($_POST['content']) OR empty($_POST['content'])){
        $error = true;
        $alert .= "Vous devez renseigner le contenu<br>";
    }

    if(!$error && ajoutArticle($_POST)){
       $alert = 'Article Ajouté!';
        unset($_POST);
        header('Location:ajouter.php');
    }

}

$titre = isset($_POST['titre'])? $_POST['titre'] : '';
$content = isset($_POST['content'])? $_POST['content'] : '';

// on génere la liste des articles
if(!empty($articles = listeArticles())){
    $listeArticles = 'LISTE DES NOS '.count($articles).' ARTICLES';
} else {
	$listeArticles = 'LISTE DES ARTICLES VIDE';
}



include_once 'ajouter.tpl.php';

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