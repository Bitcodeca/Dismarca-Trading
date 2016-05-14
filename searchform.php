<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="displayinline">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
	<div class="input-group">
	  	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="form-control btn-dismarca" aria-describedby="basic-addon1" placeholder="Busca tu repuesto aquí" />
	  	<span class="input-group-addon" id="basic-addon1">
	  		<button class="btn btn-search letraroja" type="submit" id="searchsubmit"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button>
	  	</span>
	</div>
</form>