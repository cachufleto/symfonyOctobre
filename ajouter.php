<?php
// BDD
require_once 'session.php';
session();

require_once 'bdd.php';

$title = "AJOUTER";

$message = "Bonjour {$_SESSION['auteur']['prenom']} {$_SESSION['auteur']['nom']}";
$alert = "";
$titre = isset($_POST['titre'])? $_POST['titre'] : '';
$content = isset($_POST['content'])? $_POST['content'] : '';

if($_POST){
	
}

// on génere la liste des articles
if(!empty($listeArticles = listeArticles())){
	var_dump($listeArticles);
} else {
	$listeArticles = 'LISTE DES ARTICLES VIDE';
}



include_once 'ajouter.tpl.php';

function listeArticles()
{
	$bdd = connexionBDD();
	$listeArticles = [];
	
	$sql = "select id, title, content, date from articles order by date DESC";
	if($action = $bdd->prepare($sql)){
//		$action->bind_param("ss",$_login, $_mdp);
		$action->execute();
		$action->bind_result($id, $title, $content, $date);
		if($action->affected_rows > 0){
			while($article = $action->fetch()){
				$listeArticles[] = [
					'id'=>$id, 
					'title'=>$title, 
					'content'=>$content, 
					'date'=>$date
				];
			}
		}
		$action->close();
	}
	
	return $listeArticles;
}
