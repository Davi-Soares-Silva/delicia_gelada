<?php
require_once("header.php");
?>

<div id="container_conteudo_cms">
    <div class="conteudo center cards_adm">
        <div id="container_titulo_adm_conteudo">
            <div id="container_titulo_mensagem_adms">
                <h1>Conteúdos do Site</h1>
            </div>
        </div>
        <div id="container_cards_adm_conteudo">
            <div class="card_adm_conteudo">
                <div class="container_imagem_adm_card produtos">

                </div>
                <div class="container_titulo_card_adm">
                    <h1>Produtos</h1>
                </div>
            </div>
            <a href="visualizar_sobre.php">
                <div class="card_adm_conteudo">
                    <div class="container_imagem_adm_card sobre">

                    </div>
                    <div class="container_titulo_card_adm">
                        <h1>Sobre</h1>
                    </div>
                </div>
            </a>
            <a href="visualizar_nossas_lojas.php">
                <div class="card_adm_conteudo">
                    <div class="container_imagem_adm_card lojas">

                    </div>
                    <div class="container_titulo_card_adm">
                        <h1>Nossas Lojas</h1>
                    </div>
                </div>
            </a>
            <div class="card_adm_conteudo">
                <div class="container_imagem_adm_card promocao">

                </div>
                <div class="container_titulo_card_adm">
                    <h1>Promoções</h1>
                </div>
            </div>
            <a href="visualizar_curiosidades.php" class="link_card">
                <div class="card_adm_conteudo">
                    <div class="container_imagem_adm_card curiosidade">

                    </div>
                    <div class="container_titulo_card_adm">
                        <h1>Curiosidades</h1>
                    </div>
                </div>
            </a>
            <div class="card_adm_conteudo">
                <div class="container_imagem_adm_card produto_mes">

                </div>
                <div class="container_titulo_card_adm">
                    <h1>Produto do Mês</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("footer.html");
?>