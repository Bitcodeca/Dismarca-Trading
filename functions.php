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
    $qv[] = 'grupo';
    return $qv;
}

add_filter('relevanssi_modify_wp_query', 'movie_tax_query');
function movie_tax_query($query) {
    $tax_query = array();
    if (!empty($query->query_vars['grupo'])) {
        $tax_query[] = array(
            'taxonomy' => 'grupo',
            'field' => 'slug',
            'terms' => $query->query_vars['grupo']
        );
    }
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA CODIGO /////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'codigo', array( 'productos', 'aplicacion' ),array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'codigo' ),
  ));
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA NOMBRE ////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'nombre_taxonomy', 0 );
function nombre_taxonomy() {
  $labels = array(
    'name' => _x( 'nombre', 'taxonomy general name' ),
    'singular_name' => _x( 'nombre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar nombre' ),
    'popular_items' => __( 'nombres frecuentes' ),
    'all_items' => __( 'Todos los nombres' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar nombre' ), 
    'update_item' => __( 'Actualizar nombre' ),
    'add_new_item' => __( 'Agregar nuevo nombre' ),
    'new_item_name' => __( 'Cantidad de nuevos nombres' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar nombre' ),
    'choose_from_most_used' => __( 'Escoger de los nombres utilizados' ),
    'menu_name' => __( 'nombre' ),
  ); 
  register_taxonomy( 'nombre', array( 'productos', 'aplicacion' ),array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'nombre' ),
  ));
}


////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA GRUPO ////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
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
    'menu_name' => __( 'Grupo' ),
  ); 
  register_taxonomy( 'grupo', array( 'productos', 'aplicacion' ), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'grupo' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// TAXONOMIA EXISTENCIA /////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'existencia', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'existencia' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA PRECIO ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'precio_taxonomy', 0 );
function precio_taxonomy() {
  $labels = array(
    'name' => _x( 'precio', 'taxonomy general name' ),
    'singular_name' => _x( 'precio', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar precio' ),
    'popular_items' => __( 'precio frecuentes' ),
    'all_items' => __( 'Todos los precios' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar precio' ), 
    'update_item' => __( 'Actualizar precio' ),
    'add_new_item' => __( 'Agregar nuevo precio' ),
    'new_item_name' => __( 'Cantidad de nuevo precio' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar precio' ),
    'choose_from_most_used' => __( 'Escoger de los precios utilizados' ),
    'menu_name' => __( 'precio' ),
  ); 
  register_taxonomy( 'precio', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'precio' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA APLICACIÓN ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'aplicacion_taxonomy', 0 );
function aplicacion_taxonomy() {
  $labels = array(
    'name' => _x( 'aplicacion', 'taxonomy general name' ),
    'singular_name' => _x( 'Aplicacion', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar aplicaciones' ),
    'popular_items' => __( 'aplicaciones frecuentes' ),
    'all_items' => __( 'Todas las aplicaciones' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar aplicacion' ), 
    'update_item' => __( 'Actualizar aplicacion' ),
    'add_new_item' => __( 'Agregar nuevo aplicacion' ),
    'new_item_name' => __( 'Cantidad de nuevas aplicaciones' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar aplicaciones' ),
    'choose_from_most_used' => __( 'Escoger de los aplicaciones utilizados' ),
    'menu_name' => __( 'aplicacion' ),
  ); 
  register_taxonomy( 'aplicacion', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'aplicacion' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA DATOS ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'datos_taxonomy', 0 );
function datos_taxonomy() {
  $labels = array(
    'name' => _x( 'datos', 'taxonomy general name' ),
    'singular_name' => _x( 'Dato', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar datos' ),
    'popular_items' => __( 'Datos frecuentes' ),
    'all_items' => __( 'Todas los datos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar dato' ), 
    'update_item' => __( 'Actualizar dato' ),
    'add_new_item' => __( 'Agregar nuevo dato' ),
    'new_item_name' => __( 'Cantidad de nuevos datos' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar datos' ),
    'choose_from_most_used' => __( 'Escoger de los datos utilizados' ),
    'menu_name' => __( 'Datos' ),
  ); 
  register_taxonomy( 'datos', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'datos' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA OEM ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'oem_taxonomy', 0 );
function oem_taxonomy() {
  $labels = array(
    'name' => _x( 'oem', 'taxonomy general name' ),
    'singular_name' => _x( 'oem', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar oem' ),
    'popular_items' => __( 'oem frecuentes' ),
    'all_items' => __( 'Todas los oem' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar oem' ), 
    'update_item' => __( 'Actualizar oem' ),
    'add_new_item' => __( 'Agregar nuevo oem' ),
    'new_item_name' => __( 'Cantidad de nuevos oem' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar oem' ),
    'choose_from_most_used' => __( 'Escoger de los oem utilizados' ),
    'menu_name' => __( 'oem' ),
  ); 
  register_taxonomy( 'oem', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'oem' ),
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
  register_taxonomy( 'codalt1', 'productos', array(
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
  register_taxonomy( 'codalt2', 'productos', array(
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
  register_taxonomy( 'codalt3', 'productos', array(
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
  register_taxonomy( 'codalt4', 'productos', array(
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
  register_taxonomy( 'procedencia', 'productos', array(
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
/////////////////////////// TAXONOMIA CONDICION ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'condicion_taxonomy', 0 );
function condicion_taxonomy() {
  $labels = array(
    'name' => _x( 'condicion', 'taxonomy general name' ),
    'singular_name' => _x( 'Condicion', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar condiciones' ),
    'popular_items' => __( 'Condiciones frecuentes' ),
    'all_items' => __( 'Todas las condiciones' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar condiciones' ), 
    'update_item' => __( 'Actualizar condiciones' ),
    'add_new_item' => __( 'Agregar nueva condicion' ),
    'new_item_name' => __( 'Cantidad de nueva condicion' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar condicion' ),
    'choose_from_most_used' => __( 'Escoger de las condiciones utilizadas' ),
    'menu_name' => __( 'condicion' ),
  ); 
  register_taxonomy( 'condicion', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'condicion' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA FOB ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'fob_taxonomy', 0 );
function fob_taxonomy() {
  $labels = array(
    'name' => _x( 'fob', 'taxonomy general name' ),
    'singular_name' => _x( 'FOB', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar FOB' ),
    'popular_items' => __( 'FOB frecuentes' ),
    'all_items' => __( 'Todas las FOB' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar FOB' ), 
    'update_item' => __( 'Actualizar FOB' ),
    'add_new_item' => __( 'Agregar nueva FOB' ),
    'new_item_name' => __( 'Cantidad de nueva FOB' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar FOB' ),
    'choose_from_most_used' => __( 'Escoger de las FOB utilizadas' ),
    'menu_name' => __( 'fob' ),
  ); 
  register_taxonomy( 'fob', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'fob' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA ESPECIFICACIÓN ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'especificacion_taxonomy', 0 );
function especificacion_taxonomy() {
  $labels = array(
    'name' => _x( 'especificacion', 'taxonomy general name' ),
    'singular_name' => _x( 'Especificacion', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar especificacion' ),
    'popular_items' => __( 'Especificaciones frecuentes' ),
    'all_items' => __( 'Todas las especificaciones' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar especificacion' ), 
    'update_item' => __( 'Actualizar especificacion' ),
    'add_new_item' => __( 'Agregar nueva especificacion' ),
    'new_item_name' => __( 'Cantidad de nueva especificacion' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar especificacion' ),
    'choose_from_most_used' => __( 'Escoger de las especificaciones utilizadas' ),
    'menu_name' => __( 'especificacion' ),
  ); 
  register_taxonomy( 'especificacion', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'especificacion' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA FACTOR ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'factor_taxonomy', 0 );
function factor_taxonomy() {
  $labels = array(
    'name' => _x( 'factor', 'taxonomy general name' ),
    'singular_name' => _x( 'Factor', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar factor' ),
    'popular_items' => __( 'Factores frecuentes' ),
    'all_items' => __( 'Todos los factores' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar factor' ), 
    'update_item' => __( 'Actualizar factor' ),
    'add_new_item' => __( 'Agregar nuevo factor' ),
    'new_item_name' => __( 'Cantidad de nuevo factor' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar factor' ),
    'choose_from_most_used' => __( 'Escoger de los factor utilizados' ),
    'menu_name' => __( 'factor' ),
  ); 
  register_taxonomy( 'factor', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'factor' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA FOTO1 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'foto1_taxonomy', 0 );
function foto1_taxonomy() {
  $labels = array(
    'name' => _x( 'foto1', 'taxonomy general name' ),
    'singular_name' => _x( 'Foto 1', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Foto 1' ),
    'popular_items' => __( 'Foto 1 frecuentes' ),
    'all_items' => __( 'Todos las Foto 1' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Foto 1' ), 
    'update_item' => __( 'Actualizar Foto 1' ),
    'add_new_item' => __( 'Agregar nueva Foto 1' ),
    'new_item_name' => __( 'Cantidad de nuevo Foto 1' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar Foto 1' ),
    'choose_from_most_used' => __( 'Escoger de los Foto 1 utilizados' ),
    'menu_name' => __( 'foto1' ),
  ); 
  register_taxonomy( 'foto1', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'foto1' ),
  ));
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA FOTO2 ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'foto2_taxonomy', 0 );
function foto2_taxonomy() {
  $labels = array(
    'name' => _x( 'foto2', 'taxonomy general name' ),
    'singular_name' => _x( 'Foto 2', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Foto 2' ),
    'popular_items' => __( 'Foto 2 frecuentes' ),
    'all_items' => __( 'Todos las Foto 2' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Foto 2' ), 
    'update_item' => __( 'Actualizar Foto 2' ),
    'add_new_item' => __( 'Agregar nueva Foto 2' ),
    'new_item_name' => __( 'Cantidad de nuevo Foto 2' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar Foto 2' ),
    'choose_from_most_used' => __( 'Escoger de los Foto 2 utilizados' ),
    'menu_name' => __( 'foto2' ),
  ); 
  register_taxonomy( 'foto2', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'foto2' ),
  ));
}


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// TAXONOMIA COSTO ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'costo_taxonomy', 0 );
function costo_taxonomy() {
  $labels = array(
    'name' => _x( 'costo', 'taxonomy general name' ),
    'singular_name' => _x( 'Costo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar costo' ),
    'popular_items' => __( 'Costos frecuentes' ),
    'all_items' => __( 'Todos los costos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar costos' ), 
    'update_item' => __( 'Actualizar costos' ),
    'add_new_item' => __( 'Agregar nuevo costo' ),
    'new_item_name' => __( 'Cantidad de nuevo costo' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar costo' ),
    'choose_from_most_used' => __( 'Escoger de los costos utilizados' ),
    'menu_name' => __( 'costo' ),
  ); 
  register_taxonomy( 'costo', 'productos', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'costo' ),
  ));
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////// TAXONOMIA MARCA ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'marca', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'marca' ),
  ));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// TAXONOMIA MODELO /////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'modelo', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'modelo' ),
  ));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA AÑO ///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'año', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'año' ),
  ));
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA MOTOR //////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'motor', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'motor' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA CILINDROS ///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'cilindros', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cilindros' ),
  ));
}


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA ESTILO ////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'estilo', 'aplicacion', array(
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
////////////////////////////////////// TAXONOMIA FABRICANTE //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'fabricante_taxonomy', 0 );
function fabricante_taxonomy() {
  $labels = array(
    'name' => _x( 'fabricante', 'taxonomy general name' ),
    'singular_name' => _x( 'Fabricante', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar fabricante' ),
    'popular_items' => __( 'Fabricantes frecuentes' ),
    'all_items' => __( 'Todos los fabricantes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar fabricante' ), 
    'update_item' => __( 'Actualizar fabricante' ),
    'add_new_item' => __( 'Agregar nuevo fabricante' ),
    'new_item_name' => __( 'Cantidad de nuevo fabricante' ),
    'separate_items_with_commas' => __( '' ),
    'add_or_remove_items' => __( 'Agregar o Quitar fabricante' ),
    'choose_from_most_used' => __( 'Escoger de los fabricante utilizados' ),
    'menu_name' => __( 'fabricante' ),
  ); 
  register_taxonomy( 'fabricante', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'fabricante' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA CAJA //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'caja', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'caja' ),
  ));
}



//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// TAXONOMIA TRANSMISION /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
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
  register_taxonomy( 'transmision', 'aplicacion', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'transmision' ),
  ));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// CUSTOM POST ARTICULOS ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
function postarticulos(){
   $args = array(
   'labels'=> array( 'name'=>'articulos',
       'singular_name'=> 'articulos',
       'menu_name'=>'Articulos',
       'name_admin_bar'=> 'articulos',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicacion' ),
   'description' =>"Este tipo de post es para articulos",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>4,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor'),
  'taxonomies' => array( 'codigo', 'nombre', 'grupo', 'precio', 'existencia', 'aplicacion', 'datos', 'oem', 'codalt1', 'codalt2', 'codlat3', 'codlat4', 'procedencia', 'condicion', 'fob', 'especificacion', 'factor', 'foto1', 'foto2', 'costo' ),
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
       'menu_name'=>'Aplicacion',
       'name_admin_bar'=> 'aplicacion',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicacion' ),
   'description' =>"Este tipo de post es para aplicacion",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>4,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor'),
  'taxonomies' => array('codigo', 'marca', 'modelo', 'año', 'motor', 'cilindros', 'estilo', 'fabricante', 'grupo', 'nombre', 'caja', 'transmision' ),
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
