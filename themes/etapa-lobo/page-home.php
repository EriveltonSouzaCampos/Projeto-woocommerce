<?php 
//Template name: home
?>
<?php
get_header();
?>
<main>
    <div class="linha-amarela"></div> 
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
    <!-- fim -->

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

    <!-- BOTÃO DE OPÇÕES -->
        <div id="btn-para-opções"><button><a href="">Veja outras opções</a></button></div>
    <!-- fim -->

    <!-- VISITE NOSSA LOJA -->
        <div id="texto-visite-loja">
            <h1>Visite nossa loja</h1>
        </div>
        <div class="linha-amarela"></div> 
        <!-- informação da loja: mapa numero e endereço -->
            <div class="info-da-loja-e-slides">
                <div class="info-da-loja">
                    <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.3285848324467!2d-43.11068118503443!3d-22.90124818501454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9983e5637f8d7d%3A0x4b064fe0f4ae124b!2sAv.%20Roberto%20Silveira%2C%20123%20-%20Icara%C3%AD%2C%20Niter%C3%B3i%20-%20RJ%2C%2024230-150!5e0!3m2!1spt-BR!2sbr!4v1675792835515!5m2!1spt-BR!2sbr" width="345" height="203" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="img-e-texto">
                        <img src="<?php echo IMAGE_DIR . '/TelefoneContato.svg' ?>" alt="Icone telefone">
                        <p>(21) 9 9895-9698</p>
                    </div>
                    <div class="img-e-texto">
                        <img src=" <?php echo IMAGE_DIR . '/Talheres.svg' ?> " alt="Icone talheres">
                        <p>Av. Roberto Silveira, 123 - Icaraí</p>
                    </div>
                </div>
        <!-- fim -->
                                   
        <!-- pegando as imagens do ACF -->
            <?php 
                function slideFotos(){
                    $acf_field_group = acf_get_field_group(87);
                    $acf_fields = acf_get_fields(87);
                    $contador_de_img = 1;
                    foreach ($acf_fields as $field) {
                        $nome = $field['name'];
                        $tamanho = 'full';
                        $imagem = get_field($nome);
                        
                        ?>
                        <div class="img-do-carrosel"id="f<?=$contador_de_img?>"><?php echo wp_get_attachment_image( $imagem, $tamanho ); ?></div>
                        <?php 
                        $contador_de_img++;
                    }
                }
            ?>
        <!-- fim -->

        <!-- JS para os slides e os dots funcionar (em um arq a parte nao funcionou?) -->
            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    const carouselImages = document.querySelector('.slide-imagens');
                    let currentIndex = 0;
                    function nextSlide() {
                        if (slideClicked) {
                            currentIndex = clickedIndex;
                        } else {
                            currentIndex++;
                            if (currentIndex > carouselImages.children.length - 1) {
                            currentIndex = 0;
                            }
                        }
                        slideClicked = false;

                        carouselImages.style.transform = `translateX(-${currentIndex * 100}%)`;
                        document.querySelector('.dot-nav .active').classList.remove('active');
                        document.querySelector(`.dot-nav span:nth-child(${currentIndex + 1})`).classList.add('active');
                    }
                    function createDots() {
                        const dotNav = document.querySelector('.dot-nav');
                        for (let i = 0; i < carouselImages.children.length; i++) {
                            const dot = document.createElement('span');
                            dot.addEventListener('click', () => {
                            currentIndex = i;
                            changeSlide();
                            });
                            dotNav.appendChild(dot);
                        }
                        dotNav.children[0].classList.add('active');
                    }

                    function changeSlide() {
                        carouselImages.style.transform = `translateX(-${currentIndex * 100}%)`;
                        document.querySelector('.dot-nav .active').classList.remove('active');
                        document.querySelector(`.dot-nav span:nth-child(${currentIndex + 1})`).classList.add('active');
                    }

                    createDots();

                    const dots = document.querySelectorAll('.dot-nav span');
                    const slideInterval = 5000;
                    let slideTimer, slideClicked = false, clickedIndex;

                    function resetSlideTimer() {
                    clearInterval(slideTimer);
                    slideTimer = setInterval(nextSlide, slideInterval);
                    }

                    dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        slideClicked = true;
                        clickedIndex = index;
                        resetSlideTimer();
                        document.querySelector('.dot-nav .active').classList.remove('active');
                        dot.classList.add('active');
                    });
                    });

                    resetSlideTimer();
                });
            </script>
        <!-- fim -->

        <!-- Slide de fotos da loja -->    
            <div class="slide-container">
                <div class="slide-imagens">
                    <?php  slideFotos(); ?>
                </div>
                <div class="dot-nav"></div>
            </div>
        <!-- fim -->
    <!-- fim -->
</main>
<?php
get_footer();
?>