<?php
echo <<<EOL
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
EOL;

