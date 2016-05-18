<?php  get_header(); ?>
<div class="container margintop25">
  <?php get_sidebar(); ?>
  <div class="col-md-9 col-sm-9 col-xs-12">
      <?php 
        global $wp_query, $paged;
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $custom_args = array( 'post_type' => 'articulos', 'posts_per_page' => 12, 'paged' => $paged );
        $custom_query = new WP_Query( $custom_args );
        if ( $custom_query->have_posts() ) : 
          while ( $custom_query->have_posts() ) : $custom_query->the_post();
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
          $marcaa = get_the_terms( $post->ID , 'marca' ); $marca=$marcaa[0]->name;
          ?>
            <div class="col-md-3 col-sm-3 col-xs-6 height350">
                <h2 class="letranegra"><?php echo get_the_title(); ?></h2>
                <?php echo the_post_thumbnail(); ?>
                <h5 class="letranegra"><?php echo $grupo; ?></h5>
                <h5 class="letranegra"><?php echo $codigo; ?></h5>
                <h5 class="letranegra"><?php echo $marca; ?></h5>
                <h5 class="letranegra">Aplicación: <?php echo $aplicacion1.', '.$aplicacion2; ?></h5>
                <h5 class="letranegra">Existencia: <?php echo $existencia; ?></h5>
            </div>
          <?php endwhile; ?>
          <div class="clearfix"></div>
          <?php if (function_exists('custom_pagination')) { custom_pagination($custom_query->max_num_pages,"",$paged); } 
          wp_reset_postdata();
         endif; ?>
  </div>
</div>
<?php get_footer(); ?>