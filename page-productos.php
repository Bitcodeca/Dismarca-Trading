<?php
/**
 * Template Name: Productos
 * page-productos.php
 */
 get_header(); ?>
<div class="container margintop25">
  <?php get_sidebar(); ?>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <?php 
      global $wp_query, $paged;
      $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
      $custom_args = array( 'post_type' => 'articulos', 'posts_per_page' => 12, 'paged' => $paged );
      $custom_query = new WP_Query( $custom_args );
      if ( $custom_query->have_posts() ) : 
        while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
          <h3>
              <?php the_title(); ?>
          </h3>
        <?php endwhile;
        if (function_exists('custom_pagination')) { custom_pagination($custom_query->max_num_pages,"",$paged); } 
        wp_reset_postdata();
       endif; ?>
  </div>
</div>
<?php get_footer(); ?>