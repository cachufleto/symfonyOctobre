<?php

function connexionBDD()
{
	$host = 'localhost';
	$user = 'root';
	$mdp = '';
	$bdd = 'blogsymfony';
	
	$connexion = new mysqli($host, $user, $mdp, $bdd);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	return $connexion;
	
}

