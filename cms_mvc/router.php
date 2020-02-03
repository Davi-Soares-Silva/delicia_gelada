<?php

$controller = (string) null;
$modo = (string) null;

if(isset($_GET['controller']) && isset($_GET['modo'])){
    $controller = $_GET['controller'];
    $modo = $_GET['modo'];

    if(isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
    }

    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }

    if(isset($_GET['imagem'])){
        $imagem = $_GET['imagem'];
    }

    switch(strtoupper($controller)){
        case "PRODUTO":
            // Import da classe de Controller
            require_once("controller/produtoController.php");

            // Instânciando o controller de produtos
            $controllerProduto = new ProdutoController();

            switch(strtoupper($modo)){
                case "INSERIR":
                    // Chamando o método da Controller para inserir um novo produto
                    $controllerProduto->novoProduto();

                break;

                case "EXCLUIR":
                    // Chamando o método da controller para excluir um produto
                    $controllerProduto->deletarProduto($codigo, $imagem);

                break;

                case "STATUS":
                    // Chamando o método da controller para ativar ou desativar um produto
                    $controllerProduto->alterarStatus($codigo, $status);
                
                break;

                case "BUSCAR":
                    // Chamando o método da controller para atualizar um produto
                    // passando o seu código
                    $controllerProduto->buscarPorId($codigo);
                break;

                case "EDITAR":
                    $controllerProduto->atualizarProduto($codigo);
                break;

                case "ATUALIZAR_PRODUTO_MES": 
                    $controllerProduto->definirProdutoMes($codigo, $status);
                break;

                case "BUSCAR_PRODUTO_MES":
                    $controllerProduto->buscarProdutoMes($codigo);
                break;

                case "EDITAR_PRODUTO_MES":
                    $controllerProduto->editarProdutoMes($codigo);
                break;

                case "STATUS_PROMOCAO":
                    $controllerProduto->statusPromocao($codigo, $status);
                break;

                case "BUSCAR_PROMOCAO":
                    $controllerProduto->buscarPromocao($codigo);
                break;

                case "EDITAR_PROMOCAO":
                    $controllerProduto->editarPromocao($codigo);
                break;
            }

        break;

        case "CATEGORIA":

            // Importando o Controller de Categoria
            require_once('controller/CategoriaController.php');
            $controllerCategoria = new CategoriaController();

            switch(strtoupper($modo)){
                
                case "INSERIR":
                    $controllerCategoria->inserirCategoria();
                break;

                case "EXCLUIR":
                    $controllerCategoria->deletarCategoria($codigo);
                break;

                case "BUSCAR":
                    $controllerCategoria->buscarPorId($codigo);
                break;
                
                case "EDITAR":
                    $controllerCategoria->atualizarCategoria($codigo);
                break;

                case "STATUS":
                    $controllerCategoria->alterarStatus($codigo, $status);
                break;
            }
        break;

        case "SUB_CATEGORIA":
            // Importando e instânciando uma controller de subCategoria
            require_once('controller/SubCategoriaController.php');
            $controllerSubCategoria = new SubCategoriaController();

            switch (strtoupper($modo)) {
                case "INSERIR":
                    $controllerSubCategoria->inserirSubCategoria();
                break;
                
                case "EDITAR":
                    $controllerSubCategoria->atualizarSubCategoria($codigo);
                break;

                case "STATUS":
                    $controllerSubCategoria->alterarStatus($codigo, $status);
                break;

                case "BUSCAR":
                    $controllerSubCategoria->buscarSubCategoriaPorId($codigo);
                break;

                case "EXCLUIR":
                    $controllerSubCategoria->deletarSubCategoria($codigo);
                break;
            }
        break;

    }
}


?>