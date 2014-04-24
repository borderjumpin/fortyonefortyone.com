<?php require('global.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortyone Fortyone</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top visible-xs" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php Nav::getMainLogo(false); ?>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php Nav::displayNavList(false); ?>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
<div>
    <div class="bs-docs-sidebar hidden-print affix leftNavCol col-sm-3 hidden-xs" role="complementary">
        <?php Nav::getMainLogo(); ?>
        <ul class="nav bs-docs-sidenav">
            <?php Nav::displayNavList(); ?>
        </ul>
    </div>
</div>
<div id="sections">
    <?php
    $infoPageNames = Site::getInfoPages();
    $pages = array();
    $pages[] = new Home();
    $pages[] = new Menu();
    foreach ($infoPageNames as $pageName) {
        $pages[] = new InfoPage($pageName);
    }

    foreach ($pages as $key => $page) {
        $section = 'section section' . (($key % 2) ? '2' : '1');
        echo '<section class="' . $section . '">';
        echo '<div class="col-sm-3 hidden-xs" style="height:100%; z-index: -1000;"></div>';
        echo '<div class="col-xs-5">';
        echo $page->header;
        echo $page->content;
        echo '</div>';
        echo '</section>';
    }
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
    var numberOfSections = 8;
    var minWindowHeight = 500;

    var sections = $('#sections');

    var menu = sections.find('#menu');

    var windowHeight = $(window).height() > minWindowHeight ?
        $(window).height() : minWindowHeight;

    $('.affix').find('#homeLink').click(function(){
        $('html, body').animate({ scrollTop:0 }, 1000 );
    });

    $('.container').find('#homeLink').click(function(){
        $('html, body').animate({ scrollTop:0 }, 1000 );
    });

    <?php

    $pages = Site::getAllPages();

    foreach ($pages as $page) {
        $pageLink = $page . 'Link';
        echo "var $pageLink = $('.nav').find('#$pageLink');\n";
        echo "$pageLink.click(function(){
                $('html, body').animate({ scrollTop: $('#$page').offset().top }, 1000);
                });";
    }
    ?>

    $.scrollTo(0);

    $(document).ready(function () {
        sections.css("height", windowHeight);
    });

    $(document).on('resize', function () {

        windowHeight = $(window).height() > minWindowHeight ?
            $(window).height() : minWindowHeight;

        sections.css("height", windowHeight);
    });
</script>

<script src="js/bootstrap.min.js"></script>
</body>
</html>


