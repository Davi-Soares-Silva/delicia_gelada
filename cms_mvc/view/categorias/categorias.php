<?php

$action = (string) "router.php?controller=categoria&modo=inserir";
$nome = (string) null;


    if(isset($_GET['modo'])){
        if(strtoupper($_GET['modo']) == "BUSCAR"){
            $nome = $categoriaDados->getNome();
            $codigo = $categoriaDados->getId();

            $action = "router.php?controller=categoria&modo=editar&codigo=".$codigo;
        }
    }

?>

<div class="container_titulo">
    <h1>Novo Categoria</h1>
</div>
<div id="container_frm_produtos" class="center">
    <form action="<?=$action?>" method="POST" name="frmCategoria" id="frm_categoria">
        <input type="text" placeholder="Nome" name="txtNome" value="<?=$nome?>">
        <input type="submit" value="enviar">
    </form>
</div>

<div class="container_tabela categorias center">
    <div class="linha_tbl titulo">
        <div class="coluna_tbl imagem">
            <h1>Nome</h1>
        </div>
        <div class="coluna_tbl acao">
            <h1>Ações</h1>
        </div>
    </div>

    <?php

    // Importando a controller de categorias
    require_once('controller/CategoriaController.php');

    // Criando uma controller de categorias
    $dadosCategorias = new CategoriaController();

    // Criando uma variável que irá receber toda a lista de Categorias
    $categorias = $dadosCategorias->listarTodas();

    $cont = 0;

    while ($cont < sizeof($categorias)) {

        if($categorias[$cont]->getStatus() == 1){
            $imagemStatus = "ativado_icon.png";
        }else{
            $imagemStatus = "desativado_icon.png";
        }
        ?>
        <div class="linha_tbl">
            <div class="coluna_tbl imagem">
                <span><?=$categorias[$cont]->getNome()?></span>
            </div>
            <div class="coluna_tbl acao">
                <div class="coluna_acao"> <a href="router.php?controller=categoria&modo=excluir&codigo=<?=$categorias[$cont]->getId()?>"><img src="view/images/excluir_icon64.png" alt="nao encontrada" class="excluir"></a> </div>
                <div class="coluna_acao"><a href="router.php?controller=categoria&modo=buscar&codigo=<?=$categorias[$cont]->getId()?>"><img src="view/images/editar_icon64.png" alt=""></a></div>
                <div class="coluna_acao"><a href="router.php?controller=categoria&modo=status&codigo=<?=$categorias[$cont]->getId()?>&status=<?=$categorias[$cont]->getStatus()?>"><img src="view/images/<?= $imagemStatus ?>" alt=""></a></div>
            </div>
        </div>

    <?php
    $cont++;
        }
    ?>
</div>