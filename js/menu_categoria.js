// var submenu1 = document.getElementById("submenu1");
// var submenu1Iniciado = false;

// function adicionarSubmenu(submenu){
//     submenu.classList.add("click");
//     submenu.addEventListener("click",() => removerSubmenu(submenu1));
//     console.log("Chamou a função");
// }

// function removerSubmenu(submenu){
//     submenu.classList.remove("click");
//     submenu.addEventListener("click",() => adicionarSubmenu(submenu1));
// }


// if (submenu1Iniciado == false){
//     submenu1.addEventListener("click", () => adicionarSubmenu(submenu1));
// }

$(window).on('load', function(){
    $('.menu_categoria_item').click(function(){
    
        
        console.log($(this).attr("data-id"));
        var submenu = "#submenu" + $(this).attr("data-id");


        // $('.submenu_categoria').show();
        if($(submenu ).hasClass( "submenu_categoria" ))
        {
            $(submenu).removeClass('submenu_categoria');
            $(submenu).addClass('submenu_categoria_move');
        }else{
            $(submenu).removeClass('submenu_categoria_move');
            $(submenu).addClass('submenu_categoria');
        }


    })


});