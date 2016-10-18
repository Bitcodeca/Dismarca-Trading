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
            <div class="row margintop50">
                <div class="container">
                    <div class="col-md-3 col-sm-3 col-xs-12  marginbot10">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Contáctanos</h3>
                        </div>
                        
                            <table style=width:100%>
                                <tr>
                                    <th class="thfooter"><h5 class="letra2"><i class="margintop10 fa fa-phone fa-lg"> </i> Teléfono:</h5></th>
                                    <th>
                                        <p><h5 class="letra2">0251-929-0344</h5></p>
                                        <p><h5 class="letra2">0251-446-2093</h5></p>
                                        <p><h5 class="letra2">0251-446-4734</h5></p>
                                        <p><h5 class="letra2">0424-549-2498</h5></p>
                                        <p><h5 class="letra2">0416-651-6288</h5></p>
                                        <p><h5 class="letra2">0412-053-0883</h5></p>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="thfooter"><h5 class="marginbot0 letra2"><i class="fa fa-fax fa-lg"> </i> Fax:</h5></th>
                                    <th><h5 class="letra2 marginbot0">0251-447 1182</h5></th> 
                                </tr>
                                <tr>
                                    <th class="thfooter"><h5 class="marginbot0 letra2"><i class="fa fa-map-marker fa-lg"></i> Ubicación:</h5></th>
                                    <th><h5 class="letra2 marginbot0">Calle 51, esquina carrera 13 C, Barquisimeto, Edo Lara. Venezuela</h5></th> 
                                </tr>
                                <tr>
                                    <th class="thfooter"><h5 class="marginbot0 letra2"><i class="fa fa-envelope fa-lg"></i> Correo:</h5></th>
                                    <th><h5 class="letra2 marginbot0">ventas@dismarca.com</h5></th> 
                                </tr>
                            </table>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12  marginbot10">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Productos</h3>
                        </div>
                        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop10">
                            <label class="hidden" for="s"><?php _e('Search:'); ?></label>
                            <?php $marca = get_terms( 'grupo', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
                            foreach ($marca as $i) { ?>
                                    <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="<?php echo $i->slug; ?>">
                                        <h5 class="marginbot0 letra2"><?php echo $i->name; ?></h5>
                                    </button>
                            <?php } ?>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12  marginbot10">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Productos por Marca</h3>
                        </div>
                        <div class="margintop10 paddingtop1">
                            <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" >
                                <label class="hidden" for="s"><?php _e('Search:'); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-6">
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
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                <?php }
                                    $y++;
                                } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12  marginbot10">
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