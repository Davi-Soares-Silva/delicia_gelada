<?php
// Criando uma conexão com o BD
require_once("conexao.php");
$conexao = conexaoMysql();

// Verificando se o modo está vindo pela URL
if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];
    // Criando uma variável que recebe o código que veio na url
    $codigo = $_GET['codigo'];

    // Verificando se o modo é o de excluir
    if ($modo == "excluir") {
        $sqlExcluir = "DELETE FROM tbl_contato WHERE codigo=" . $codigo;

        if (mysqli_query($conexao, $sqlExcluir)) {
            header('location: ../cms/adm_fale_conosco.php');
        } else {
            echo ("Erro ao excluir");
            echo ($sqlExcluir);
        }
    }
    // Verificando se o modo está vindo via Post
} elseif (isset($_POST['modo'])) {
    $modo = $_POST['modo'];
    $codigo = $_POST['codigo'];

    // Verificando se o modo é para confirmar a exclusão
    if ($modo == "confirmarExclusao") {
        $tipoExclusao = $_POST['tipo_exclusao'];

        if ($tipoExclusao == 'usuario') {
            $pagina = "../cms/bd/crud_usuario.php";
            $pagina_origem = "../cms/visualizar_usuarios.php";
        } elseif ($tipoExclusao == 'mensagem') {
            $pagina = "../bd/modal_excluir.php";
            $pagina_origem = "../cms/adm_fale_conosco.php";
        } elseif ($tipoExclusao == 'curiosidade') {
            $pagina = "../cms/bd/crud_curiosidade.php";
            $pagina_origem = "../cms/visualizar_curiosidades.php";
        } elseif ($tipoExclusao == 'sobre') {
            $img = $_POST['img'];
            $pagina = "../cms/bd/crud_sobre.php";
            $pagina_origem = "../cms/visualizar_sobre.php";
        }
        ?>

        <!-- Devolvendo um modal para confirmar a exclusão -->
        <div id="modal_excluir" class="center">
            <div id="titulo_modal_excluir">
                <h1>Deseja Realmente excluir?</h1>
            </div>
            <div id="container_mensagem_exclusao">
                <h2>Ao confirmar você perderá todas as informações do item selecionado.</h2>
            </div>
            <div id="container_botoes_modal_excluir">
                <a class="cancelar" href="<?= $pagina_origem ?>">Cancelar</a>
                <!-- Colocando um link no botão de confirmar que redireicona para essa mesma página,
                 só que com o modo igual a excluir e passando o mesmo código -->

                <?php
                     if ($tipoExclusao != 'sobre') {
                        echo ("<a class='confirmar' href='$pagina?modo=excluir&codigo=$codigo'>Confirmar</a>");
                    } else {
                        echo ("<a class='confirmar' href='$pagina?modo=excluir&codigo=$codigo&img=$img'>Confirmar</a>");
                    }
                ?>
            </div>
        </div>


        <?php
            }
            if ($_POST['modo'] == 'confirmarExclusaoNivel') {
                $tipoExclusao = $_POST['tipo_exclusao'];
                if ($tipoExclusao == "nivel") {
                    $pagina = "../cms/bd/crud_nivel.php";
                    $pagina_origem = "../cms/visualizar_niveis.php";
                    $sql = "SELECT * FROM tbl_nivel_usuarios INNER JOIN tbl_usuarios ON tbl_nivel_usuarios.id_nivel = tbl_usuarios.id_nivel WHERE tbl_nivel_usuarios.id_nivel =" . $codigo;
                    $select = mysqli_query($conexao, $sql);
                    $rs = mysqli_fetch_array($select);
                    if (is_array($rs)) {
                        ?> <div id="modal_excluir" class="center nivel">
                    <div id="container_titulo_modal_excluir" class="nivel">
                        <h1>Não é possível excluir.</h1>
                    </div>
                    <div id="container_conteudo_modal_excluir" class="nivel">
                        <span>Existem um ou mais usuários utilizando este nível!</span>
                    </div>
                    <div id="container_btn_excluir_nivel">
                        <a href="visualizar_niveis.php">OK</a>
                    </div>
                </div>
            <?php
                        } else {
                            ?>
                <div id="modal_excluir" class="center">
                    <div id="titulo_modal_excluir">
                        <h1>Deseja Realmente excluir?</h1>
                    </div>
                    <div id="container_mensagem_exclusao">
                        <h2>Ao confirmar você perderá todas as informações do item selecionado.</h2>
                    </div>
                    <div id="container_botoes_modal_excluir">
                        <a class="cancelar" href="<?= $pagina_origem ?>">Cancelar</a>
                        <!-- Colocando um link no botão de confirmar que redireicona para essa mesma página,
                    só que com o modo igual a excluir e passando o mesmo código -->
                        <a class="confirmar" href="<?= $pagina ?>?modo=excluir&codigo=<?= $codigo ?>">Confirmar</a>
                    </div>
                </div>
<?php
            }
        }
    }
}
?>