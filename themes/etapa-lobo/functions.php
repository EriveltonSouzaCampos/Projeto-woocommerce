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

?>