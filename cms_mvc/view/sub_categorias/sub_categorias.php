<?php

$action = (string) "router.php?controller=sub_categoria&modo=inserir";
$nome = (string) null;
$idCategoria = (string) null;
$slcCategoria = (string) null;


if (isset($_GET['modo'])) {
    if (strtoupper($_GET['modo']) == "BUSCAR") {
        $nome = $dadosSubCategoria->getNome();
        $idCategoria = $dadosSubCategoria->getIdCategoria();
        $codigo = $dadosSubCategoria->getId();

        $action = "router.php?controller=sub_categoria&modo=editar&codigo=" . $codigo;
    }
}

?>

<div class="container_titulo">
    <h1>Nova Sub-Categoria</h1>
</div>
<div id="container_frm_produtos" class="center">
    <form action="<?= $action ?>" method="POST" name="frmSubCategoria" id="frm_sub_categoria">
        <input type="text" placeholder="Nome" name="txtNome" value="<?= $nome ?>">
        <select name="slcCategoria" id="slc_categoria">
            <?php
            // Importando e instanciando a Controller de Categorias
            require_once('controller/CategoriaController.php');
            $controllerCategoria = new CategoriaController();
            

            $categorias = $controllerCategoria->listarTodas();

            $cont = 0;

            while ($cont < sizeof($categorias)) {
                if($idCategoria == $categorias[$cont]->getId()){
                    $slcCategoria = "selected";
                }else{
                    $slcCategoria = null;
                }
                ?>
                <option value="<?=$categorias[$cont]->getId()?>" <?=$slcCategoria?>><?=$categorias[$cont]->getNome()?></option>
            <?php
            $cont++;
            }
            ?>
        </select>
        <input type="submit" value="enviar">
    </form>
</div>

<div class="container_tabela categorias center">
    <div class="linha_tbl titulo">
        <div class="coluna_tbl categorias">
            <h1>Nome</h1>
        </div>
        <div class="coluna_tbl categorias">
            <h1>Categoria</h1>
        </div>
        <div class="coluna_tbl acao">
            <h1>Ações</h1>
        </div>
    </div>

    <?php

    // Importando a controller de categorias
    require_once('controller/SubCategoriaController.php');

    // Criando uma controller de categorias
    $dadosSubCategorias = new SubCategoriaController();

    // Criando uma variável que irá receber toda a lista de Categorias
    $subCategorias = $dadosSubCategorias->listarTodas();

    $cont = 0;

    while ($cont < sizeof($subCategorias)) {

        if ($subCategorias[$cont]->getStatus() == 1) {
            $imagemStatus = "ativado_icon.png";
        } else {
            $imagemStatus = "desativado_icon.png";
        }
        ?>
        <div class="linha_tbl">
            <div class="coluna_tbl categorias">
                <span><?= $subCategorias[$cont]->getNome() ?></span>
            </div>
            <div class="coluna_tbl categorias">
                <span><?= $subCategorias[$cont]->getCategoria() ?></span>
            </div>
            <div class="coluna_tbl acao">
                <div class="coluna_acao"> <a href="router.php?controller=sub_categoria&modo=excluir&codigo=<?= $subCategorias[$cont]->getId() ?>"><img src="view/images/excluir_icon64.png" alt="nao encontrada" class="excluir"></a> </div>
                <div class="coluna_acao"><a href="router.php?controller=sub_categoria&modo=buscar&codigo=<?= $subCategorias[$cont]->getId() ?>"><img src="view/images/editar_icon64.png" alt=""></a></div>
                <div class="coluna_acao"><a href="router.php?controller=sub_categoria&modo=status&codigo=<?= $subCategorias[$cont]->getId() ?>&status=<?= $subCategorias[$cont]->getStatus() ?>"><img src="view/images/<?= $imagemStatus ?>" alt=""></a></div>
            </div>
        </div>

    <?php
        $cont++;
    }
    ?>
</div>