<?php

$preco = (string) null;
$desconto = (string) null;



if (isset($_GET['modo'])) {
    if (strtoupper($_GET['modo']) == "BUSCAR_PROMOCAO") {
        
        
        $preco = $produtoDados->getPreco();
        $desconto = $produtoDados->getDesconto();

        $action = "router.php?controller=produto&modo=editar_promocao&codigo=" . $codigo;
    }
}

?>
<div class="container_titulo">
    <h1>Novo Produto</h1> <a href="index.php?page=produto_mes">Produto do Mês</a> <a href="index.php?page=promocoes">Promoções</a>
</div>
<div id="container_frm_produtos" class="center">
    <form action="<?= $action ?>" method="POST" name="frmProduto" id="frm_produto">
        <input type="text" placeholder="Preco" name="txtPreco" value="<?= $preco ?>">
        <input type="number" placeholder="Desconto em %" name="txtDesconto" value="<?= $desconto ?>">
        <input type="submit" value="enviar">
    </form>
</div>

<div class="container_tabela center">
    <div class="linha_tbl titulo">
        <div class="coluna_tbl">
            <h1>Nome</h1>
        </div>
        <div class="coluna_tbl">
            <h1>Preço</h1>
        </div>
        <div class="coluna_tbl">
            <h1>Desconto</h1>
        </div>
        <div class="coluna_tbl">
            <h1>Ações</h1>
        </div>
    </div>

    <?php

    // Import do controller de Produtos
    require_once(__DIR__ . '/../../controller/ProdutoController.php');

    // Criação de um controller de produtos
    $dadosProduto = new ProdutoController();

    // Criação de um Produto que recebe toda a lista de produtos
    $produtos = $dadosProduto->listarProdutos();

    $cont = 0;
    while ($cont < sizeof($produtos)) {
        if ($produtos[$cont]->getPromocao() == 1) {
            $imagemStatus = "view/images/ativado_icon.png";
        } else {
            $imagemStatus = "view/images/desativado_icon.png";
        }

        $desconto = $produtos[$cont]->getDesconto();
        $desconto = '0.'.$desconto;
        ?>
        <div class="linha_tbl">
            <div class="coluna_tbl">
                <span><?= $produtos[$cont]->getNome(); ?></span>
            </div>
            <div class="coluna_tbl">
                <span>R$ <?= $produtos[$cont]->getPreco(); ?></span>
            </div>
            <div class="coluna_tbl">
               <span><?=$produtos[$cont]->getDesconto()?>% | R$ <?= round(($produtos[$cont]->getPreco() * $desconto), 2)?></span>
            </div>
            <div class="coluna_tbl acao">
                <div class="coluna_acao"><a href="router.php?controller=produto&modo=buscar_promocao&codigo=<?= $produtos[$cont]->getCodigo(); ?>"><img src="view/images/editar_icon64.png" alt=""></a></div>
                <div class="coluna_acao"><a href="router.php?controller=produto&modo=status_promocao&codigo=<?= $produtos[$cont]->getCodigo(); ?>&status=<?= $produtos[$cont]->getPromocao(); ?>"><img src="<?= $imagemStatus ?>" alt=""></a></div>
            </div>
        </div>

    <?php
        $cont++;
    }
    ?>
</div>