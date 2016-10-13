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
    <li><a href="?pahe=home">BLOG</a></li>
EOL;

if(isset($_SESSION['auteur'])) {
    echo <<<EOL
    <li><a href="?page=ajouter">ADMINISTRATION</a></li>
    <li><a href="?page=deconnexion">DECONNECTER</a></li>
EOL;
} else {
    echo "
<li><a href=\"?page=connexion\">CONNEXION</a></li>";
}

echo <<<EOL
<ul>
</div>
	<div id="form">
	<div class="message">$message</div>
	<div class="alert">$alert</div>
</body>
</html>
EOL;

