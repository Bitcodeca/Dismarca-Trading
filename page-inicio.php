<?php get_header(); ?>
<div class="container margintop25">
  <div class="">
	<div class="grid">
      	<div class="grid-sizer"></div>
		<?php $args=array('post_status' => 'publish', 'post_type'=> 'post', 'order' => 'ASC', 'posts_per_page' => -1, 'category_name' => 'inicio' ); 
		$my_query = new WP_Query($args);
    	if( $my_query->have_posts() ) { $x=0;
	        while ($my_query->have_posts()) : $my_query->the_post(); $id = get_the_ID();
	   			$tamanoarray = get_the_terms( $post->ID , 'tamaño' ); 
	      		$tamano=$tamanoarray[0]->name;
	      		if ($tamano==1) { ?>
          		<div class="grid-item grid-item--width4">
	      			<div class="overlay"></div>
					 	<?php echo the_post_thumbnail(); ?> 
					<div class="innerbanner">
						<h2 class="text-center"><?php echo get_the_title(); ?></h2>
						<h4 class="text-center"><?php the_content(); ?></h4>
					</div>
				</div>
	      		<?php } elseif ($tamano==2) { ?>
          		<div class="grid-item grid-item--width6 gridzoom">
	      			<div class="overlay"></div>
					 	<?php echo the_post_thumbnail(); ?> 
					<div class="innerbanner">
						<h2 class="text-center"><?php echo get_the_title(); ?></h2>
						<h4 class="text-center"><?php the_content(); ?></h4>
					</div>
				</div>
	      		<?php } elseif ($tamano==3) { ?>
          		<div class="grid-item grid-item--width2">
	      			<div class="overlay"></div>
					 	<?php echo the_post_thumbnail(); ?> 
					<div class="innerbanner width90">
						<h2><?php echo get_the_title(); ?></h2>
						<h4><?php the_content(); ?></h4>
					</div>
				</div>
	      		<?php } else { 
	      			if ($x % 2 == 0) { ?>
	      				<div class="grid-item col-md-9 col-sm-9 col-xs-12 fondotransparente">
	      					<div class="innerbanner width90">
								<h3 class><?php the_content(); ?></h3>
							</div>
						</div>
				      	<div class="grid-item col-md-3 col-sm-3 col-xs-12 fondorojo">
							<div class="innerbanner">
								<h2 class="letrablanca text-center"><?php echo get_the_title(); ?></h2>
							</div>
						</div>
					<?php } else { ?>
				      	<div class="grid-item col-md-3 col-sm-3 col-xs-12 fondoazul">
							<div class="innerbanner">
								<h2 class="letrablanca text-center"><?php echo get_the_title(); ?></h2>
							</div>
						</div>
	      				<div class="grid-item col-md-9 col-sm-9 col-xs-12  fondotransparente"> 
							<div class="innerbanner width90">
								<h5 class="letranegra"><?php the_content(); ?></h5>
							</div>
						</div>
					<?php }      
	      		}
	      		$x++;
      		endwhile;
	    } ?>
      	<div class="grid-item grid-item--width2 width100 heightbanner75 fondotransparente">
			<div class="innerbanner">
				<h2 class="letranegra">Servicios Dismarca</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5 grid-item--height2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc03.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Entonación</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5 grid-item--height2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc04.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Latonería <br>y<br> pintura</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5 grid-item--height2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc05.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Mecánica <br>Ligera</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5 grid-item--height2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc06.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Carburadores</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5 grid-item--height2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc07.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Instalación <br>de sistemas<br> eléctricos</h2>
			</div>
		</div>
      	<div class="grid-item grid-item--width5 grid-item--height2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc03.jpg" class="right0">
			<div class="innerbanner text-center">
				<h2>Texto</h2>
				<p>Descripcion</p>
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