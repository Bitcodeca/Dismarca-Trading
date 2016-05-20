<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function dismarca_script_enqueue() {
	//css
     wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', array(), '3.3.4', 'all');
     wp_enqueue_style('fancyboxcss', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css', array(), '1.0.0', 'all');
     wp_enqueue_style('fancyboxthumbnailcss', get_template_directory_uri() . '/css/jquery.fancybox-thumbs.css', array(), '1.0.0', 'all');
     wp_enqueue_style('fancyboxbuttonscss', get_template_directory_uri() . '/css/jquery.fancybox-buttons.css', array(), '1.0.0', 'all');
     wp_enqueue_style('font awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '1.0.0', 'all');
     wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0.0', 'all');
     wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css', array(), '1.0.0', 'all');
     wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), '2.0.0', 'all');
	
    //js
    wp_enqueue_script('jquery', 'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1.0.0', true);
    wp_enqueue_script('bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array(), '3.3.4', true);
    wp_enqueue_script('wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), '1.0.0', true);
    wp_enqueue_script('imagesloaded', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js', array(), '3.3.4', true);
    wp_enqueue_script('isotope', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.0/isotope.pkgd.min.js', array(), '3.3.4', true);
    wp_enqueue_script('fancyboxjs', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js', array(), '1.0.0', true);
    wp_enqueue_script('fancybox2js', get_template_directory_uri() . '/js/jquery.fancybox-thumbs.js', array(), '1.0.0', true);
    wp_enqueue_script('fancybox3js', get_template_directory_uri() . '/js/jquery.fancybox-media.js', array(), '1.0.0', true);
    wp_enqueue_script('fancybox4js', get_template_directory_uri() . '/js/jquery.fancybox-buttons.js', array(), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'dismarca_script_enqueue');

add_theme_support('post-thumbnails');

function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

/////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////// ACTIVATE MENUS //////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
function menunavbar() {
	add_theme_support('menus');
	register_nav_menu('principal', 'Principal');
	}
add_action('init', 'menunavbar');

///////////////////////////////////////////////////////////////////////////////
/////////////// Borrar Tag Taxonomy //////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'my_register_post_tags' );
function my_register_post_tags() { register_taxonomy( 'post_tag', array( 'my_post_type_here' ) ); }

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////// PAGINACION ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function custom_pagination($numpages = '', $pagerange = '', $paged='') {
  if (empty($pagerange)) { $pagerange = 2; }
  global $paged;
  if (empty($paged)) { $paged = 1; }
  if ($numpages == '') { global $wp_query; $numpages = $wp_query->max_num_pages; if(!$numpages) { $numpages = 1; } }
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<i class="fa fa-angle-double-left fa-2x" aria-hidden="true"></i>'),
    'next_text'       => __('<i class="fa fa-angle-double-right fa-2x" aria-hidden="true"></i>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );
  $paginate_links = paginate_links($pagination_args);
  if ($paginate_links) {
    echo "<nav class='custom-pagination text-center'>";
      echo "<h4 class='page-numbers page-num'>Página " . $paged . " de " . $numpages . "</h4> ";
      echo "<h4 class='text-center'>".$paginate_links."</h4>";
    echo "</nav>";
  }
}

/*add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
  if($post_type)
      $post_type = $post_type;
  else
      $post_type = array('post','articulos','aplicacion');
      $query->set('post_type',$post_type);
  return $query;
    }
}*/
add_filter('post_limits', 'postsperpage');
function postsperpage($limits) {
  if (is_search()) {
    global $wp_query;
    $wp_query->query_vars['posts_per_page'] = 12;
  }
  return $limits;
}

add_filter('query_vars', 'introduce_qvs');
function introduce_qvs($qv) {
    $qv[] = 'marca';
    $qv[] = 'modelo';
    $qv[] = 'año';
    return $qv;
}

add_filter('relevanssi_modify_wp_query', 'movie_tax_query');
function movie_tax_query($query) {
    $tax_query = array();
    if (!empty($query->query_vars['marca'])) {
        $tax_query[] = array(
            'taxonomy' => 'marca',
            'field' => 'slug',
            'terms' => $query->query_vars['marca']
        );
    }
    if (!empty($query->query_vars['modelo'])) {
        $tax_query[] = array(
            'taxonomy' => 'modelo',
            'field' => 'slug',
            'terms' => $query->query_vars['modelo']
        );
    }
    if (!empty($query->query_vars['año'])) {
        $tax_query[] = array(
            'taxonomy' => 'año',
            'field' => 'slug',
            'terms' => $query->query_vars['año']
        );
    }
    if (!empty($tax_query)) {
        $tax_query['relation'] = 'AND'; // you can also use 'OR' here
        $query->set('tax_query', $tax_query);
    }
    return $query;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA TAMANO ///////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'tamaño_taxonomy', 0 );
function tamaño_taxonomy() {
  $labels = array(
    'name' => _x( 'tamaño', 'taxonomy general name' ),
    'singular_name' => _x( 'tamaño', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar tamaño' ),
    'popular_items' => __( 'tamaño frecuentes' ),
    'all_items' => __( 'Todos los tamaño' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar tamaño' ), 
    'update_item' => __( 'Actualizar tamaño' ),
    'add_new_item' => __( 'Agregar nuevo tamaño' ),
    'new_item_name' => __( 'Cantidad de nuevo tamaño' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar tamaño' ),
    'choose_from_most_used' => __( 'Escoger de los tamaños utilizados' ),
    'menu_name' => __( 'tamaño' ),
  ); 
  register_taxonomy('tamaño','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tamaño' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA CODIGO ///////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'codigo_taxonomy', 0 );
function codigo_taxonomy() {
  $labels = array(
    'name' => _x( 'codigo', 'taxonomy general name' ),
    'singular_name' => _x( 'codigo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar codigo' ),
    'popular_items' => __( 'codigo frecuentes' ),
    'all_items' => __( 'Todos los codigo' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar codigo' ), 
    'update_item' => __( 'Actualizar codigo' ),
    'add_new_item' => __( 'Agregar nuevo codigo' ),
    'new_item_name' => __( 'Cantidad de nuevo codigo' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar codigo' ),
    'choose_from_most_used' => __( 'Escoger de los codigos utilizados' ),
    'menu_name' => __( 'codigo' ),
  ); 
  register_taxonomy('codigo','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codigo' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA GRUPO ///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'grupo_taxonomy', 0 );
function grupo_taxonomy() {
  $labels = array(
    'name' => _x( 'grupo', 'taxonomy general name' ),
    'singular_name' => _x( 'grupo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar grupo' ),
    'popular_items' => __( 'grupo frecuentes' ),
    'all_items' => __( 'Todos los grupo' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar grupo' ), 
    'update_item' => __( 'Actualizar grupo' ),
    'add_new_item' => __( 'Agregar nueva grupo' ),
    'new_item_name' => __( 'Cantidad de nuevo grupo' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar grupo' ),
    'choose_from_most_used' => __( 'Escoger de los grupo utilizados' ),
    'menu_name' => __( 'grupo' ),
  ); 
  register_taxonomy('grupo','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'grupo' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA EXISTENCIA ///////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'existencia_taxonomy', 0 );
function existencia_taxonomy() {
  $labels = array(
    'name' => _x( 'existencia', 'taxonomy general name' ),
    'singular_name' => _x( 'existencia', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar existencia' ),
    'popular_items' => __( 'existencia frecuentes' ),
    'all_items' => __( 'Todos los existencia' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar existencia' ), 
    'update_item' => __( 'Actualizar existencia' ),
    'add_new_item' => __( 'Agregar nueva existencia' ),
    'new_item_name' => __( 'Cantidad de nuevo existencia' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar existencia' ),
    'choose_from_most_used' => __( 'Escoger de los existencia utilizados' ),
    'menu_name' => __( 'existencia' ),
  ); 
  register_taxonomy('existencia','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'existencia' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA APLICACION 1 ///////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'aplicacion1_taxonomy', 0 );
function aplicacion1_taxonomy() {
  $labels = array(
    'name' => _x( 'aplicacion1', 'taxonomy general name' ),
    'singular_name' => _x( 'aplicacion1', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar aplicacion1' ),
    'popular_items' => __( 'aplicacion1 frecuentes' ),
    'all_items' => __( 'Todos los aplicacion1' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar aplicacion1' ), 
    'update_item' => __( 'Actualizar aplicacion1' ),
    'add_new_item' => __( 'Agregar nueva aplicacion1' ),
    'new_item_name' => __( 'Cantidad de nuevo aplicacion1' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar aplicacion1' ),
    'choose_from_most_used' => __( 'Escoger de los aplicacion1 utilizados' ),
    'menu_name' => __( 'aplicacion1' ),
  ); 
  register_taxonomy('aplicacion1','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'aplicacion1' ),
  ));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA APLICACION 2 ///////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'aplicacion2_taxonomy', 0 );
function aplicacion2_taxonomy() {
  $labels = array(
    'name' => _x( 'aplicacion2', 'taxonomy general name' ),
    'singular_name' => _x( 'aplicacion2', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar aplicacion2' ),
    'popular_items' => __( 'aplicacion2 frecuentes' ),
    'all_items' => __( 'Todos los aplicacion2' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar aplicacion2' ), 
    'update_item' => __( 'Actualizar aplicacion2' ),
    'add_new_item' => __( 'Agregar nueva aplicacion2' ),
    'new_item_name' => __( 'Cantidad de nuevo aplicacion2' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar aplicacion2' ),
    'choose_from_most_used' => __( 'Escoger de los aplicacion2 utilizados' ),
    'menu_name' => __( 'aplicacion2' ),
  ); 
  register_taxonomy('aplicacion2','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'aplicacion2' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PRECIOA ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'precioa_taxonomy', 0 );
function precioa_taxonomy() {
  $labels = array(
    'name' => _x( 'precioa', 'taxonomy general name' ),
    'singular_name' => _x( 'precioa', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar precioa' ),
    'popular_items' => __( 'precioa frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar precioa' ), 
    'update_item' => __( 'Actualizar precioa' ),
    'add_new_item' => __( 'Agregar nuevo precioa' ),
    'new_item_name' => __( 'Cantidad de nuevo precioa' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar precioa' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'precioa' ),
  ); 
  register_taxonomy('precioa','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'precioa' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PRECIOB ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'preciob_taxonomy', 0 );
function preciob_taxonomy() {
  $labels = array(
    'name' => _x( 'preciob', 'taxonomy general name' ),
    'singular_name' => _x( 'preciob', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar preciob' ),
    'popular_items' => __( 'preciob frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar preciob' ), 
    'update_item' => __( 'Actualizar preciob' ),
    'add_new_item' => __( 'Agregar nuevo preciob' ),
    'new_item_name' => __( 'Cantidad de nuevo preciob' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar preciob' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'preciob' ),
  ); 
  register_taxonomy('preciob','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'preciob' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PRECIOC ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'precioc_taxonomy', 0 );
function precioc_taxonomy() {
  $labels = array(
    'name' => _x( 'precioc', 'taxonomy general name' ),
    'singular_name' => _x( 'precioc', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar precioc' ),
    'popular_items' => __( 'precioc frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar precioc' ), 
    'update_item' => __( 'Actualizar precioc' ),
    'add_new_item' => __( 'Agregar nuevo precioc' ),
    'new_item_name' => __( 'Cantidad de nuevo precioc' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar precioc' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'precioc' ),
  ); 
  register_taxonomy('precioc','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'precioc' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PRECIOD ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'preciod_taxonomy', 0 );
function preciod_taxonomy() {
  $labels = array(
    'name' => _x( 'preciod', 'taxonomy general name' ),
    'singular_name' => _x( 'preciod', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar preciod' ),
    'popular_items' => __( 'preciod frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar preciod' ), 
    'update_item' => __( 'Actualizar preciod' ),
    'add_new_item' => __( 'Agregar nuevo preciod' ),
    'new_item_name' => __( 'Cantidad de nuevo preciod' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar preciod' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'preciod' ),
  ); 
  register_taxonomy('preciod','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'preciod' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA CODALT1 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'codalt1_taxonomy', 0 );
function codalt1_taxonomy() {
  $labels = array(
    'name' => _x( 'codalt1', 'taxonomy general name' ),
    'singular_name' => _x( 'codalt1', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar codalt1' ),
    'popular_items' => __( 'codalt1 frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar codalt1' ), 
    'update_item' => __( 'Actualizar codalt1' ),
    'add_new_item' => __( 'Agregar nuevo codalt1' ),
    'new_item_name' => __( 'Cantidad de nuevo codalt1' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar codalt1' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'codalt1' ),
  ); 
  register_taxonomy('codalt1','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codalt1' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA CODALT2 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'codalt2_taxonomy', 0 );
function codalt2_taxonomy() {
  $labels = array(
    'name' => _x( 'codalt2', 'taxonomy general name' ),
    'singular_name' => _x( 'codalt2', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar codalt2' ),
    'popular_items' => __( 'codalt2 frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar codalt2' ), 
    'update_item' => __( 'Actualizar codalt2' ),
    'add_new_item' => __( 'Agregar nuevo codalt2' ),
    'new_item_name' => __( 'Cantidad de nuevo codalt2' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar codalt2' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'codalt2' ),
  ); 
  register_taxonomy('codalt2','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codalt2' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA CODALT3 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'codalt3_taxonomy', 0 );
function codalt3_taxonomy() {
  $labels = array(
    'name' => _x( 'codalt3', 'taxonomy general name' ),
    'singular_name' => _x( 'codalt3', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar codalt3' ),
    'popular_items' => __( 'codalt3 frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar codalt3' ), 
    'update_item' => __( 'Actualizar codalt3' ),
    'add_new_item' => __( 'Agregar nuevo codalt3' ),
    'new_item_name' => __( 'Cantidad de nuevo codalt3' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar codalt3' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'codalt3' ),
  ); 
  register_taxonomy('codalt3','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codalt3' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA CODALT4 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'codalt4_taxonomy', 0 );
function codalt4_taxonomy() {
  $labels = array(
    'name' => _x( 'codalt4', 'taxonomy general name' ),
    'singular_name' => _x( 'codalt4', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar codalt4' ),
    'popular_items' => __( 'codalt4 frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar codalt4' ), 
    'update_item' => __( 'Actualizar codalt4' ),
    'add_new_item' => __( 'Agregar nuevo codalt4' ),
    'new_item_name' => __( 'Cantidad de nuevo codalt4' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar codalt4' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'codalt4' ),
  ); 
  register_taxonomy('codalt4','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codalt4' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA CODALT5 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'codalt5_taxonomy', 0 );
function codalt5_taxonomy() {
  $labels = array(
    'name' => _x( 'codalt5', 'taxonomy general name' ),
    'singular_name' => _x( 'codalt5', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar codalt5' ),
    'popular_items' => __( 'codalt5 frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar codalt5' ), 
    'update_item' => __( 'Actualizar codalt5' ),
    'add_new_item' => __( 'Agregar nuevo codalt5' ),
    'new_item_name' => __( 'Cantidad de nuevo codalt5' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar codalt5' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'codalt5' ),
  ); 
  register_taxonomy('codalt5','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codalt5' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PRESENTACION ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'presentacion_taxonomy', 0 );
function presentacion_taxonomy() {
  $labels = array(
    'name' => _x( 'presentacion', 'taxonomy general name' ),
    'singular_name' => _x( 'presentacion', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar presentacion' ),
    'popular_items' => __( 'presentacion frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar presentacion' ), 
    'update_item' => __( 'Actualizar presentacion' ),
    'add_new_item' => __( 'Agregar nuevo presentacion' ),
    'new_item_name' => __( 'Cantidad de nuevo presentacion' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar presentacion' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'presentacion' ),
  ); 
  register_taxonomy('presentacion','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'presentacion' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PROCEDENCIA ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'procedencia_taxonomy', 0 );
function procedencia_taxonomy() {
  $labels = array(
    'name' => _x( 'procedencia', 'taxonomy general name' ),
    'singular_name' => _x( 'procedencia', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar procedencia' ),
    'popular_items' => __( 'procedencia frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar procedencia' ), 
    'update_item' => __( 'Actualizar procedencia' ),
    'add_new_item' => __( 'Agregar nuevo procedencia' ),
    'new_item_name' => __( 'Cantidad de nuevo procedencia' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar procedencia' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'procedencia' ),
  ); 
  register_taxonomy('procedencia','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'procedencia' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA FABRICACION ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'fabricacion_taxonomy', 0 );
function fabricacion_taxonomy() {
  $labels = array(
    'name' => _x( 'fabricacion', 'taxonomy general name' ),
    'singular_name' => _x( 'fabricacion', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar fabricacion' ),
    'popular_items' => __( 'fabricacion frecuentes' ),
    'all_items' => __( 'Todas los Costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar fabricacion' ), 
    'update_item' => __( 'Actualizar fabricacion' ),
    'add_new_item' => __( 'Agregar nuevo fabricacion' ),
    'new_item_name' => __( 'Cantidad de nuevo fabricacion' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar fabricacion' ),
    'choose_from_most_used' => __( 'Escoger de los cosotos utilizados' ),
    'menu_name' => __( 'fabricacion' ),
  ); 
  register_taxonomy('fabricacion','productos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'fabricacion' ),
  ));
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////// TAXONOMIA MARCA ///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'marca_taxonomy', 0 );
function marca_taxonomy() {
  $labels = array(
    'name' => _x( 'marca', 'taxonomy general name' ),
    'singular_name' => _x( 'marca', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar marca' ),
    'popular_items' => __( 'marca frecuentes' ),
    'all_items' => __( 'Todos los marca' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar marca' ), 
    'update_item' => __( 'Actualizar marca' ),
    'add_new_item' => __( 'Agregar nueva marca' ),
    'new_item_name' => __( 'Cantidad de nuevo marca' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar marca' ),
    'choose_from_most_used' => __( 'Escoger de las marca utilizados' ),
    'menu_name' => __( 'marca' ),
  ); 
  register_taxonomy('marca','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'marca' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// TAXONOMIA MODELO //////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'modelo_taxonomy', 0 );
function modelo_taxonomy() {
  $labels = array(
    'name' => _x( 'modelo', 'taxonomy general name' ),
    'singular_name' => _x( 'modelo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar modelo' ),
    'popular_items' => __( 'modelo frecuentes' ),
    'all_items' => __( 'Todos los modelo' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar modelo' ), 
    'update_item' => __( 'Actualizar modelo' ),
    'add_new_item' => __( 'Agregar nueva modelo' ),
    'new_item_name' => __( 'Cantidad de nuevo modelo' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar modelo' ),
    'choose_from_most_used' => __( 'Escoger de los modelo utilizados' ),
    'menu_name' => __( 'modelo' ),
  ); 
  register_taxonomy('modelo','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'modelo' ),
  ));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA AÑO //////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'ano_taxonomy', 0 );
function ano_taxonomy() {
  $labels = array(
    'name' => _x( 'año', 'taxonomy general name' ),
    'singular_name' => _x( 'año', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar año' ),
    'popular_items' => __( 'año frecuentes' ),
    'all_items' => __( 'Todos los años' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar año' ), 
    'update_item' => __( 'Actualizar año' ),
    'add_new_item' => __( 'Agregar nueva año' ),
    'new_item_name' => __( 'Cantidad de nuevo año' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar años' ),
    'choose_from_most_used' => __( 'Escoger de los año utilizados' ),
    'menu_name' => __( 'año' ),
  ); 
  register_taxonomy('año','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'año' ),
  ));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA MOTOR //////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'motor_taxonomy', 0 );
function motor_taxonomy() {
  $labels = array(
    'name' => _x( 'motor', 'taxonomy general name' ),
    'singular_name' => _x( 'motor', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar motor' ),
    'popular_items' => __( 'motor frecuentes' ),
    'all_items' => __( 'Todos los motor' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar motor' ), 
    'update_item' => __( 'Actualizar motor' ),
    'add_new_item' => __( 'Agregar nueva motor' ),
    'new_item_name' => __( 'Cantidad de nuevo motor' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar motor' ),
    'choose_from_most_used' => __( 'Escoger de los motor utilizados' ),
    'menu_name' => __( 'motor' ),
  ); 
  register_taxonomy('motor','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'motor' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA CILINDROS //////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'cilindros_taxonomy', 0 );
function cilindros_taxonomy() {
  $labels = array(
    'name' => _x( 'cilindros', 'taxonomy general name' ),
    'singular_name' => _x( 'cilindros', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar cilindros' ),
    'popular_items' => __( 'cilindros frecuentes' ),
    'all_items' => __( 'Todos los cilindros' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar cilindros' ), 
    'update_item' => __( 'Actualizar cilindros' ),
    'add_new_item' => __( 'Agregar nueva cilindros' ),
    'new_item_name' => __( 'Cantidad de nuevo cilindros' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar cilindros' ),
    'choose_from_most_used' => __( 'Escoger de los cilindros utilizados' ),
    'menu_name' => __( 'cilindros' ),
  ); 
  register_taxonomy('cilindros','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cilindros' ),
  ));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA CAJA //////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'caja_taxonomy', 0 );
function caja_taxonomy() {
  $labels = array(
    'name' => _x( 'caja', 'taxonomy general name' ),
    'singular_name' => _x( 'caja', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar caja' ),
    'popular_items' => __( 'caja frecuentes' ),
    'all_items' => __( 'Todos los caja' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar caja' ), 
    'update_item' => __( 'Actualizar caja' ),
    'add_new_item' => __( 'Agregar nueva caja' ),
    'new_item_name' => __( 'Cantidad de nuevo caja' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar caja' ),
    'choose_from_most_used' => __( 'Escoger de los caja utilizados' ),
    'menu_name' => __( 'caja' ),
  ); 
  register_taxonomy('caja','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'caja' ),
  ));
}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA TRANSMISION //////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'transmision_taxonomy', 0 );
function transmision_taxonomy() {
  $labels = array(
    'name' => _x( 'transmision', 'taxonomy general name' ),
    'singular_name' => _x( 'transmision', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar transmision' ),
    'popular_items' => __( 'transmision frecuentes' ),
    'all_items' => __( 'Todos los transmision' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar transmision' ), 
    'update_item' => __( 'Actualizar transmision' ),
    'add_new_item' => __( 'Agregar nueva transmision' ),
    'new_item_name' => __( 'Cantidad de nuevo transmision' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar transmision' ),
    'choose_from_most_used' => __( 'Escoger de los transmision utilizados' ),
    'menu_name' => __( 'transmision' ),
  ); 
  register_taxonomy('transmision','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'transmision' ),
  ));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA ESTILO //////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'estilo_taxonomy', 0 );
function estilo_taxonomy() {
  $labels = array(
    'name' => _x( 'estilo', 'taxonomy general name' ),
    'singular_name' => _x( 'estilo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar estilo' ),
    'popular_items' => __( 'estilo frecuentes' ),
    'all_items' => __( 'Todos los estilo' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar estilo' ), 
    'update_item' => __( 'Actualizar estilo' ),
    'add_new_item' => __( 'Agregar nueva estilo' ),
    'new_item_name' => __( 'Cantidad de nuevo estilo' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar estilo' ),
    'choose_from_most_used' => __( 'Escoger de los estilo utilizados' ),
    'menu_name' => __( 'estilo' ),
  ); 
  register_taxonomy('estilo','aplicacion',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'estilo' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// CUSTOM POST ARTICULOS ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
function postarticulos(){
   $args = array(
   'labels'=> array( 'name'=>'articulos',
       'singular_name'=> 'articulos',
       'menu_name'=>'articulos',
       'name_admin_bar'=> 'articulos',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para articulos",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>4,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'excerpt'),
  'taxonomies' => array( 'codigo', 'grupo', 'existencia', 'aplicacion1', 'aplicacion2', 'aplicacion3', 'precioa', 'preciob', 'precioc', 'preciod', 'codalt1', 'codalt2', 'codalt3', 'codalt4', 'codalt5', 'presentacion', 'procedencia', 'fabricacion', 'marca' ),
   'query_var'=>true,
  );
  register_post_type( "articulos", $args );
 }
 add_action("init","postarticulos");

//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// CUSTOM POST APLICACIONES ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
function postaplicacion(){
   $args = array(
   'labels'=> array( 'name'=>'aplicacion',
       'singular_name'=> 'aplicacion',
       'menu_name'=>'aplicacion',
       'name_admin_bar'=> 'aplicacion',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para aplicacion",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>4,
   'capability_type'=> 'page',
   'supports'=> array( 'title'),
  'taxonomies' => array('title', 'codigo', 'marca', 'modelo', 'año', 'motor', 'cilindros', 'caja', 'transmision', 'estilo'),
   'query_var'=>true,
  );
  register_post_type( "aplicacion", $args );
 }
 add_action("init","postaplicacion");


////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////// SIDEBAR /////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////

function custom_sidebars() {
  $args = array('name'=> __( 'filtrado', 'text_domain' ), );
  register_sidebar( $args );
}
add_action( 'widgets_init', 'custom_sidebars' );

////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////// BARRA DE NAVEGACION ///////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
    }

    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        if($item->current || $item->current_item_ancestor || $item->current_item_parent){
            $class_names .= ' active';
        }
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .'>';
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        $atts['class']  = ($item->hasChildren)         ? 'dropdown-toggle' : '';
        $atts['data-toggle']  = ($item->hasChildren)   ? 'dropdown'        : '';
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if( $item->hasChildren) {
            $item_output .= ' <b class="caret"></b>';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
update_option('image_default_link_type','none');
