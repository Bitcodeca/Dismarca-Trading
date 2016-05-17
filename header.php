<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title> Dismarca</title>
		<?php wp_head(); ?>
        <link href='https://fonts.googleapis.com/css?family=Catamaran|Electrolize|Josefin+Sans' rel='stylesheet' type='text/css'>
	</head>
    <?php
        $page = get_page_by_title( 'Contacto' );
        $link = get_page_link($page ->ID );
    ?>
	<body>
        <div class="topheader">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 height100">
                        <div class="displayinline">
                            <a class="" href="#" rel="canonical">
                                <img src="<?php echo get_bloginfo('template_directory');?>/img/dismarcaheader.png" class="img-responsive marginauto">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 height100 margintopmenos50xs">
                        <div class="margintop25">
                            <p class="text-center letraroja"><b>Teléfonos: 0251-xxxxxx / 0251-xxxxxx</b></p>
                        </div>
                        <div class="margintop10 marginbot10">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 hidden-xs height100">
                        <div class="telf">
                            <a href="<?php echo $link; ?>"><h3 class="comocomprar letraroja"><i class="fa fa-shopping-cart fa-lg letraazul" aria-hidden="true"></i>¿Cómo <br> Comprar?</h3></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<div class="navbar-brand">
                        
                    </div>-->                 
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php  wp_nav_menu(array( 'theme_location' => 'principal', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new Bootstrap_Walker_Nav_Menu() ) ); ?>
                </div>
            </div>
        </nav>