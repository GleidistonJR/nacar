<?php

$filtro = $_GET["filtro"];


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinhal | Produtos</title>
    <link rel="shortcut icon" href="./imgs/logo/favicon.bmp" type="image/x-icon">

    <!-- Incluindo CSS-->
    <?php include_once("componentes/include_css.html") ?>
    <link rel="stylesheet" href="css/produtos.css">
</head>

<body>
    <?php
    include_once("componentes/header.html");
    ?>


        <article class="row filtro">
            <a class='d-block d-md-none btn-filtro' id="btn-filtro" href="#" >Filtros <i class="bi bi-caret-down-fill"></i></a>
            <nav class="col-12 col-md-12 col-filtro d-none d-md-block " id="nav-filtro">
            <a href="?filtro=todos">Todos</a>
                    <a href="?filtro=adaptador">Adaptador</a>
                    <a href="?filtro=balanceador">Balanceador</a>
            </nav>
        </article>
    <section class="produtos container-fluid">

        <h1>Produtos</h1>



        <article class="row row-prod">
            <?php

            $pastas = array("data/produtos/");

            foreach ($pastas as $pasta) {
                $arquivos = glob("$pasta{*.json}",  GLOB_BRACE);

                foreach ($arquivos as $arquivo) {
                    $produto = json_decode(file_get_contents($arquivo), true);
                    if ($filtro == "todos" || $filtro == $produto['categoria-filtro']) {
                        echo '                
                        <div class="card">
                            <a href="produto.php?produto=' . $produto["url"] . '">
                                <img src="' . $produto["imagem-principal"] . '" class="card-img-top" alt="imagem do ' . $produto["titulo"] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $produto["titulo"] . '</h5>
                                    
                                    <p class="card-text"><b>Cód.</b> '; 
                                    if(count($produto["codigo"]) <= 1){
                                        echo '<br>'; 
                                        echo $produto["codigo"][0];    
                                    }
                                    else{
                                        foreach($produto["codigo"] as $codigo){
                                            echo '<br>'; 
                                            echo $codigo; 
                                        }
                                    };

                                    echo '
                                    </p>  
    
                                    <p class="card-text">';
                                    
                                    if(count($produto["info"]["modelo"]) <= 1 && !$produto["info"]["img"] ){
                                        echo '<b>Modelo:</b><br>';    
                                        echo $produto["info"]["modelo"][0];    
                                    }
                                    echo ' 


                                    </p>';                               
                                    if($produto["info"]["img"] || count($produto["info"]["modelo"]) > 1){
                                        echo '
                                        <!-- Button trigger modal -->
                                        <a class="btn-variacoes" data-bs-toggle="modal" data-bs-target="#exampleModal'.$produto['codigo'][0].'">
                                        informações
                                        </a>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal'.$produto['codigo'][0].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Informações</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">';
                                                    if($produto["info"]["img"]){
                                                        echo '
                                                        <img src="' . $produto["info"]["img"] . '" width="100%" alt="Informações">';
                                                    };
                                                    echo '
                                                    <p class="card-text"><b>Modelos:</b><br>';
                                                    
                                                    if(count($produto["info"]["modelo"]) <= 1){
                                                        echo $produto["info"]["modelo"][0];    
                                                    }
                                                    else{
                                                        foreach($produto["info"]["modelo"] as $modelo){
                                                            echo '<br>'; 
                                                            echo $modelo; 
                                                        }
                                                    };
                                                    echo '   
                                                    </p>   
                                                </div>
                                                <div class="modal-footer">
                                                <a href="' . $produto["info"]["img"] . '" target="_blank" class="btn-cor1">Ver em guia separada</a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        ';  
                                    }
                                    echo '
                                    </p>                               
                                </div>
                            </a>
                        </div>
                        ';
                    }
                }
            }
            ?>
        </article>




    </section>


    <?php
    include_once("componentes/footer.html");

    include_once("componentes/whatsapp.html");
    ?>


</body>

<script>
const btnfiltro = document.querySelector('#btn-filtro')
const nav_filtro = document.querySelector('#nav-filtro')

btnfiltro.addEventListener("click", function() {
    nav_filtro.classList.toggle('aparecer-filtro')
      
    })
</script>

</html>