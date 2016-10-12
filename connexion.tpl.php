<?php
echo <<<EOL
<html>
<head>
<title>$title</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="menu">
<ul>
    <li><a href="home.php">BLOG</a></li>
EOL;

if(isset($_SESSION['auteur'])) {
    echo <<<EOL
    <li><a href="ajouter.php">AJOUTER</a></li>
    <li><a href="suprimer.php">SUPRIMER</a></li> 
    <li><a href="deconnexion.php">DECONNECTER</a></li>
EOL;
} else {
    echo "
<li><a href=\"connexion.php\">CONNEXION</a></li>";
}

echo <<<EOL
<ul>
</div>
	<div id="form">
	<div class="alert">$alert</div>
	<div class="message">$message</div>
	<form action="" method="post">
		<div class="label">Login</div>
		<div class="input"><input type="text" name="login" value="$login"></div>
		<div class="label">MDP</div>
		<div class="input"><input type="password" name="mdp" value=""></div>
		<div class="label">&nbsp;</div>
		<div class="input"><input type="submit" name="valide" value="connexion"></div>
	</form>
	</div>
</body>
</html>
EOL;

