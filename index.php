<?php get_header(); ?>
	<script type="text/javascript">
	    jQuery("li.menu-item-19").addClass('active');
	</script>
	<div class="container margintop25">
	  <?php get_sidebar(); ?>
	  <div class="col-md-9 col-sm-9 col-xs-12">
			<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					if (get_post_type()=='articulos') {?>
				      	<h3>
			              	<?php the_title(); ?>
			          	</h3>
					<?php }

					elseif (get_post_type()=='aplicacion') {
						$titulo=get_the_title();
				      	$codigoarray = get_the_terms( $post->ID , 'codigo' ); $codigo=$codigoarray[0]->name;
				      	$marcaarray = get_the_terms( $post->ID , 'marca' ); $marca=$marcaarray[0]->name;
				      	$modeloarray = get_the_terms( $post->ID , 'modelo' ); $modelo=$modeloarray[0]->name;
				      	$anoarray = get_the_terms( $post->ID , 'año' ); $ano=$anoarray[0]->name;
				      	$motorarray = get_the_terms( $post->ID , 'motor' ); $motor=$motorarray[0]->name;
				      	$cilindrosarray = get_the_terms( $post->ID , 'cilindros' ); $cilindros=$cilindrosarray[0]->name;
				      	$cajaarray = get_the_terms( $post->ID , 'caja' ); $caja=$cajaarray[0]->name;
				      	$transmisionarray = get_the_terms( $post->ID , 'transmision' ); $transmision=$transmisionarray[0]->name;
				      	$estiloarray = get_the_terms( $post->ID , 'estilo' ); $estilo=$estiloarray[0]->name;

				      	$arg=array('post_status'=>'publish', 'post_type'=>'articulos', 'tax_query'=> array('relation' => 'OR', 
				      		array('taxonomy'=>'codigo', 'field'=>'slug', 'terms'=>$codigo, 'operator' => 'IN'), 
				      		array('taxonomy'=>'codalt1', 'field'=>'slug', 'terms'=>$codigo, 'operator' => 'IN'), 
				      		array('taxonomy'=>'codalt2', 'field'=>'slug', 'terms'=>$codigo, 'operator' => 'IN'), 
				      		array('taxonomy'=>'codalt3', 'field'=>'slug', 'terms'=>$codigo, 'operator' => 'IN'), 
				      		array('taxonomy'=>'codalt4', 'field'=>'slug', 'terms'=>$codigo, 'operator' => 'IN'), 
				      		array('taxonomy'=>'codalt5', 'field'=>'slug', 'terms'=>$codigo, 'operator' => 'IN')
				      	) );
					    $issue = new WP_Query( $arg );
					    if ( $issue->have_posts() ) {
					        while ( $issue->have_posts() ) : $issue->the_post(); ?>
				      			<h3>
					              	<?php the_title(); ?>
					          	</h3>
						<?php endwhile; 
					    } 
					} 
				endwhile;
				$numpages = $wp_query->max_num_pages; if(!$numpages) { $numpages = 1; }
				 echo "<span class='page-numbers page-num'>Página " . $paged . " de " . $numpages . "</span> "; ?>

				<h4 class="pull-left"><?php previous_posts_link( '<<' ); ?></h4>
				<h4 class="pull-right"><?php next_posts_link( '>>' ); ?></h4>
			<?php endif; ?>
	  </div>
	</div>
<?php get_footer(); ?>