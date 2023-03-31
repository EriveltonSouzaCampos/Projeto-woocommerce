<?php 

function estilos_tema(){
    
    //Declarando qual o arquivo (registrando)
    wp_register_style('style_Lobo_reset', STYLES_DIR . '/reset.css', [], '1.0.0', false);
    wp_register_style('style', get_stylesheet_uri(), [], '1.0.0', false);
    wp_register_style('style-home', STYLES_DIR . '/style-home.css', [], '1.0.0', false);
    wp_register_style('style-header', STYLES_DIR . '/style-header.css', [], '1.0.0', false);
    wp_register_style('style-footer', STYLES_DIR . '/style-footer.css', [], '1.0.0', false);


    
    //Enfileirando
    wp_enqueue_style('style_Lobo_reset');
    wp_enqueue_style('style');
    wp_enqueue_style('style-home');
    wp_enqueue_style('style-header');
    wp_enqueue_style('style-footer');

    
}


?>