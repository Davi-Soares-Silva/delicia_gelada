<?php

require_once("header.php");

$nome = (string) null;
$telefone = (string) null;
$rua = (string) null;
$cidade = (string) null;
$uf = (string) null;
$cep = (string) null;
$mapa = (string) null;
$btnFrmLojas = (string) "Salvar";


if (isset($_GET['modo'])) {
    $id_loja = $_GET['codigo'];
    if ($_GET['modo'] == "editar") {
        $sql = "SELECT * FROM tbl_nossas_lojas WHERE id =" . $id_loja;
        $select = mysqli_query($conexao, $sql);


        if ($rs = mysqli_fetch_array($select)) {
            $nome = $rs['nome'];
            $telefone = $rs['telefone'];
            $rua = $rs['rua'];
            $cidade = $rs['municipio'];
            $uf = $rs['uf'];
            $cep = $rs['cep'];
            $mapa = $rs['link_mapa'];
        }

        $btnFrmLojas = "Editar";
        $_SESSION["id_loja"] = $id_loja;
    }
}

?>

<div id="container_conteudo_cms">
    <div class="conteudo center">
        <div id="container_titulo_mensagem_adms">
            <h1>Nossas Lojas</h1>
        </div>

        <div id="container_frm_nossas_lojas">
            <form action="bd/crud_nossas_lojas.php" method="POST" name="frmNossasLojas">
                <div class="linha_frm_nossas_lojas">
                    <input type="text" name="txtNomeLoja" value="<?= $nome ?>"> Nome: <br>
                </div>
                <input type="text" name="txtTelefoneLoja" value="<?= $telefone ?>"> Telefone: <br>
                <input type="text" name="txtRuaLoja" value="<?= $rua ?>"> Rua: <br>
                <input type="text" name="txtCidadeLoja" value="<?= $cidade ?>"> Cidade: <br>
                <input type="text" name="txtUfLoja" value="<?= $uf ?>"> UF: <br>
                <input type="text" name="txtCepLoja" value="<?= $cep ?>"> Cep: <br>
                <input type="text" name="txtMapaLoja" value="<?= $mapa ?>"> Mapa: <br>

                <input type="submit" value="<?= $btnFrmLojas ?>" name="btnSalvarLoja">


            </form>
        </div>
        <div id="container_tbl_visualizar_lojas" class="center">
            <div class="linha_tbl_lojas center">
                <div class="coluna_tbl_lojas titulo"><span>Nome</span></div>
                <div class="coluna_tbl_lojas titulo"><span>Telefone</span></div>
                <div class="coluna_tbl_lojas titulo"><span>Rua</span></div>
                <div class="coluna_tbl_lojas titulo"><span>Municipio</span></div>
                <div class="coluna_tbl_lojas uf titulo"><span>UF</span></div>
                <div class="coluna_tbl_lojas titulo"><span>CEP</span></div>
                <div class="coluna_tbl_lojas titulo acoes"><span>Ações</span></div>
            </div>

            <?php

            $sql = "SELECT * FROM tbl_nossas_lojas";

            $select = mysqli_query($conexao, $sql);

            while ($rs = mysqli_fetch_array($select)) {
                if ($rs['status'] == 1) {
                    $modo = "desativar";
                    $img_status = "imagens/ativado_icon.png";
                } else {
                    $modo = "ativar";
                    $img_status = "imagens/desativado_icon.png";

                }

                ?>
                <div class="linha_tbl_lojas center">
                    <div class="coluna_tbl_lojas"><span><?= $rs['nome'] ?></span></div>
                    <div class="coluna_tbl_lojas"><span><?= $rs['telefone'] ?></span></div>
                    <div class="coluna_tbl_lojas"><span><?= $rs['rua'] ?></span></div>
                    <div class="coluna_tbl_lojas"><span><?= $rs['municipio'] ?></span></div>
                    <div class="coluna_tbl_lojas"><span><?= $rs['uf'] ?></span></div>
                    <div class="coluna_tbl_lojas uf"><span><?= $rs['cep'] ?></span></div>
                    <div class="coluna_tbl_lojas acoes"><span>
                            <a href="bd/crud_nossas_lojas.php?modo=excluir&codigo=<?= $rs['id'] ?>"><img class="excluir" src="imagens/excluir_icon64.png" alt=""></a>
                            <a href="visualizar_nossas_lojas.php?modo=editar&codigo=<?= $rs['id'] ?>"><img src="imagens/editar_icon.png" alt=""></a>
                            <a href="bd/crud_nossas_lojas.php?modo=<?= $modo ?>&codigo=<?= $rs['id'] ?>"><img src="<?=$img_status?>" alt=""></a>
                        </span></div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</div>


<?php
require_once("footer.html");

?>