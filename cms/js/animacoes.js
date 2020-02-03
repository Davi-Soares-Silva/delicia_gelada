$(document).ready(function () {


    // Colocando eventos para capturar o texto do input e colocar no preview do card
    $('.txtTituloCuriosidade').keyup(function () { 
        var texto = $('.txtTituloCuriosidade').val();
        $('#titulo_preview_card_curiosidade').text(texto);
    });

    // Colocando eventos para capturar o texto do input e colocar no preview do card
    $('#txt_descricao_curiosidade').keyup(function () { 
        var textoDescricao = $('#txt_descricao_curiosidade').val();
        $('#desc_preview_card_curiosidade').text(textoDescricao);
    });

    // Verificando se os inputs do formulário estão com focus para fazer o flip do card
    $('#txt_descricao_curiosidade').focus(function () { 
        $('.frente').addClass('virado');
        $('.fundo').addClass('virado');
        
    });

    $('#txt_descricao_curiosidade').blur(function () { 
        $('.frente').removeClass('virado');
        $('.fundo').removeClass('virado');

    });
});

