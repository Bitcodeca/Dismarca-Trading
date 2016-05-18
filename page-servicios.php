<?php get_header(); ?>
<div class="container margintop25">
  	<div class="">
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
	 		<div class="textoservicios text-center">
	 			<?php
	 				$args=array('post_status' => 'publish', 'post_type'=> 'post', 'order' => 'ASC', 'posts_per_page' => -1, 'category_name' => 'servicios' ); 
					$my_query = new WP_Query($args);
			    	if( $my_query->have_posts() ) { $x=0;
				        while ($my_query->have_posts()) : $my_query->the_post(); $id = get_the_ID(); ?>
				      		<h1 class="letraazul"><?php the_title(); ?></h1>
				      		<h5><?php the_content(); ?></h5>
			      		<?php endwhile;
				    } 
				?>		
	 		</div>
	 	</div>
  	</div>
</div>
<?php get_footer(); ?>