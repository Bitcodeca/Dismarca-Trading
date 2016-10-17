<?php get_header(); ?>
	<script type="text/javascript">
	    jQuery("li.menu-item-24").addClass('active');
	</script>
	<div class="container margintop25">
		<h1 class="fa-3x text-center margin0 paddingtop25"><i class="fa fa-cogs letraroja" aria-hidden="true"></i> Productos</h1>
	  <?php get_sidebar(); ?>
	  <div class="col-md-9 col-sm-9 col-xs-12">
			<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					if (get_post_type()=='articulos') { 
				        $postid = get_the_ID();
                        $codigo = get_the_terms( $post->ID , 'codigo' ); $codigo=$codigo[0]->name;
				        $nombre = get_the_terms( $post->ID , 'nombre' ); $nombre=$nombre[0]->name;
				        $grupo = get_the_terms( $post->ID , 'grupo' ); $grupo=$grupo[0]->name;
				        $existencia = get_the_terms( $post->ID , 'existencia' ); $existencia=$existencia[0]->name;
				        $aplicacion = get_the_terms( $post->ID , 'aplicacion' ); $aplicacion=$aplicacion[0]->name;
				        $datos = get_the_terms( $post->ID , 'datos' ); $datos=$datos[0]->name;
				        $oem = get_the_terms( $post->ID , 'oem' ); $oem=$oem[0]->name;
				        $codalt1 = get_the_terms( $post->ID , 'codalt1' ); $codalt1=$codalt1[0]->name;
				        $codalt2 = get_the_terms( $post->ID , 'codalt2' ); $codalt2=$codalt2[0]->name;
				        $codalt3 = get_the_terms( $post->ID , 'codalt3' ); $codalt3=$codalt3[0]->name;
				        $codalt4 = get_the_terms( $post->ID , 'codalt4' ); $codalt4=$codalt4[0]->name;
				        $procedencia = get_the_terms( $post->ID , 'procedencia' ); $procedencia=$procedencia[0]->name;
				        $condicion = get_the_terms( $post->ID , 'condicion' ); $condicion=$condicion[0]->name;
				        $fob = get_the_terms( $post->ID , 'fob' ); $fob=$fob[0]->name;
				        $especificacion = get_the_terms( $post->ID , 'especificacion' ); $especificacion=$especificacion[0]->name;
				        $factor = get_the_terms( $post->ID , 'factor' ); $factor=$factor[0]->name;
				        $foto1 = get_the_terms( $post->ID , 'foto1' ); $foto1=$foto1[0]->name;
				        $foto2 = get_the_terms( $post->ID , 'foto2' ); $foto2=$foto2[0]->name;
				        $costo = get_the_terms( $post->ID , 'costo' ); $costo=$costo[0]->name;
                          ?>
  			            <a href="#<?php echo $postid; ?>" class="fancybox">
			              <div class="col-md-3 col-sm-3 col-xs-6 height350 overflowhidden">
			                  <img src="<?php echo $foto1; ?>" class="img-responsive">
			                  <h2 class="letranegra"><?php echo get_the_title(); ?></h2>

                                <table style=width:100%>
                                    <tr>
                                        <th><h5 class="letranegra"><?php echo $grupo; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="margin0 letranegra negrita">Código: </h5></th>
                                        <th><h5 class="margin0 letranegra"><?php echo $codigo; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="margin0 letranegra negrita">Marca: </h5></th>
                                        <th><h5 class="margin0 letranegra"><?php echo $marca; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="margin0 letranegra negrita">Aplicación: </h5></th>
                                        <th><h5 class="margin0 letranegra"><?php echo $aplicacion; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="margin0 letranegra negrita">Existencia: </h5></th>
                                        <th><h5 class="margin0 letranegra"><?php echo $existencia; ?></h5></th> 
                                    </tr>
                                </table>
			              </div>
			            </a>
			            <div style="display:none">
			                <div id="<?php echo $postid; ?>" class="popup">
			                  <img src="<?php echo $foto1; ?>" class="img-responsive">
			                  <h2 class="letranegra negrita"><?php echo get_the_title(); ?></h2>

                                <table  class="marginauto">
                                    <tr>
                                        <th><h5 class="letranegra"><?php echo $grupo; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="letranegra negrita">Código: </h5></th>
                                        <th><h5 class="letranegra"><?php echo $codigo; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="letranegra negrita">Marca: </h5></th>
                                        <th><h5 class="letranegra"><?php echo $marca; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="letranegra negrita">Aplicación: </h5></th>
                                        <th><h5 class="letranegra"><?php echo $aplicacion; ?></h5></th> 
                                    </tr>
                                    <tr>
                                        <th><h5 class="letranegra negrita">Existencia: </h5></th>
                                        <th><h5 class="letranegra"><?php echo $existencia; ?></h5></th> 
                                    </tr>
                                </table>
			                </div>
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
						        $postid = get_the_ID();
                                $codigo = get_the_terms( $post->ID , 'codigo' ); $codigo=$codigo[0]->name;
                                $nombre = get_the_terms( $post->ID , 'nombre' ); $nombre=$nombre[0]->name;
                                $grupo = get_the_terms( $post->ID , 'grupo' ); $grupo=$grupo[0]->name;
                                $existencia = get_the_terms( $post->ID , 'existencia' ); $existencia=$existencia[0]->name;
                                $aplicacion = get_the_terms( $post->ID , 'aplicacion' ); $aplicacion=$aplicacion[0]->name;
                                $datos = get_the_terms( $post->ID , 'datos' ); $datos=$datos[0]->name;
                                $oem = get_the_terms( $post->ID , 'oem' ); $oem=$oem[0]->name;
                                $codalt1 = get_the_terms( $post->ID , 'codalt1' ); $codalt1=$codalt1[0]->name;
                                $codalt2 = get_the_terms( $post->ID , 'codalt2' ); $codalt2=$codalt2[0]->name;
                                $codalt3 = get_the_terms( $post->ID , 'codalt3' ); $codalt3=$codalt3[0]->name;
                                $codalt4 = get_the_terms( $post->ID , 'codalt4' ); $codalt4=$codalt4[0]->name;
                                $procedencia = get_the_terms( $post->ID , 'procedencia' ); $procedencia=$procedencia[0]->name;
                                $condicion = get_the_terms( $post->ID , 'condicion' ); $condicion=$condicion[0]->name;
                                $fob = get_the_terms( $post->ID , 'fob' ); $fob=$fob[0]->name;
                                $especificacion = get_the_terms( $post->ID , 'especificacion' ); $especificacion=$especificacion[0]->name;
                                $factor = get_the_terms( $post->ID , 'factor' ); $factor=$factor[0]->name;
                                $foto1 = get_the_terms( $post->ID , 'foto1' ); $foto1=$foto1[0]->name;
                                $foto2 = get_the_terms( $post->ID , 'foto2' ); $foto2=$foto2[0]->name;
                                $costo = get_the_terms( $post->ID , 'costo' ); $costo=$costo[0]->name;
                              ?>
					          	<a href="#<?php echo $postid; ?>" class="fancybox">
					      			<div class="col-md-3 col-sm-3 col-xs-6 height350 overflowhidden">
                                          <img src="<?php echo $foto1; ?>" class="img-responsive">
                                          <h2 class="letranegra"><?php echo get_the_title(); ?></h2>
                                        <table style=width:100%>
                                            <tr>
                                                <th><h5 class="letranegra"><?php echo $grupo; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="letranegra negrita"><?php echo $marca.' '.$modelo.' '.$ano; ?></h5></th>
                                            </tr>
                                            <tr>
                                                <th><h5 class="margin0 letranegra negrita">Código: </h5></th>
                                                <th><h5 class="margin0 letranegra"> <?php echo $codigo; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="margin0 letranegra negrita">Marca: </h5></th>
                                                <th><h5 class="margin0 letranegra"> <?php echo $marca; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="margin0 letranegra negrita">Aplicación: </h5></th>
                                                <th><h5 class="margin0 letranegra"> <?php echo $aplicacion; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="margin0 letranegra negrita">Existencia: </h5></th>
                                                <th><h5 class="margin0 letranegra"> <?php echo $existencia; ?></h5></th> 
                                            </tr>
                                        </table>
						            </div>
						        </a>
					            <div style="display:none">
					                <div class="popup" id="<?php echo $postid; ?>">
                                          <img src="<?php echo $foto1; ?>" class="img-responsive">
                                          <h2 class="letranegra  negrita"><?php echo get_the_title(); ?></h2>
                                        <table class="marginauto">
                                            <tr>
                                                <th><h5 class="letranegra"><?php echo $grupo; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="letranegra negrita"><?php echo $marca.' '.$modelo.' '.$ano; ?></h5></th>
                                            </tr>
                                            <tr>
                                                <th><h5 class="letranegra negrita">Código: </h5></th>
                                                <th><h5 class="letranegra"><?php echo $codigo; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="letranegra negrita">Marca: </h5></th>
                                                <th><h5 class="letranegra"><?php echo $marca; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="letranegra negrita">Aplicación: </h5></th>
                                                <th><h5 class="letranegra"><?php echo $aplicacion; ?></h5></th> 
                                            </tr>
                                            <tr>
                                                <th><h5 class="letranegra negrita">Existencia: </h5></th>
                                                <th><h5 class="letranegra"><?php echo $existencia; ?></h5></th> 
                                            </tr>
                                        </table>
					                </div>
					            </div>
						<?php endwhile; 
					    } 
					} 
				endwhile; ?>
				<?php $numpages = $wp_query->max_num_pages; if(!$numpages) { $numpages = 1; } ?>
				<div class="col-md-12 text-center" id="busqueda">
					<h4> <?php 
						previous_posts_link( '<i class="fa fa-angle-double-left fa-2x" aria-hidden="true"></i>' ); 
						echo "<span class='page-numbers page-num'>Página " . $paged . " de " . $numpages . "</span>";
						next_posts_link( '<i class="fa fa-angle-double-right fa-2x" aria-hidden="true"></i>' );
					?> </h4>
				</div>
			<?php endif; ?>
	  </div>
	</div>
<script>
  jQuery(document).ready(function ($) {
      jQuery('.fancybox').attr('rel', 'media-gallery').fancybox({
          prevEffect: 'none',
          nextEffect: 'none',
          closeBtn: true,
          arrows: true,
          nextClick: false
      });
  });
</script>
<?php get_footer(); ?>