<?php

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'quatro_rodas_setup' ) ) :

function quatro_rodas_setup() {

	load_theme_textdomain( 'quatro_rodas' );	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );


	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'quatro_rodas' ),
		'social'  => __( 'Social Links Menu', 'quatro_rodas' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	add_editor_style( array( 'css/editor-style.css' ) );

	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; 
add_action( 'after_setup_theme', 'quatro_rodas_setup' );

function quatro_rodas_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'quatro_rodas_content_width', 840 );
}
add_action( 'after_setup_theme', 'quatro_rodas_content_width', 0 );

function quatro_rodas_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'quatro_rodas' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'quatro_rodas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'quatro_rodas_widgets_init' );


function quatro_rodas_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'quatro_rodas_javascript_detection', 0 );

function quatro_rodas_scripts() {
	wp_enqueue_style( 'quatro_rodas-style', get_stylesheet_uri() );
	wp_enqueue_style( 'materialize-style', get_template_directory_uri() . '/materialize/css/materialize.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'materialize-js', get_template_directory_uri() . '/materialize/js/materialize.js', array( 'jquery' ), '20160816', true );
}
add_action( 'wp_enqueue_scripts', 'quatro_rodas_scripts' );

function quatro_rodas_body_classes( $classes ) {
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'quatro_rodas_body_classes' );

function quatro_rodas_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}


function quatro_rodas_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'quatro_rodas_content_image_sizes_attr', 10 , 2 );


function quatro_rodas_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'quatro_rodas_post_thumbnail_sizes_attr', 10 , 3 );


/*					REGISTRANDO noticias  			*/
add_action('init', 'noticia_register');
function noticia_register() {
    $labels = array(
        'name' => _x('noticias', 'post type general name'),
        'singular_name' => _x('noticia', 'post type singular name'),
        'add_new' => _x('Adicionar Nova', 'noticia  item'),
        'add_new_item' => __('Adicionar Nova noticia'),
        'edit_item' => __('Editar noticia'),
        'new_item' => __('Nova noticia'),
        'view_item' => __('Ver noticia'),
        'search_items' => __('Procurar noticia'),
        'not_found' =>  __('Nada Encontrado'),
        'not_found_in_trash' => __('Nada Encontrado na Lixeira'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon'   => 'dashicons-format-aside',
        'supports' => array('title','editor', 'thumbnail')
      ); 
    register_post_type( 'noticia' , $args );
}

add_action('add_meta_boxes', 'noticia_metabox');

function noticia_metabox(){
    add_meta_box(
        'noticia',
        'Dados noticia',
        'noticia_html',
        'noticia',
        'normal',
        'low'
    );
}

add_action('save_post', 'noticia_save');

function noticia_save($post_id){
    global $wpdb;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	$categoria = $_POST['noticia_categoria'];
	$destaque = $_POST['noticia_destaque'];
	$modulo = $_POST['noticia_modulo'];
	
	
	$wpdb->replace(
		"qr_noticias",
		array(
			"noticia_id" => $post_id,
			"categoria" => $categoria,
			"destaque" => $destaque,
			"modulo" => $modulo
		),
		array( "%d", "%d", "%d", "%s" )
	);
}

function noticia_html($post){
    global $wpdb;
    $post_id = get_the_ID();
	$noticia = $wpdb->get_row("SELECT * FROM qr_noticias WHERE noticia_id = $post_id ");
?>
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/materialize/css/materialize.css" />
	<script src="<?php echo get_template_directory_uri(); ?>/materialize/js/materialize.min.js"></script>

	<script>
		jQuery(document).ready(function(){
			jQuery('select').material_select();
		});
	</script>
	
	<div class="wrap">
		<div class="row">
			<div class=" col s12">
				<p>
					<input type="checkbox" name="noticia_destaque" id="destaque" value="1" <?php checked( $noticia->destaque, 1 ); ?>/>
					<label for="destaque">noticia em destaque? </label>
				</p> 	
	        </div>
	        <div class="input-field col s12 m6">
	        	<select name="noticia_categoria">
				 	<option value="1" <?php selected( $noticia->categoria, 1 ); ?> >Carros Grandes</option>
				 	<option value="2" <?php selected( $noticia->categoria, 2 ); ?> >Fabricantes</option>
				  	<option value="3" <?php selected( $noticia->categoria, 3 ); ?> >Promovido por volkswagem</option>
				  	<option value="4" <?php selected( $noticia->categoria, 4 ); ?> >Comparativos</option>
				  	<option value="5" <?php selected( $noticia->categoria, 5 ); ?> >Impressões</option>
				  	<option value="6" <?php selected( $noticia->categoria, 6 ); ?> >Auto-serviço</option>
				</select>
				<label>Categoria</label>
			</div>
			<div class="input-field col s12 m6">
				<select name="noticia_modulo">
				 	<option value="1x1" <?php selected( $noticia->modulo, "1x1" ); ?> >Modulo 1x1 </option>
				 	<option value="2x2" <?php selected( $noticia->modulo, "2x2" ); ?> >Modulo 2x2</option>
				</select>
				<label>Modulo</label>
			</div>
		</div>
	</div>
	
<?php
}

/*					REGISTRANDO CARROS  			*/
add_action('init', 'carro_register');
function carro_register() {
    $labels = array(
        'name' => _x('carros', 'post type general name'),
        'singular_name' => _x('carro', 'post type singular name'),
        'add_new' => _x('Adicionar Nova', 'carro  item'),
        'add_new_item' => __('Adicionar Nova carro'),
        'edit_item' => __('Editar carro'),
        'new_item' => __('Nova carro'),
        'view_item' => __('Ver carro'),
        'search_items' => __('Procurar carro'),
        'not_found' =>  __('Nada Encontrado'),
        'not_found_in_trash' => __('Nada Encontrado na Lixeira'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon'   => 'dashicons-format-aside',
        'supports' => array('title','editor', 'thumbnail')
      ); 
    register_post_type( 'carro' , $args );
}