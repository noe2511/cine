$( document ).ready(function() {
    $('.asiento').css('cursor', 'pointer');

    //Función para poner los asientos naranjas o en estado "normal"
    $('.asiento').on({
        'click': function(){
            if($(this).hasClass("seleccionado"))
            {
                if($(this).hasClass("minusvalido"))
                {
                    $(this).attr("src","../../imagenes/minusvalido.ico");
                    $(this).removeClass("seleccionado");
                }
                else
                {
                    $(this).attr("src","../../imagenes/libre.ico");
                }
            }
            else
            {
                if($(this).hasClass("minusvalido"))
                {
                    $(this).attr("src","../../imagenes/minusvalidoPinchado.ico");
                
                    $(this).addClass("seleccionado");
                }
                else
                {
                    $(this).attr("src","../../imagenes/pinchado.ico");

                    $(this).addClass("seleccionado");
                }
            }
            
        }
    });

});