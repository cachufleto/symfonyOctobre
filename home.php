<?php
// BDD
require_once 'bdd.php';

$title = "HOME";

$message = "Bienvenue à mon BLOG";
$alert = "";

// on génere la liste des articles
if(!empty($articles = listeArticles())){
    $listeArticles = count($articles).' ARTICLES EN LISTE';
} else {
	$listeArticles = 'LISTE DES ARTICLES VIDE';
}



include_once 'home.tpl.php';

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