	<div class="clearfix"></div>
        <footer>
            <div class="row margintop25 marginbot10">
                <div class="container">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Contáctanos</h3>
                        </div>
                        <h5><i class="margintop10 fa fa-phone fa-lg"> </i> Teléfono: (058) 0251-xxxxxxx</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-fax fa-lg"> </i> Fax: (058) 0251-xxxxxxx</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-map-marker fa-lg"></i> Barquisimeto, Edo Lara. Venezuela </h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-envelope"></i>email</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-envelope"></i> fax</h5>
                        <h5 class="marginbot0 letra2"><i class="fa fa-envelope"></i> telf</h5>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Nuestra Oficina</h3>
                        </div>
                        <div class="margintop10 paddingtop1">
                            <?php $marca = get_terms( 'marca', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
                            foreach ($marca as $i) {
                                echo '<h5 class="marginbot0 letra2">'.$i->name.'</option>';
                             } ?>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="titulofooter">
                            <h3 class="margin0 letra2">Categorías</h3>
                        </div>
                        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop10">
                            <label class="hidden" for="s"><?php _e('Search:'); ?></label>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Carburadores y sus Partes">
                                <h5 class="marginbot0 letra2">Carburadores y sus Partes</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Partes eléctricas">
                                <h5 class="marginbot0 letra2">Partes Eléctricas</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s"  value="Fuel Injection">
                                <h5 class="marginbot0 letra2">Fuel Injection</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Sensores">
                                <h5 class="marginbot0 letra2">Sensores</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Kit de Tiempo y Entonación">
                                <h5 class="marginbot0 letra2">Kit de Tiempo y Entonación</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Aire Acondicionado">
                                <h5 class="marginbot0 letra2">Aire Acondicionado</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Carrocería">
                                <h5 class="marginbot0 letra2">Carrocería</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Suspensión">
                                <h5 class="marginbot0 letra2">Suspensión</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Tren Delantero">
                                <h5 class="marginbot0 letra2">Tren Delantero</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Frenos">
                                <h5 class="marginbot0 letra2">Frenos</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Rodamiento">
                                <h5 class="marginbot0 letra2">Rodamiento</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Accesorios">
                                <h5 class="marginbot0 letra2">Accesorios</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Correas y Mangueras">
                                <h5 class="marginbot0 letra2">Correas y Mangueras</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Transmisión">
                                <h5 class="marginbot0 letra2">Transmisión</h5>
                            </button>
                            <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="Otros">
                                <h5 class="marginbot0 letra2">Otros</h5>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
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