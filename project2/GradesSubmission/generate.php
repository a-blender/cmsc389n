<?php

function generatePage($body, $title="Example") {
    $page = <<<GENERATE
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" />
        <title>$title</title>	
    </head>
            
    <body>
            $body
    </body>
</html>
GENERATE;

    return $page;
}
?>