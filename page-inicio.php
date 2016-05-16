<?php get_header(); ?>
<div class="container margintop25">
  <div class="">
	<div class="grid">
      	<div class="grid-sizer"></div>

		<?php $args=array('post_status' => 'publish', 'post_type'=> 'post', 'order' => 'ASC', 'posts_per_page' => -1 ); 
		$my_query = new WP_Query($args);
    	if( $my_query->have_posts() ) {
	        while ($my_query->have_posts()) : $my_query->the_post(); $id = get_the_ID();
	   			$tamanoarray = get_the_terms( $post->ID , 'tamaño' ); 
	      		$tamano=$tamanoarray[0]->name;
	      		if ($tamano==1) {
	      			$x='grid-item--width4';
	      			$y='';
	      		} elseif ($tamano==2) {
	      			$x='';
	      			$y='';
	      		} else {
	      			$x='grid-item--width2';
	      			$y='width90';
	      		}
	      		?>
          		<div class="grid-item <?php echo $x; ?>">
	      			<div class="overlay"></div>
					 	<?php echo the_post_thumbnail(); ?> 
					<div class="innerbanner <?php echo $y; ?>">
						<h2><?php echo get_the_title(); ?></h2>
						<?php the_content('',FALSE,''); ?>
					</div>
				</div>
	        <?php endwhile;
	       } ?>
		<div class="clearfix"></div>
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