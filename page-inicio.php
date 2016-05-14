<?php get_header(); ?>
<div class="container margintop25">
  <div class="">
	<div class="grid">
      	<div class="grid-sizer"></div>
      	<div class="grid-item grid-item--width2">
      		<div class="overlay"></div>
				<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc02.jpg" class="">
				<div class="innerbanner width90">
					<h2>Dismarca</h2>
					<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h3>
				</div>
		</div>
      	<div class="grid-item grid-item--width3 fondogris">
				<div class="innerbanner width90">
					<h2 class="letraazul">Dismarca</h2>
					<p class="letraazul">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondorojo">
				<div class="innerbanner">
					<h1 class="letrablanca text-center">REPUESTO <br> AUTOMOTRIZ</h1>
				</div>
		</div>
      	<div class="grid-item">
      		<div class="overlay"></div>
				<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc02.jpg" class="">
				<div class="innerbanner">
					<h2>Texto</h2>
					<p>Descripcion</p>
				</div>
		</div>
      	<div class="grid-item">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc01.jpg" class="">
			<div class="innerbanner">
				<h2>Texto</h2>
				<p>Descripcion</p>
			</div>
		</div>
      	<div class="grid-item grid-item--width4 fondoazul">
				<div class="innerbanner">
					<h1 class="letrablanca text-center">REPUESTO <br> AUTOMOTRIZ</h1>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondorojo">
				<div class="innerbanner">
					<h1 class="letrablanca text-center">REPUESTO <br> AUTOMOTRIZ</h1>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondoazul">
				<div class="innerbanner">
					<h1 class="letrablanca text-center">REPUESTO <br> AUTOMOTRIZ</h1>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondorojo">
				<div class="innerbanner">
					<h1 class="letrablanca text-center">REPUESTO <br> AUTOMOTRIZ</h1>
				</div>
		</div>
      	<div class="grid-item grid-item--width2">
      		<div class="overlay"></div>
				<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc02.jpg" class="">
				<div class="innerbanner">
					<h2>Texto</h2>
					<p>Descripcion</p>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondorojo">
				<div class="innerbanner">
					<h1 class="letrablanca text-center"><i class="fa fa-clock-o fa-4x" aria-hidden="true"></i></h1>
				</div>
		</div>
      	<div class="grid-item grid-item--width3 fondogris">
				<div class="innerbanner width90">
					<h2 class="letraazul">Horario</h2>
					<p class="letraazul">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
		</div>	
      	<div class="grid-item grid-item--width3 fondogris">
			<iframe src="https://www.google.com/maps/d/embed?mid=1gYrl6AXGoePDpvr_NppUfzqurLQ&hl=es" width="100%" height="256"></iframe>
		</div>	
      	<div class="grid-item grid-item--width4 fondoazul">
				<div class="innerbanner">
					<h1 class="letrablanca text-center"><i class="fa fa-map-marker fa-4x" aria-hidden="true"></i></i></h1>
				</div>
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