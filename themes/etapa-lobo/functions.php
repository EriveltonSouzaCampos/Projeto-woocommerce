<?php 
//varaiveis
define('ROOT_DIR', get_theme_file_path());
define('STYLES_DIR', get_template_directory_uri() . '/assets/css');
define('IMAGE_DIR', get_template_directory_uri() . '/assets/images');
define('INCLUDES_DIR', ROOT_DIR . '/includes');
define('JAVA_DIR', get_template_directory_uri() . '/assets/js');

//Includes

include_once(INCLUDES_DIR . '/enqueue.php');
include_once(INCLUDES_DIR . '/setup-theme.php');

 //hooks
 add_action('wp_enqueue_scripts', 'estilos_tema');
 add_action('after_setup_theme', 'setup_theme_pf');

 /* Edita o nav menu para aparecer estes elementos*/
 add_filter('wp_nav_menu_objects', 'transforma_menu');
 function transforma_menu($itens){
    foreach($itens as $item){
      $thumbnail_id = get_term_meta($item->object_id, 'thumbnail_id', true);
      $image = wp_get_attachment_url($thumbnail_id);
      $css = 'background-image: url('. $image .')';
      $item->title = 

    '
    <div class=conter-cate>
    <div class="Categoria-content" style="'. $css .';">
    <div class="Categoria-titulo">
        <p class="Title">'.$item->title.'</p>
    </div>
    </div>
    
    </div>';
    }
    return $itens;
  }
  add_filter( 'woocommerce_shortcode_products_query', 'woocommerce_shortcode_products_orderby' );

/*fim*/

?>