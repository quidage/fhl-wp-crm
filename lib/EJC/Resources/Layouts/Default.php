<?php
/**
 * Default Layout fuer http-Aufrufe
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrioc Lauterschlag <enrico.lauterschlag@web.de>
 */
?>
<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $this->title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/screen.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/menue.css" media="all" />
        <script src="js/js-extends.js"></script>
        <script src="js/main.js"></script>
        <script src="js/js-test.js"></script>  
    </head>

    <body>
        <div id="wrap">
            
            <div id="header">

                <div id="menu">
                    <ul>
                        
                        <li><?php $this->getLink('&uuml;bersicht', 'User', 'start'); ?></li>
                        <li><?php $this->getLink('Kunden', 'Customer', 'listByUser'); ?></li>
                        <li><?php $this->getLink('Projekte', 'Projects', 'listByUser'); ?></li>
                 
                    </ul>
                </div>
                
                <div id="menu_config">
                    <a href="<?php $this->getUrl('user', 'showSettings'); ?>"><img src="images/iconset/einstellungen.png" /></a>
                </div>

            </div>

            <div id="main-content">

                <?php echo $this->template; ?>

            </div>

            <div id="footer">

                <div id="footer-content">
                    <p>Footer</p>
                </div>

                <div id="copyright">
                    <p>fhl-wp-crm Designed &amp; Coded by Christian Hansen, Julian
                        Hilbers &amp; Enrico Lauterschlag</p>
                </div>

            </div>            

        </div>
    </body>

</html>             