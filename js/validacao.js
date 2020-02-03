$(document).ready(function () {
    $('#frm_contato').validate({
        rules: {
            txtNome:{
                required: true,
                maxlength: 100,
                minlength: 4,
                letterswithbasicpunc: true,
                minWords: 2,
            },

            txtEmail:{
                required: true,
                maxlength: 150,
                email: true,
            },

            txtTelefone:{
                maxlength: 14,
                pattern: "[(][0-9]{2}[)] [0-9]{4}-[0-9]{4}",
            },

            txtCelular:{
                required: true,
                maxlength: 15,
                pattern: "[(][0-9]{2}[)] [0-9]{5}-[0-9]{4}",
            },

            txtProfissao:{
                required: true,
                maxlength: 150,
                minlength: 2,
            },

            txtHomePage:{
                url: true,
                maxlength: 200,
            },

            txtFacebook:{
                url: true,
                maxlength: 200,
            },

            txtMensagem:{
                required: true,
                minlength: 20,
                maxlength: 700,
                maxWords: 200,
            }
        }
    });

    $('#txt_telefone').mask("(00) 0000-0000");
    $('#txt_celular').mask("(00) 00000-0000");
})