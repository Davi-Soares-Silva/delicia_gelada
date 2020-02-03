// Carrega todo o documento do jquery para garantir que não haja erros
//executando o no html

$(document).ready(function () {

	// Coloca uma função que é acionada de acordo com o scroll da página
	$(window).scroll(function () {

		// pega o topo do scroll
		var top = $(window).scrollTop();

		if (top > 600) {
			$("#redes_sociais").addClass("visible");
		} else {
			$("#redes_sociais").removeClass("visible");
		}

		if (top > 0) {

			// adiciona as classes css aos elementos html
			$("#caixa_cabecalho").addClass("fixo");
			$("#nav_logo").addClass("fixo");
			$(".menu_item").addClass("fixo");
			$(".linha_frm_login").addClass("fixo");
			$("#container_btn_frm_login").addClass("fixo");


		} else if (top < 10) {

			// remove as classes css aos elementos html
			$("#caixa_cabecalho").removeClass("fixo");
			$("#nav_logo").removeClass("fixo");
			$(".menu_item").removeClass("fixo");
			$(".linha_frm_login").removeClass("fixo");
			$("#container_btn_frm_login").removeClass("fixo");



		}

	});
});