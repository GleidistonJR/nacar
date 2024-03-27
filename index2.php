<?php

$filtro = $_GET["filtro"];


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nacar Equipamentos</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="js/bootstrap/bootstrap.min.js" defer></script>
</head>
<body>
    <header class="header container-fluid">
        <div class="col-12 whatsapp">
            <a href="#"><i class="bi bi-whatsapp"> </i>(62)9 9999-9999</a>
            <a href="#"><i class="bi bi-telephone-fill"> </i>(62)9 9999-9999</a>
            <a href="#"><i class="bi bi-envelope-fill"> </i>atendimento@nacar.com.br</a>
        </div>
        <div class="col-12 logo">
            <img src="imgs/logo.png" alt="Logo Nacar">

        </div>
    </header>


    <main class="container-fluid">
        <section class=row>
            <h1 class="txt-center col-12">Catalogo</h1>


            <article class="row filtro">
                <a class='d-block d-md-none btn-filtro' id="btn-filtro" href="#" >Filtros <i class="bi bi-caret-down-fill"></i></a>
                <nav class="col-12 col-md-12 col-filtro d-none d-md-block " id="nav-filtro">
                    <a href="?filtro=todos">Todos</a>
                    <a href="?filtro=adaptador">Adaptador</a>
                    <a href="?filtro=balanceador">Balanceador</a>
                </nav>
            </article>


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
                                            <a href="' . $produto["info"]["img"] . '" target="_blank" class="btn-amarelo">Ver em guia separada</a>
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
                        </div>
                        ';
                    }
                }
            }
            ?>
        </article>

        </section>

    </main>

    <footer>
        <p>© 2024 Copyright: Nacar - Todos os direitos reservados</p>
    </footer>
</body>
<script>
const btnfiltro = document.querySelector('#btn-filtro')
const nav_filtro = document.querySelector('#nav-filtro')

btnfiltro.addEventListener("click", function() {
    nav_filtro.classList.toggle('aparecer-filtro')
      
    })
</script>
</html>