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
    <li><a href="modifier.php">MODIFIER</a></li>
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
	<div id="content">
	<div class="alert">$alert</div>
	<div class="message">$message</div>
	$listeArticles
EOL;
if(!empty($articles)) {
    foreach ($articles as $data) {
        echo "
<div class='titre'>{$data['title']}</div>
<div class='content'>{$data['content']}</div>
<div class='date'>{$data['date']}</div>";
    }
}
echo <<<EOL
	</div>
</body>
</html>
EOL;

