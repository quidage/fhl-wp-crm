<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="de" xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">

    <?php
    /**
     * Default Layout fuer http-Aufrufe
     * 
     * @todo Logout-Button
     * 
     * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
     * @author Enrioc Lauterschlag <enrico.lauterschlag@web.de>
     */
    ?>
    <head>
        <title><?php echo $this->title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/screen.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/menue.css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css' />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
        <script src="js/js-extends.js"></script>
        <script src="js/main.js"></script>
        <script src="js/js-test.js"></script>  
    </head>
    <body>
        <div id="wrap">

            <div id="header">

                <div id="logo">
                    <p>FHL-WP-CRM</p>
                </div>

                <div id="menu">
                    <?php
                    if(isset($_SESSION['login'])){ ?>
	                    <ul>
	
	                        <li><?php $this->getLink('&Uuml;bersicht', 'User', 'start'); ?></li>
	                        <li><?php $this->getLink('Kunden', 'Customer', 'listByUser'); ?></li>
	                        <li><?php $this->getLink('Projekte', 'Project', 'listByUser'); ?></li>
	
	                    </ul>
                    <?php } ?>
                </div>
				
                <div id="menu_config">
                    <?php
                    if(isset($_SESSION['login'])){ ?>
                    	<ul>
                    		<li><img src="images/config.png" height="32" />
                    			<ul>
                    				<li><?php $this->getLink('Einstellungen', 'user', 'showSettings'); ?></li>
                    				<li><?php $this->getLink('Logout', 'User', 'logout'); ?></li>
                    			</ul></li>
                    	</ul>
                    <?php } ?>
                </div>

            </div>

            <div id="main-content">

                <?php if (!empty($this->errors)): ?>
                    <div class="errors">
                        <?php echo $this->errors; ?>
                    </div>   
                <?php endif; ?>

                <?php echo $this->template; ?>

            </div>

            <div id="footer">

                <div id="copyright">
                    <p>fhl-wp-crm Designed &amp; Coded by Christian Hansen, Julian Hilbers &amp; Enrico Lauterschlag</p>
                </div>

            </div>            

        </div>
    </body>

</html>             