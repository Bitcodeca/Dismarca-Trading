<?php get_header(); ?>
<div class="container">
  	<?php get_sidebar(); ?>
  	<div class="col-md-8 col-sm-8 col-xs-12">
			<?php if( have_posts() ): while( have_posts() ): the_post(); 
                $id = get_the_ID(); ?>
				<div class="row">
                  	<div class="col-md-6">
						<?php the_title('<h2 class="">','</h2>' ); ?>
					</div>
				</div>
			<?php endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>