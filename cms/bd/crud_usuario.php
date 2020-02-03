<?php
require_once("../../bd/conexao.php");
$conexao = conexaoMysql();
session_start();

// Verifificando se o botão para salvar existe
if (isset($_POST['btn_salvar_usuario'])) {
    $nome = $_POST['txtNomeUsuario'];
    $email = $_POST['txtEmailUsuario'];
    $senha = $_POST['txtSenhaUsuario'];
    $data_nascimento = explode("/", $_POST['txtDataNascimentoUsuario']);
    $data_nascimento = $data_nascimento[2] . "-" . $data_nascimento[1] . "-" . $data_nascimento[0];
    $nivel = $_POST['slcNivel'];
    $sexo = $_POST['rdoSexoUsuario'];

// Verifificando se o botão para salvar é para adicionar
    if ($_POST['btn_salvar_usuario'] == 'Adicionar') {

        $sql = "INSERT INTO tbl_usuarios (nome, email, 
            senha, data_nascimento, id_nivel, sexo, ativado_usuario)
            
            VALUES ('" . $nome . "', '" . $email . "', '" . $senha . "',
             '" . $data_nascimento . "', '" . $nivel . "', '" . $sexo . "', 1)";

        if (mysqli_query($conexao, $sql)) {
            header("location: ../visualizar_usuarios.php");
        } else {
            echo ("Erro em algum lugar aí em, meo");
            echo ($sql);
        }

// Verifificando se o botão para salvar é para editar
    } elseif ($_POST['btn_salvar_usuario'] == "Atualizar") {

        $sql = "UPDATE tbl_usuarios SET
        nome ='" . $nome . "',
        email ='" . $email . "',
        senha = '" . $senha . "',
        data_nascimento = '" . $data_nascimento . "',
        id_nivel = '" . $nivel . "',
        sexo = '" . $sexo . "'
        WHERE id_usuario =" . $_SESSION['id_usuario'];

// Executando o Script no BD
        if (mysqli_query($conexao, $sql)) {
            header("location: ../visualizar_usuarios.php");
        } else {
            echo ("Erro em algum lugar aí em, meo");
            echo ($sql);
        }
    }

    // Verificando se o modo no GET existe
} elseif (isset($_GET['modo'])) {

    // Verificando se o modo passado pela url é o de ativar
    if ($_GET['modo'] == "ativacao") {
        $id_usuario = $_GET['id_usuario'];
        $sqlAtivacao = "UPDATE tbl_usuarios SET ativado_usuario = 1 WHERE id_usuario =" . $id_usuario;
        if (mysqli_query($conexao, $sqlAtivacao)) {
            header("location: ../visualizar_usuarios.php");
        } else {
            echo ("Tem parada errada aí, mermão");
        }

        // Verificando se o modo passado pela url é o de desativar
    } elseif ($_GET['modo'] == "desativacao") {
        $id_usuario = $_GET['id_usuario'];
        $sqlDesativacao = "UPDATE tbl_usuarios SET ativado_usuario = 0 WHERE id_usuario =" . $id_usuario;
        if (mysqli_query($conexao, $sqlDesativacao)) {
            header("location: ../visualizar_usuarios.php");
        } else {
            echo ("Tem parada errada aí, mermão");
        }

        // Verificando se o modo passado pela url é o de excluir
    } elseif ($_GET['modo'] == 'excluir') {
        $id_usuario = $_GET['codigo'];
        $sqlExcluir = "DELETE FROM tbl_usuarios WHERE id_usuario =" . $id_usuario;

        if (mysqli_query($conexao, $sqlExcluir)) {
            header("location: ../visualizar_usuarios.php");
        } else {
            echo ("Tem parada errada aí, mermão");
            echo ($sqlExcluir);
        }
    }

    // Verificando se o modo via POST existe
} elseif (isset($_POST['modo'])) {

    // Colocando o codigo na variavel de sessão para fazer o update
    $_SESSION['id_usuario'] = $_POST['codigo'];

    // Verificando se o modo é para carregar o usuário
    if ($_POST['modo'] == 'carregarUsuario') {

        // Fazendo o select para devolver as variaveis no modal
        $sqlCarregarUsuario = "SELECT tbl_usuarios.*, tbl_nivel_usuarios.id_nivel idn, tbl_nivel_usuarios.nome n FROM 
        tbl_usuarios INNER JOIN tbl_nivel_usuarios ON tbl_usuarios.id_nivel = tbl_nivel_usuarios.id_nivel WHERE id_usuario =" . $_SESSION['id_usuario'];


// Executando no Banco
        $selectCarregarUsuario = mysqli_query($conexao, $sqlCarregarUsuario);

        // Colocando o retorno do select em variáveis
        if ($rs = mysqli_fetch_array($selectCarregarUsuario)) {
            $nome = $rs['nome'];
            $email = $rs['email'];
            $data_nascimento = explode('-', $rs['data_nascimento']);
            $data_nascimento = $data_nascimento[2] . "/" . $data_nascimento[1] . "/" . $data_nascimento[0];
            $nivel = $rs['n'];
            $id_nivel = $rs['idn'];
            $sexo = $rs['sexo'];
            $chkMasc = null;
            $chkFem = null;

            // Definindo o checked de acordo com o retorno do banco
            if ($sexo == "M") {
                $chkMasc = "checked";
            } elseif ($sexo == "F") {
                $chkFem = "checked";
            }

            ?>

            <!-- Retornando o modal já com as variáveis nos values e com o value do botão como editar -->
            <div id="container_titulo_adicionar_usuario">
                <h1>Editar Usuário</h1>
            </div>
            <form action="bd/crud_usuario.php" id="frm_add_usuario" name="frmAddUsuario" method="POST">
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtNomeUsuario" value="<?= $nome ?>"> <label for="txtNomeUsuario">Nome</label>
                    </div>
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtDataNascimentoUsuario" value="<?= $data_nascimento ?>"> <label for="txtDataNascimentoUsuario">Data de Nascimento</label>
                    </div>
                </div>
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtEmailUsuario" value="<?= $email ?>"> <label for="txtEmailUsuario">Email</label>
                    </div>
                    <div class="coluna_frm_add_user">
                        <select name="slcNivel" id="">
                            <option value="<?= $id_nivel ?>"><?= $nivel ?></option>

                            <!-- Fazendo SELECT para trazer os níveis que já estão cadastrados -->
                            <?php
                                        $sqlNiveis = "SELECT id_nivel, nome FROM tbl_nivel_usuarios WHERE id_nivel <> 9 AND id_nivel <>". $id_nivel;

                                        $selectNiveis = mysqli_query($conexao, $sqlNiveis);

                                        while ($rs = mysqli_fetch_array($selectNiveis)) {
                                            ?>
                                <option value="<?= $rs['id_nivel'] ?>"><?= $rs['nome'] ?></option>
                            <?php
                                        }
                                        ?>
                        </select>
                    </div>
                </div>
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtSenhaUsuario"> <label for="txtSenhaUsuario">Nova Senha</label>
                    </div>
                    <div class="coluna_frm_add_user sexo">
                        <div class="coluna_sexo"><input type="radio" name="rdoSexoUsuario" value="M" <?= $chkMasc ?>></div>
                        <div class="coluna_sexo titulo"><span for="">Masculino</span></div>
                        <div class="coluna_sexo"><input type="radio" name="rdoSexoUsuario" value="F" <?= $chkFem ?>></div>
                        <div class="coluna_sexo titulo"><span for="">Feminino</span></div>
                    </div>
                </div>
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados"> <label for="">Confirmar Senha</label>
                    </div>
                    <div class="coluna_frm_add_user btn_adicionar">
                        <input type="submit" value="Atualizar" name="btn_salvar_usuario">
                    </div>
                </div>
            </form>
<?php
        } else {
            echo ($sqlCarregarUsuario);
        }
    }
}
?>