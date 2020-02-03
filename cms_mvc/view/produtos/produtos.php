<?php


$action = (string) "router.php?controller=produto&modo=inserir";
$codigo = (string) null;
$nome = (string) null;
$preco = (string) null;
$descricao = (string) null;
$imagem = (string) null;
$porcentagem_desconto  = (string) null;
$idSubcategoria = (string) null;
$slcCategoria = (string) null;



if (isset($_GET['modo'])) {
    if (strtoupper($_GET['modo']) == "BUSCAR") {
        $nome = $produtoDados->getNome();
        $codigo = $produtoDados->getCodigo();
        $preco = $produtoDados->getPreco();
        $descricao = $produtoDados->getDescricao();
        $imagem = $produtoDados->getImagem();
        $porcentagem_desconto = $produtoDados->getDesconto();
        $idSubcategoria = $produtoDados->getIdSubcategoria();

        $action = "router.php?controller=produto&modo=editar&codigo=" . $codigo;
    }
}

?>
<div class="container_titulo">
    <h1>Novo Produto</h1> <a href="index.php?page=produto_mes">Produto do Mês</a> <a href="index.php?page=promocoes">Promoções</a>
</div>
<div id="container_frm_produtos" class="center">
    <form action="<?= $action ?>" method="POST" name="frmProduto" id="frm_produto" enctype="multipart/form-data">
        <input type="text" placeholder="Nome" name="txtNome" value="<?= $nome ?>">
        <input type="text" placeholder="Preco" name="txtPreco" value="<?= $preco ?>">
        <input type="number" placeholder="Desconto em %" name="txtDesconto" value="<?= $porcentagem_desconto ?>">
        <input type="file" placeholder="foto" name="fileFoto">
        <textarea type="text" placeholder="Descrição" name="txtDescricao"><?= $descricao ?></textarea>
        <select name="slcCategoria" id="slc_categoria">
            <?php
            // Importando e instanciando a Controller de Categorias
            require_once('controller/SubCategoriaController.php');
            $controllerSubCategoria = new SubCategoriaController();

            $subCategorias = $controllerSubCategoria->listarTodas();

            $cont = 0;

            while($cont < sizeof($subCategorias)){
                if($idSubcategoria == $subCategorias[$cont]->getId()){
                    $slc = "selected";
                }else{
                    $slc = null;
                }
            ?>
                <option value="<?=$subCategorias[$cont]->getId()?>" <?=$slc?>><?=$subCategorias[$cont]->getNome()?> > <?=$subCategorias[$cont]->getCategoria()?></option>
            <?php
            $cont++;
            }
            ?>
        </select>

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
            <h1>Imagem</h1>
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
        if ($produtos[$cont]->getStatus() == 1) {
            $imagemStatus = "view/images/ativado_icon.png";
        } else {
            $imagemStatus = "view/images/desativado_icon.png";
        }

        ?>
        <div class="linha_tbl">
            <div class="coluna_tbl">
                <span><?= $produtos[$cont]->getNome(); ?></span>
            </div>
            <div class="coluna_tbl">
                <span><?= $produtos[$cont]->getPreco(); ?></span>
            </div>
            <div class="coluna_tbl imagem">
                <img src="model/arquivos/<?= $produtos[$cont]->getImagem() ?>" alt="">
            </div>
            <div class="coluna_tbl acao">
                <div class="coluna_acao"> <a href="router.php?controller=produto&modo=excluir&codigo=<?= $produtos[$cont]->getCodigo() ?>&imagem=<?= $produtos[$cont]->getImagem() ?>"><img src="view/images/excluir_icon64.png" alt="nao encontrada" class="excluir"></a> </div>
                <div class="coluna_acao"><a href="router.php?controller=produto&modo=buscar&codigo=<?= $produtos[$cont]->getCodigo(); ?>"><img src="view/images/editar_icon64.png" alt=""></a></div>
                <div class="coluna_acao"><a href="router.php?controller=produto&modo=status&codigo=<?= $produtos[$cont]->getCodigo(); ?>&status=<?= $produtos[$cont]->getStatus(); ?>"><img src="<?= $imagemStatus ?>" alt=""></a></div>
            </div>
        </div>

    <?php
        $cont++;
    }
    ?>
</div>