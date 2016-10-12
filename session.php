<?php

function session($exit = false)
{
	session_start();

	if($exit){
		unset($_SESSION['auteur']);
		session_destroy();
		session_start();
	}

	if(!isset($_SESSION['auteur'])){
		header('Location:  connexion.php');
	}

}

