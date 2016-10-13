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
		<div class="input"><input type="hidden" name="id" value="$id"></div>
        <div class="input"><input type="submit" name="valide" value="modifier"></div>
	</form>
	</div>
	<div id="content">
EOL;
if(!empty($article)) {
        echo "
<div class='titre'>{$article['title']}<span class='actions'> 
<a href='?page=modifier&article={$article['id']}'>Mod.</a> 
<a href='?page=supprimer&article={$article['id']}'>Sup.</a></span></div>
<div class='content'>{$article['content']}</div>
<div class='date'>{$article['date']}</div>";
}
echo <<<EOL
	</div>
EOL;

