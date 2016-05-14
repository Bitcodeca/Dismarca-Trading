<div class="col-md-3 col-sm-3 col-xs-12">
	<?php get_search_form(); ?>
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop10">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
		<div class="titulosidebar">
			<h3 class="margin0 letra2">Selecciona tu vehículo</h3>
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
		</div>
		<button class="btn btn-buscar fondorojo margintop10" type="submit" name="filtrar" id="filtrar">Buscar</button>
	</form>
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="margintop25">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
		<div class="titulosidebar">
			<h3 class="margin0 letra2">Categorías</h3>
		</div>
		<div class="categoriassidebar">
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Carburadores y sus Partes">
				<h4 class="letra2">Carburadores y sus Partes</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Partes eléctricas">
				<h4 class="letra2">Partes Eléctricas</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s"  value="Fuel Injection">
				<h4 class="letra2">Fuel Injection</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Sensores">
				<h4 class="letra2">Sensores</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Kit de Tiempo y Entonación">
				<h4 class="letra2">Kit de Tiempo y Entonación</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Aire Acondicionado">
				<h4 class="letra2">Aire Acondicionado</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Carrocería">
				<h4 class="letra2">Carrocería</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Suspensión">
				<h4 class="letra2">Suspensión</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Tren Delantero">
				<h4 class="letra2">Tren Delantero</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Frenos">
				<h4 class="letra2">Frenos</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Rodamiento">
				<h4 class="letra2">Rodamiento</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Accesorios">
				<h4 class="letra2">Accesorios</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Correas y Mangueras">
				<h4 class="letra2">Correas y Mangueras</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Transmisión">
				<h4 class="letra2">Transmisión</h4>
			</button>
			<button class="btn btn-search displayblock" type="submit" name="s" id="s" value="Otros">
				<h4 class="letra2">Otros</h4>
			</button>
		</div>
	</form>

</div>
<script>
	jQuery('input[type="checkbox"]').on('change', function() {
	    jQuery('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
</script>