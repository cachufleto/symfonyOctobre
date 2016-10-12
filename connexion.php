<?php
// BDD
require_once 'bdd.php';

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

$title = "CONNEXION";
$alert = "";
$message = "";
$login = isset($_POST['login'])? $_POST['login'] : '';
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
		header('Location:ajouter.php');
        exit;
	} else {
		$alert .= "Nous ne vous avons pas trouvé parmis nos auteurs<br>Merci de verifier votre login et mot de passe<br>";
	}
}

include_once 'connexion.tpl.php';