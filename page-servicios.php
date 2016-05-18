<?php get_header(); ?>
<div class="container margintop25">
  <div class="">
	<div class="grid">
      	<div class="grid-sizer"></div>
      	<div class="grid-item grid-item--width2 width100 heightbanner75 fondotransparente">
			<div class="innerbanner">
				<h2 class="letranegra">Servicios Dismarca</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc03.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Entonación</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc04.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Latonería <br>y<br> pintura</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc05.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Mecánica <br>Ligera</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc06.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Carburadores</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc07.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Instalación <br>de sistemas<br> eléctricos</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc02.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Texto</h2>
				<p>Descripcion</p>
			</div>
		</div>
      	<div class="grid-item grid-item--width3 fondogris">
				<div class="innerbanner width90">
					<h2 class="letraazul">Dismarca</h2>
					<p class="letraazul">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondoazul">
				<div class="innerbanner">
					<h1 class="letrablanca text-center">REPUESTO <br> AUTOMOTRIZ</h1>
				</div>
		</div>
 	</div>
 	<div class="col-md-4 col-sm-4 col-xs-12 margintopmenos30">
 		<div class="row">
	 		<div class="text-center marginbotmenos40">
	 			<div class="puntoazul"></div>
				<i class="fa fa-clock-o fa-5x letrablanca icono" aria-hidden="true"></i>
			</div>
			<div class="height350 fondoazul paddingtop25">
				<h2 class="text-center letrablanca">Horario</h2>
			</div>
		</div>
		<div class="row">
	 		<div class="text-center marginbotmenos40">
	 			<div class="puntorojo"></div>
				<i class="fa fa-map-marker fa-5x letrablanca icono" aria-hidden="true"></i>
			</div>
			<div class="height350 fondorojo paddingtop25">
				<h2 class="letrablanca text-center">Ubicación</h2>
			</div>
		</div>
 	</div>
 	<div class="col-md-8 col-sm-8 col-xs-12 margintop25">
 		<div class="text-center">
 			<h2 class="letraazul">Titulo</h2>
 			<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h4>
 		</div>
 	</div>
  </div>
</div>
    <script>
	  	jQuery(window).ready( function() {
	        jQuery('.grid').isotope({
			  itemSelector: '.grid-item',
			  percentPosition: true,
			  masonry: {
			    columnWidth: 1
			  }
			});
	  	});
    </script>
    <script>
    	jQuery(window).bind("load", function() {
	    	setTimeout(function() { 
	    		jQuery('.grid').isotope('layout'); 
	    	}, 500);
		});
    </script>
<?php get_footer(); ?>