<?php

$prod = $_GET["produto"];

$desc = json_decode(file_get_contents("./data/produtos/" . $prod . ".json"), true);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nacar | <?php echo $desc["titulo"]; ?></title>
    <link rel="shortcut icon" href="imgs/logo/favicon.bmp" type="image/x-icon">
    <link rel="stylesheet" href="css/produto.css">

    <?php
    include_once("componentes/include_css.html");
    ?>
</head>

<body>
    <?php
    include_once("componentes/header.html");
    ?>
    <section class="produto container-fluid">
        <article class="row">
            <aside class="col-12 col-md-4 col-img">
                <img src="<?php echo $desc["imagem-principal"]; ?>" alt="">
            </aside>
            <aside class="col-12 col-md-6 col-txt">
                <div class="tit">
                    <h2 class="titulo"><?php echo $desc["titulo"]; ?></h2>
                    <h3 class="categoria"><?php echo $desc["categoria"]; ?></h3>
                </div>

                <?php 
                    if($desc["codigo"]){
                        echo '
                        <p class="descricao"><b>Codigo:</b></p>
                        <p class="descricao">
                        ';
                        foreach($desc["codigo"]as $chave){
                            echo "$chave\n";
                        }
                        echo '
                            </p>
                        ';
                    }   
                ?>


                <?php 
                    if($desc["info"]["img"]){
                        echo '
                            <p class="descricao"><b>Informações:</b></p>
                            <img src="' . $desc["info"]["img"] . '" width="50%" alt="Informações ' . $desc["nome"] . '">
                        ';
                    }   
                ?>  


                <?php 
                    if($desc["info"]["modelo"][0]){
                        echo '
                        <p class="descricao"><b>Modelo:</b></p>
                        <p class="descricao">
                        ';
                        foreach($desc["info"]["modelo"] as $chave){
                            echo "$chave\n";
                        }
                        echo '
                            </p>
                        ';
                    }   
                ?> 
                
                                
                
                 
            </aside>
        </article>

    </section>
    
    <?php
    
    include_once("componentes/carrousel_produtos.html");

    include_once("componentes/bem_vindo.html");

    include_once("componentes/footer.html");

    include_once("componentes/whatsapp.html");
    ?>
</body>

<script>
    var swiper_empresa = new Swiper(".carrousel-produtos", {
        slidesPerView: 2,
        spaceBetween: 10,
        centeredSlides: true,
        loop: true,
        autoplay: true,
        delay: 2000,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            clickable: true,
        },
        breakpoints: {
            // when window width is >= 720px
            1370: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            720: {
                slidesPerView: 3,
                spaceBetween: 30
            },
        }
    });
</script>

</html>