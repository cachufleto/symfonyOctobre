<?php
echo <<<EOL
	<div id="form">
	<div class="alert">$alert</div>
	<div class="message">$message</div>
	<form action="" method="post">
		<div class="label">Titre</div>
		<div class="input"><input type="text" name="titre" value="$titre"></div>
		<div class="label">Article</div>
		<div class="input"><textarea name="content" value="">$content</textarea></div>
		<div class="label">&nbsp;</div>
		<div class="input"><input type="submit" name="valide" value="ajouter"></div>
	</form>
	</div>
	
	<div id="content">
	$listeArticles
EOL;
if(!empty($articles)) {
    foreach ($articles as $data) {
        echo "
<div class='titre'>{$data['title']}<span class='actions'> <a href='?page=modifier&article={$data['id']}'>Mod.</a> <a href='?page=supprimer&article={$data['id']}'>Sup.</a></span></div>
<div class='content'>{$data['content']}</div>
<div class='date'>{$data['date']}</div>";
    }
}
echo <<<EOL
	</div>
EOL;

