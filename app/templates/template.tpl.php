<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 11:37
 */
echo <<<EOL
<html>
<head>
<title>$title</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="menu">
<ul>
    <li><a href="?page=home">BLOG</a></li>
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
$content
</body>
</html>
EOL;

