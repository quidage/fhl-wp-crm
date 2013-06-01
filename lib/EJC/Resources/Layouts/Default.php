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
                        <?php $this->getAdmin(); ?>
                        
                        <li><a href="<?php $this->getUrl('user', 'start'); ?>">Home</a></li>
                        <li><a href="css/css-elemente.html">CSS Elements &raquo;</a>
                            <ul>
                                <li><a href="css-elemente.html#button">Button</a></li>
                                <li><a href="css-elemente.html#paragraph">Forms</a></li>
                                <li><a href="css-elemente.html#tables">Tables</a></li>
                            </ul></li>
                        <li><a href="single-page.html">Page &raquo;</a>
                            <ul>
                                <li><a href="#">Subpage</a></li>
                            </ul></li>
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