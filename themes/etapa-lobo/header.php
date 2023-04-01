<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php 
        wp_head();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800&family=Bellota+Text:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Inter:wght@100;200;300;400;500;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title><?php bloginfo('name') ?> | <?php the_title(); ?></title>
</head>
<body <?php body_class(); ?>>
    <header>
        <!-- header -->
        <section class="topo-do-site">
            <!-- Logo e a barra de pesquisa -->
            <div class="logo-e-pesquisa">
                <?php the_custom_logo(); ?>
                <form action="<?php echo bloginfo('url'); ?>/loja/" method="get">
		            <input class="pesquisa-do-header" type="text" name="s" id="s" placeHolder="Search">
	            </form>
            </div>
            <div class="navegação">
                <!-- Navegação entre paginas -->
                <button id="botao-para-loja">
                    <a href="">Faça seu pedido</a>
                </button>
                <a href="">
                    <img src="<?php echo IMAGE_DIR . '/fa-solid_shopping-cart.svg' ?>" alt="Carrinho de compra">
                </a>
                <a href="">
                    <img src="<?php echo IMAGE_DIR . '/bx_bxs-user-circle.svg' ?>" alt="Perfil usuario">
                </a>
            </div>
        </section>
    </header>