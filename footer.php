	<div class="clearfix"></div>
        <footer>
            <div class="row margintop25 marginbot10">
                <div class="container">
                    <div class="col-md-4 col-sm-4 col-xs-12 marginbot25">
                        <h3 class="text-center">Contáctanos</h3>
                        <hr class="hrblanco">
                        <h5><i class="fa fa-envelope"></i>email</h5>
                        <h5><i class="fa fa-envelope"></i> fax</h5>
                        <h5><i class="fa fa-envelope"></i> telf</h5>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 marginbot25">
                        <h3 class="text-center">Nuestra Oficina</h3>
                        <hr class="hrblanco">
                            <h5><i class="fa fa-phone fa-lg"> </i> Teléfono: (058) 0251-xxxxxxx</h5>
                            <h5 class="margin25"><i class="fa fa-fax fa-lg"> </i> Fax: (058) 0251-xxxxxxx</h5>
                            <h5 class="margin25"><i class="fa fa-map-marker fa-lg"></i> Barquisimeto, Edo Lara. Venezuela </h5>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 marginbot25">
                        <h3 class="text-center">Mapa del Sitio</h3>
                        <hr class="hrblanco">
                          <ul class=""> 
                          </ul>
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