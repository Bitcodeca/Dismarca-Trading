<div class="col-md-3 col-sm-3 col-xs-12">
	<div class="xsmargin25">
		<?php get_search_form(); ?>
	</div>
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop10">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
		<div class="titulosidebar">
			<h3 class="margin0 letra2">Filtrar por modelo</h3>
		</div>
		<div class="margintop15">
			<select class="btn sidebar-option letra2" id="marca" name="marca">
				<option value="" hidden>Marca</option>
				<?php $marca = get_terms( 'marca', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
				foreach ($marca as $i) {
				 	echo '<option value="'.$i->slug.'">'.$i->name.'</option>';
				 } ?>
			</select>
			<select class="btn sidebar-option letra2" id="modelo" name="modelo">
				<option value="" hidden>Modelo</option>
				<?php $modelo = get_terms( 'modelo', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
				foreach ($modelo as $i) {
				 	echo '<option value="'.$i->slug.'">'.$i->name.'</option>';
				 } ?>
			</select>
			<select class="btn sidebar-option letra2" id="año" name="año">
				<option value="" hidden>Año</option>
				<?php for ($i = 2016; $i >1970 ; $i--) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				} ?>
			</select>
			<select class="btn sidebar-option letra2" id="grupo" name="grupo">
				<option value="" hidden>Grupo</option>
				<?php $grupo = get_terms( 'grupo', array( 'orderby' => 'name', 'hide_empty' => 1 ) );
				foreach ($grupo as $i) {
				 	echo '<option value="'.$i->slug.'">'.$i->name.'</option>';
				 } ?>
			</select>
		</div>
		<button class="btn btn-buscar fondorojo margintop10" type="submit" name="filtrar" id="filtrar">Buscar</button>
	</form>
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop25">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
		<div class="titulosidebar">
			<h3 class="margin0 letra2">Filtrar por Categoría</h3>
		</div>
		<div class="categoriassidebar">
            <?php $args=array('post_status' => 'publish', 'post_type'=> 'grupos', 'order' => 'ASC', 'posts_per_page' => -1 ); 
            $my_query = new WP_Query($args);
            if( $my_query->have_posts() ) {
                while ($my_query->have_posts()) : $my_query->the_post();
                    $id = get_the_ID();
                    $subgrupo = get_the_terms( $post->ID , 'subgrupo' ); ?>
                    <div class="btn-group">
                        <button class="btn btn-footer displayblock" type="submit" name="s" id="s" value="<?php the_title_attribute(); ?>">
                            <h4 class="letra2"><?php echo get_the_title(); ?></h4>
                        </button>
                        <button type="button" class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>

                        <ul class="dropdown-menu">
                            <?php foreach($subgrupo as $sg){ 
                                    $nombre=$sg->name; ?>
                                    <li><a href="http://dismarca.com/?s=<?php echo $nombre; ?>"><?php echo $nombre; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
            <br>
                <?php endwhile;
            } ?>
            
			
		</div>
	</form>

</div>
<script>
	jQuery('input[type="checkbox"]').on('change', function() {
	    jQuery('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
</script>