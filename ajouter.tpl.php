<?php
echo <<<EOL
<html>
<head>
<title>$title</title>
<style>
.alert{
	color:red;
}

.message{
	color:green;
}

#content,
#form {
	width: 450px;
	margin: 10% auto;
}

#form .input,
#form .label{
    float: left;
	width:49%;
}
</style>
</head>
<body>
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
	</div>
</body>
</html>
EOL;

