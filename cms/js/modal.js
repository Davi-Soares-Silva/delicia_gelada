// Arquivo para todos as animações dos modais


// Comando para ativar todas as funções do JQuery
$(document).ready(function () {

    // Verificando se o container do formulario tem a classe editar, para assim poder fazer o container abrir
    if($('#container_formulario_curiosidade').hasClass("editar")){
        $("#container_formulario_curiosidade").slideToggle(2000);
        $(window).scrollTop(600);
    }
    // Modal de visualizar informações de
    // mensagens dos clientes
    $('.btn_visualizar').click(function (){ 
        $('#container_modal').fadeIn(1000);
    });

    $('#fechar_modal').click(function () { 
        $('#container_modal').fadeOut(1000);
    });
    
    // Modal para excluir itens
    $('.btn_excluir').click(function(){
        $('#container_modal_excluir').fadeIn('fast');
    });

    $('.btn_excluir_usuario').click(function () { 
        $('#container_modal_excluir').fadeIn('fast');
        
    });

    $('.btn_excluir_nivel').click(function () { 
        $('#container_modal_excluir').fadeIn('fast');
        
    });

    $('.btn_excluir_curiosidade').click(function () { 
        $('#container_modal_excluir').fadeIn('fast'); 
    });

    $('.btn_fechar_modal_excluir').click(function () { 
        $('#container_modal_excluir').fadeOut('fast');
        
    });


    $('.btnExcluirSobre').click(function () { 
        $('#container_modal_excluir').fadeIn('fast');
    });

    // Modal para adicionar usuários
    $('#btn_modal_add_usuario').click(function(){
        $('#container_modal_adicionar_usuario').fadeIn(1000);
    });

    $('.btn_editar_usuario').click(function () { 
        $('#container_modal_adicionar_usuario').fadeIn(1000);
    });
    
    $('#container_btn_fechar').click(function () { 
        $('#container_modal_adicionar_usuario').fadeOut('fast');
        
    });

    // Modal para Adicionar ou editar Níveis de usuários
    $('#btn_modal_nivel_usuario').click(function () { 
        $('#container_modal_niveis').fadeIn(1000);
        
    });

    $('.btn_editar_nivel').click(function () { 
        $('#container_modal_niveis').fadeIn(1000);
        
    });

    $('#container_btn_fechar_modal_nivel').click(function (e) { 
        $('#container_modal_niveis').fadeOut('fast');
    });


    // Modal para o crud completo de curiosidades
    $('#btn_adicionar_curiosidade').click(function () { 
        $('#container_formulario_curiosidade').slideToggle(2000);
    });

    $('#btn_cancelar_curiosidade').click(function () { 
        $('#container_modal_add_curiosidade').fadeOut(1000);
    });

    $('.card_curiosidade_adm').click(function () { 
        $('#container_modal_visualizar_curiosidade').fadeIn(1000);
    });

    // Modal para inserção e edição de sessões sobre a empresa
    $('#btn_adicionar_sobre').click(function () { 
        $('#container_modal_sobre').fadeIn(1000);
    });

    $('#container_btn_fechar_modal_sobre').click(function () { 
        $('#container_modal_sobre').fadeOut(1000);
    });

    if($('#container_modal_sobre').hasClass('aberto')){
        $('#container_modal_sobre').fadeIn(1000);
    };


});



