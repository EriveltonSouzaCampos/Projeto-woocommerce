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
    
</main>
<?php
get_footer();
?>