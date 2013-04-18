<?php
$this->layout = <<<LAYOUT
<!DOCTYPE html>
<html>
    
    <head>
        <title>{$this->title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="css/screen.css" />
		<script src="js/main.js"></script>        
    </head>
    
    <body>
        <div>
        
            <div class="errors">
                {$this->errors}
            <div>
        
            {$this->template}
   
        </div>
    </body>
    
</html>             
LAYOUT;
?>