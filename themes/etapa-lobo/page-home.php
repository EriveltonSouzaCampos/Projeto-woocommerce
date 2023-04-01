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
</main>
<?php
get_footer();
?>