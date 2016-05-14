<?php get_header(); ?>
<div class="container margintop25">
  <?php get_sidebar(); ?>
  <div class="col-md-9 col-sm-9 col-xs-12">
		<h1>Página no encontrada!</h1>
		<?php print_r($wp_query); ?>
  </div>
</div>
<?php get_footer(); ?>