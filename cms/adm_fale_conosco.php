<?php

$nome = (string) null;
$email = (string) null;
$profissao = (string) null;
$tipoMensagem = (string) null;
$sexo = (string) null;
$telefone = (string) null;
$celular = (string) null;
$homepage = (string) null;
$link_facebook = (string) null;
$mensagem = (string) null;
$modo = (string) null;
$optCriticaSel = (string) null;
$optSugestaoSel = (string) null;
$filtroTipo = (string) "T";

if (isset($_POST['slcFiltro'])) {
    $filtroTipo = $_POST['slcFiltro'];
    // echo("<script>alert('Foi')</script>");
    if ($filtroTipo == "C") {
        $optCriticaSel = "selected";
    } elseif ($filtroTipo == "S") {
        $optSugestaoSel = "selected";
    }
}

// Importando o cabeçalho do CMS
require_once("header.php");

?>


<!-- Área do Modal para exibir informações do cliente e sua mensagem -->
<div id="container_modal">
    <div id="modal" class="center">
        <!-- Área do modal apenas para fechá-lo -->
        <div id="container_fechar">
            <div id="container_cabecalho_fechar">

            </div>
            <div id="container_imagem_fechar">
                <button class="background" id="fechar_modal"></button>
            </div>
        </div>
        <div id="conteudo_modal">

        </div>
    </div>
</div>



<!-- container do modal de exclusao -->
<div id="container_modal_excluir">
    <div id="modal_excluir" class="center">
       
    </div>
</div>

<!-- Área do conteudo que será administrado no cms -->
<div id="container_conteudo_cms">
    <div class="conteudo center">
        <div id="container_titulo_mensagem_adms">
            <h1>Mensagens dos nossos clientes</h1>
        </div>
        <div id="container_filtro_mensagens">
            <form name="frm_filtrar" action="adm_fale_conosco.php" method="POST">
                <label>Selecione o Tipo: </label>
                <select name="slcFiltro" id="slc_filtro" onchange="this.form.submit()">
                    <option value="T">Todos</option>
                    <option value="C" <?= $optCriticaSel ?>>Crítica</option>
                    <option value="S" <?= $optSugestaoSel ?>>Sugestão</option>
                </select>
                <!-- <input type="submit" value="Filtrar" name="btnFiltrar"> -->
            </form>
        </div>
        <div id="container_lista_mensagens">
            <div id="lista_mensagens" class="center">
                <div id="titulo_colunas_lista">
                    <div class="cabecalho_lista_mensagens">
                        <h1>Nome</h1>
                    </div>
                    <div class="cabecalho_lista_mensagens">
                        <h1>E-mail</h1>
                    </div>
                    <div class="cabecalho_lista_mensagens">
                        <h1>Profissão</h1>
                    </div>
                    <div class="cabecalho_lista_mensagens tipo_mensagem">
                        <h1>Tipo de Msg</h1>
                    </div>
                </div>

                <?php
                    
                $sql = "SELECT * FROM tbl_contato";

                if ($filtroTipo != "T") {
                    $sql = $sql . " WHERE tipo_mensagem = ". "'$filtroTipo'";
                }


                $select = mysqli_query($conexao, $sql);

                while ($rs = mysqli_fetch_array($select)) {
                    if ($rs['tipo_mensagem'] == "S") {
                        $tipoMensagem = "Sugestão";
                    } else {
                        $tipoMensagem = "Crítica";
                    }
                    ?>

                    <div class="linha_lista_mensagens">
                        <div class="coluna_lista_mensagens">
                            <span><?= ($rs['nome']) ?></span>
                        </div>
                        <div class="coluna_lista_mensagens">
                            <span><?= ($rs['email']) ?></span>
                        </div>
                        <div class="coluna_lista_mensagens">
                            <span><?= ($rs['profissao']) ?></span>
                        </div>
                        <div class="coluna_lista_mensagens tipo_mensagem ">
                            <span><?= ($tipoMensagem) ?></span>
                        </div>
                        <div class="coluna_lista_mensagens acao visualizar background"><a href="#" class="btn_visualizar" onclick="visualizarDados(<?= $rs['codigo'] ?>);"><img src="imagens/visualizar_icon.png" alt="icone_visualizar"></a></div>
                        <div class="coluna_lista_mensagens acao excluir background"><a href="#" class="btn_excluir" onclick="excluirMensagemCliente(<?= $rs['codigo'] ?>, '<?= $rs['nome'] ?>');"><img src="imagens/excluir_icon.png" alt="icone_excluir"></a></div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Importando o rodapé do CMS -->
<?php
require_once("footer.html");
?>
</body>

</html>