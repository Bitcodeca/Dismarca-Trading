<?php get_header(); ?>
<div class="container margintop25">
  <div class="">
	<div class="grid">
      	<div class="grid-sizer"></div>
      	<div class="grid-item grid-item--width2 width100 heightbanner75 fondotransparente">
			<div class="innerbanner">
				<h2 class="letranegra">Dismarca</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc01.jpg" class="right0">
			<div class="innerbanner width90 text-center">
				<h2><i class="fa fa-quote-left fa-lg fa-border"></i>El entusiasmo es lo que hace que la esperanza brille como las estrellas<br><small class="pull-right letrablanca">Henry Ford</small></h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width3 fondotransparente">
				<div class="innerbanner width90">
					<h2 class="letraazul">Nuestra Historia</h2>
					<p class="letraazul">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
		</div>
      	<div class="grid-item grid-item--width4 fondorojo">
				<div class="innerbanner width90 text-center">
					<h2 class="letrablanca">¿Qué Hacemos?</h2>
					<p class="letrablanca">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
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