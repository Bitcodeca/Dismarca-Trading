<?php
/**
 * Template Name: Productos
 * page-productos.php
 */
 get_header(); ?>
<div class="container margintop25">
  <h1 class="fa-3x text-center margin0 paddingtop25"><i class="fa fa-cogs letraroja" aria-hidden="true"></i> Productos</h1>
  <?php get_sidebar(); ?>
  <div class="col-md-9 col-sm-9 col-xs-12">
      <?php 
        $grupo = get_terms( 'grupo', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
        foreach ($grupo as $i) {
      ?>
        <a href="<?php echo bloginfo('url').'/?s='.$i->slug; ?>">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="paddingproducto height250">
                    <div class="fondoazul productoinner">
                        <h2 class="letrablanca text-center"><?php echo $i->name ?></h2>
                    </div>
                </div>
            </div>
        </a>
        <?php } ?>
      

        <div class="clearfix"></div>
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