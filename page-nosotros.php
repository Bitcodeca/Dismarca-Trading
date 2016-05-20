<?php get_header(); ?>
<div class="container margintop25">
<h1 class="fa-3x text-center margin0 paddingtop25"><i class="fa fa-certificate letraroja" aria-hidden="true"></i> Conócenos</h1>
  <div class="margintop25">
	<div class="grid">
      	<div class="grid-sizer"></div>
      	<div class="grid-item grid-item--width2">
      		<div class="overlay"></div>
			<img src="<?php echo get_bloginfo('template_directory');?>/img/dsmc01.jpg" class="right0">
			<div class="innerbanner width90 text-center">
				<h2><i class="fa fa-quote-left fa-lg fa-border"></i>El entusiasmo es lo que hace que la esperanza brille como las estrellas<br><small class="pull-right letrablanca">Henry Ford</small></h2>
			</div>
		</div>
      	<div class="minheight550 minheight350 grid-item col-md-9 col-sm-9 col-xs-12 fondotransparente">
				<div class="innerbanner width90">
					<h2 class="letraazul">Nuestra Historia</h2>
					<p class="letraazul">Establecida en 1990, Dismarca C.A es una de las tiendas más importantes en cuanto a la venta y distribución de repuestos para vehículos en Venezuela. Nuestro catálogo se extiende a cientos de repuestos creados por los mejores fabricantes del mercado doméstico e internacional.</p>
					<p class="letraazul">Comprar en Dismarca les garantiza a nuestros clientes obtener los mejores precios, incluyendo garantía por buen funcionamiento y flexibilidad en el método de pago del producto.
					La satisfacción del cliente es muy importante para nosotros, por eso no solo buscamos ofrecer los precios del mercado, si no encargarnos de entregar nuestros productos lo más rápido a nuestros consumidores teniendo alcance a nivel nacional.
					</p>
				</div>
		</div>
      	<div class="minheight350 grid-item col-md-3 col-sm-3 col-xs-12 fondorojo">
				<div class="innerbanner width90 text-center">
					<h2 class="letrablanca">¿Qué Hacemos?</h2>
					<p class="letrablanca">•	Entonación</p>
					<p class="letrablanca">•	Latonería y Pintura</p>
					<p class="letrablanca">•	Mecánica Ligera</p>
					<p class="letrablanca">•	Instalación, Reparación y Adaptación de Carburadores</p>
					<p class="letrablanca">•	Enderezado de Compacto y Chasis</p>
					<p class="letrablanca">•	Instalación y reparación de sistemas eléctricos</p>
				</div>
		</div>
		<?php $args=array('post_status' => 'publish', 'post_type'=> 'post', 'order' => 'ASC', 'posts_per_page' => -1, 'category_name' => 'nosotros' ); 
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
						<h2><?php echo get_the_title(); ?></h2>
						<h3><?php the_content(); ?></h3>
					</div>
				</div>
	      		<?php } elseif ($tamano==2) { ?>
          		<div class="grid-item grid-item--width6 gridzoom">
	      			<div class="overlay"></div>
					 	<?php echo the_post_thumbnail(); ?> 
					<div class="innerbanner">
						<h2><?php echo get_the_title(); ?></h2>
						<h3><?php the_content(); ?></h3>
					</div>
				</div>
	      		<?php } elseif ($tamano==3) { ?>
          		<div class="grid-item grid-item--width2">
	      			<div class="overlay"></div>
					 	<?php echo the_post_thumbnail(); ?> 
					<div class="innerbanner width90">
						<h2><?php echo get_the_title(); ?></h2>
						<h3><?php the_content(); ?></h3>
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