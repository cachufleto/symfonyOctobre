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

