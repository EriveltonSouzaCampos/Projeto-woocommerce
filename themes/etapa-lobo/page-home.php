<?php 
//Template name: home
?>
<?php
get_header();
?>
<main>
    <!-- FRASE DA PAGINA HOME -->
        <div class="frase-da-pagina">
            <h1>
                Comes&Bebes
            </h1>
            <p>
                O restaurante para todas as fomes
            </p>
        </div>
    <!-- fim -->
    <!-- TIPOS DE PRODUTOS -->
        <div class="menu-categoria-produtos">
            <h1>Conheça nossa loja</h1>
            <p id="texto-das-categorias">Tipo de pratos principais</p>
            <?php wp_nav_menu([
                'menu' => 'categorias-dos-produtos'
            ]); ?>
        </div>
    <!-- DIA DA SEMANA  -->
        <?php
            // Define a timezone
            date_default_timezone_set('America/Sao_Paulo');

            // Define a localização para português do Brasil
            setlocale(LC_TIME, 'pt_br');

            // Define a codificação para UTF-8
            wp_set_current_user(0, 'admin', 'password');
            ini_set('default_charset', 'UTF-8');
        ?>
        <div class="dia-da-semana">
            <h2>Pratos do dia:</h2>
            <p>
                <?php
                // Exibe o dia da semana em português
                echo ucfirst(utf8_encode(strftime('%A')));
                ?>
            </p>
        </div>     
    <!-- fim -->
    <!-- PRATOS DA SEMANA --> 
        <div class="conter-pratos-do-dia">
            <?php
                // Obter a tag que estamos procurando
                $tag_to_match = ucfirst(utf8_encode(strftime('%A')));
                // Definir argumentos de consulta para obter produtos com a tag correspondente
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'tax_query'      => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field'    => 'name',
                        'terms'    => $tag_to_match,
                        ),
                    ),
                );
                $products = new WP_Query( $args );
                if ( $products->have_posts() ) {
                    while ( $products->have_posts() ) {
                        $products->the_post();
                        $product_id = get_the_ID(); // obtém o ID do produto atual
                        $product_tag = wc_get_product_tag_list( $product_id ); // obtém a lista de tags do produto atual
                        // Verifica se o produto tem a tag correspondente
                        if ( strpos( $product_tag, $tag_to_match ) !== false ) {
                            $product_image_id = get_post_thumbnail_id( $product_id ); // obtém o ID da imagem em destaque do produto
                            $product_image_url = wp_get_attachment_url( $product_image_id ); // obtém a URL da imagem usando o ID
                            $nome_do_produto = get_the_title();
                            $link_do_produto = get_permalink();
                            ?><!-- Quebra do php -->
                            <div class="prato-do-dia" style="background-image: url('<?php echo $product_image_url; ?>'); "> 
                                <div class="info-dos-pratos-do-dia">
                                    <p> <?php echo $nome_do_produto; ?> </p>
                                    <div class="preço-e-btn-de-compra">
                                        <p> <?php echo woocommerce_template_loop_price(); ?> </p>
                                        <button>
                                            <a href=" <?php echo $link_do_produto; ?> ">
                                            <img src="<?php echo IMAGE_DIR . '/fa-solid_cart-plus.svg' ?>" alt="Carrinho">
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php /* Retoma o php */
                        }
                    }
                    wp_reset_postdata(); // redefinir a consulta do loop
                }
            ?>
        </div>
    <!-- fim -->
</main>
<?php
get_footer();
?>