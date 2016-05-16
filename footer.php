	<div class="clearfix"></div>
    <?php 
        $args = array('hide_empty' => false); $countgrupo=wp_count_terms( 'grupo', $args );
        $args = array('hide_empty' => false); $countmarca=wp_count_terms( 'marca', $args );
        $colgrupo=$countgrupo/2;
        $colmarca=$countmarca/2;
        if ($colgrupo>$colmarca) {
            $x=$colgrupo;
        } else { $x=$colmarca; }
    ?>
        <footer>
            <div class="row margintop25 marginbot10">
                <div class="container">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Contáctanos</h3>
                        </div>
                        <h5 class="letra2"><i class="margintop10 fa fa-phone fa-lg"> </i> Teléfono: (058) 0251-xxxxxxx</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-fax fa-lg"> </i> Fax: (058) 0251-xxxxxxx</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-map-marker fa-lg"></i> Barquisimeto, Edo Lara. Venezuela </h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-envelope"></i>email</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-envelope"></i> fax</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-envelope"></i> telf</h5>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Productos</h3>
                        </div>
                        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop10">
                            <label class="hidden" for="s"><?php _e('Search:'); ?></label>
                            <?php $marca = get_terms( 'grupo', array( 'orderby' => 'name', 'hide_empty' => 0 ) );
                            foreach ($marca as $i) { ?>
                                    <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="<?php echo $i->slug; ?>">
                                        <h5 class="marginbot0 letra2"><?php echo $i->name; ?></h5>
                                    </button>
                            <?php } ?>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Repuestos por Marca</h3>
                        </div>
                        <div class="margintop10 paddingtop1">
                            <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" >
                                <label class="hidden" for="s"><?php _e('Search:'); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php $marca = get_terms( 'marca', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
                                $y=0;
                                foreach ($marca as $i) { 
                                if ($y<=$x) { ?>
                                    <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="<?php echo $i->slug; ?>">
                                        <h5 class="marginbot0 letra2"><?php echo $i->name; ?></h5>
                                    </button>
                                <?php } else { 
                                    $y=0; ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php }
                                    $y++;
                                } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Mapa del Sitio</h3>
                        </div>
                          <?php  wp_nav_menu(array( 'theme_location' => 'principal', 'container' => false, 'menu_class' => 'margintop10 footernav letra2', 'walker' => new Bootstrap_Walker_Nav_Menu() ) ); ?>
                    </div>
                </div>
            </div>
			<div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="copyright text-center small">&copy; 2016 Dismarca C.A. | RIF: J-40426759-0 | Todos los Derechos Reservados | Desarrollado por  <a href="http://bitcodeweb.com/" target="_blank"><img src="<?php echo get_bloginfo('template_directory');?>/img/logomini.png"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
	<?php wp_footer(); ?>  
        <script>
            new WOW().init();
        </script>
        <script>
        jQuery('input').focus(
            function(){
                jQuery(this).parent('div').addClass('btnfocus');
            }).blur(
            function(){
                jQuery(this).parent('div').removeClass('btnfocus');
            });
        </script>
	</body>
</html>