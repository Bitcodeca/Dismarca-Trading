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
					if (get_post_type()=='articulos') { 
				        $codigoa = get_the_terms( $post->ID , 'codigo' ); $codigo=$codigoa[0]->name;
				        $grupoa = get_the_terms( $post->ID , 'grupo' ); $grupo=$grupoa[0]->name;
				        $existenciaa = get_the_terms( $post->ID , 'existencia' ); $existencia=$existenciaa[0]->name;
				        $aplicacion1a = get_the_terms( $post->ID , 'aplicacion1' ); $aplicacion1=$aplicacion1a[0]->name;
				        $aplicacion2a = get_the_terms( $post->ID , 'aplicacion2' ); $aplicacion2=$aplicacion2a[0]->name;
				        $precioaa = get_the_terms( $post->ID , 'precioa' ); $precioa=$precioaa[0]->name;
				        $precioba = get_the_terms( $post->ID , 'preciob' ); $preciob=$precioba[0]->name;
				        $precioca = get_the_terms( $post->ID , 'precioc' ); $precioc=$precioca[0]->name;
				        $precioda = get_the_terms( $post->ID , 'preciod' ); $preciod=$precioda[0]->name;
				        $codalt1a = get_the_terms( $post->ID , 'codalt1' ); $codalt1=$codalt1a[0]->name;
				        $codalt2a = get_the_terms( $post->ID , 'codalt2' ); $codalt2=$codalt2a[0]->name;
				        $codalt3a = get_the_terms( $post->ID , 'codalt3' ); $codalt3=$codalt3a[0]->name;
				        $codalt4a = get_the_terms( $post->ID , 'codalt4' ); $codalt4=$codalt4a[0]->name;
				        $codalt5a = get_the_terms( $post->ID , 'codalt5' ); $codalt5=$codalt5a[0]->name;
				        $presentaciona = get_the_terms( $post->ID , 'presentacion' ); $presentacion=$presentaciona[0]->name;
				        $procedenciaa = get_the_terms( $post->ID , 'procedencia' ); $procedencia=$procedenciaa[0]->name;
				        $fabricaciona = get_the_terms( $post->ID , 'fabricacion' ); $fabricacion=$fabricaciona[0]->name;
				        $marcaa = get_the_terms( $post->ID , 'marca' ); $marca=$marcaa[0]->name; ?>
		      			<div class="col-md-3 col-sm-3 col-xs-6 height350">
			                <h2 class="letranegra"><?php echo get_the_title(); ?></h2>
			                <?php echo the_post_thumbnail(); ?>
			                <h5 class="letranegra"><?php echo $grupo; ?></h5>
			                <h5 class="letranegra"><?php echo $codigo; ?></h5>
			                <h5 class="letranegra"><?php echo $marca; ?></h5>
			                <h5 class="letranegra">Aplicación: <?php echo $aplicacion1.', '.$aplicacion2; ?></h5>
			                <h5 class="letranegra">Existencia: <?php echo $existencia; ?></h5>
			            </div>
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
					        while ( $issue->have_posts() ) : $issue->the_post();
					          $codigoa = get_the_terms( $post->ID , 'codigo' ); $codigo=$codigoa[0]->name;
					          $grupoa = get_the_terms( $post->ID , 'grupo' ); $grupo=$grupoa[0]->name;
					          $existenciaa = get_the_terms( $post->ID , 'existencia' ); $existencia=$existenciaa[0]->name;
					          $aplicacion1a = get_the_terms( $post->ID , 'aplicacion1' ); $aplicacion1=$aplicacion1a[0]->name;
					          $aplicacion2a = get_the_terms( $post->ID , 'aplicacion2' ); $aplicacion2=$aplicacion2a[0]->name;
					          $precioaa = get_the_terms( $post->ID , 'precioa' ); $precioa=$precioaa[0]->name;
					          $precioba = get_the_terms( $post->ID , 'preciob' ); $preciob=$precioba[0]->name;
					          $precioca = get_the_terms( $post->ID , 'precioc' ); $precioc=$precioca[0]->name;
					          $precioda = get_the_terms( $post->ID , 'preciod' ); $preciod=$precioda[0]->name;
					          $codalt1a = get_the_terms( $post->ID , 'codalt1' ); $codalt1=$codalt1a[0]->name;
					          $codalt2a = get_the_terms( $post->ID , 'codalt2' ); $codalt2=$codalt2a[0]->name;
					          $codalt3a = get_the_terms( $post->ID , 'codalt3' ); $codalt3=$codalt3a[0]->name;
					          $codalt4a = get_the_terms( $post->ID , 'codalt4' ); $codalt4=$codalt4a[0]->name;
					          $codalt5a = get_the_terms( $post->ID , 'codalt5' ); $codalt5=$codalt5a[0]->name;
					          $presentaciona = get_the_terms( $post->ID , 'presentacion' ); $presentacion=$presentaciona[0]->name;
					          $procedenciaa = get_the_terms( $post->ID , 'procedencia' ); $procedencia=$procedenciaa[0]->name;
					          $fabricaciona = get_the_terms( $post->ID , 'fabricacion' ); $fabricacion=$fabricaciona[0]->name;
					          $marcaa = get_the_terms( $post->ID , 'marca' ); $marca=$marcaa[0]->name; ?>
				      			<div class="col-md-3 col-sm-3 col-xs-6 height350">
					                <h2 class="letranegra"><?php echo get_the_title(); ?></h2>
					                <?php echo the_post_thumbnail(); ?>
					                <h5 class="letranegra"><?php echo $grupo; ?></h5>
					                <h5 class="letranegra"><?php echo $codigo; ?></h5>
					                <h5 class="letranegra"><?php echo $marca; ?></h5>
					                <h5 class="letranegra">Aplicación: <?php echo $aplicacion1.', '.$aplicacion2; ?></h5>
					                <h5 class="letranegra">Existencia: <?php echo $existencia; ?></h5>
					            </div>
						<?php endwhile; 
					    } 
					} 
				endwhile; ?>
		        <div class="clearfix"></div>
		        <?php
				$numpages = $wp_query->max_num_pages; if(!$numpages) { $numpages = 1; }
				 echo "<span class='page-numbers page-num'>Página " . $paged . " de " . $numpages . "</span> "; ?>

				<h4 class="pull-left"><?php previous_posts_link( '<<' ); ?></h4>
				<h4 class="pull-right"><?php next_posts_link( '>>' ); ?></h4>
			<?php endif; ?>
	  </div>
	</div>
<?php get_footer(); ?>