
$(document).ready(function(){

    console.log("ahduahsudhusadhs");
	var $target = $('.container_informacao_empresa');
	var animationClass = 'move';
	var offset = $(window).height() * 3/4;

	function moveScroll(){
		var documentTop = $(document).scrollTop();

		$target.each(function(){
			var itenTop = $(this).offset().top;
			if(documentTop > itenTop - offset){
				$(this).addClass(animationClass);
			}else{
				$(this).removeClass(animationClass);
			}
		})

		
	}

	moveScroll();

$(document).scroll(function(){
    moveScroll();
})


	if($)
		$alturaPagina =  $(window).height();
		$alturaRodape = $alturaPagina - 150;
		console.log($alturaRodape);

});