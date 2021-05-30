var ruta=window.location.href;
ruta=ruta.split("/");
idH=ruta[ruta.length-1];

$( document ).ready(function() {
    $('.asiento').css('cursor', 'pointer');

    comprobarReservas();

    
    

    //Función para poner los asientos naranjas o en estado "normal"
    $('.asiento').on({
        'click': function(){
            if($(this).hasClass("seleccionado"))
            {
                if($(this).hasClass("minusvalido") && (!($(this).hasClass("ocupado"))))
                {
                    $(this).attr("src","../../../../imagenes/minusvalido.ico");
                    $(this).removeClass("seleccionado");
                }
                if($(this).hasClass("normal") && (!($(this).hasClass("ocupado"))))
                {
                    $(this).attr("src","../../../../imagenes/libre.ico");
                    $(this).removeClass("seleccionado");
                }
            }
            else
            {
                if($(this).hasClass("minusvalido") && (!($(this).hasClass("ocupado"))))
                {
                    $(this).attr("src","../../../../imagenes/minusvalidoPinchado.ico");
                
                    $(this).addClass("seleccionado");
                }
                if($(this).hasClass("normal") && (!($(this).hasClass("ocupado"))))
                {
                    $(this).attr("src","../../../../imagenes/pinchado.ico");

                    $(this).addClass("seleccionado");
                }
            }
            
        }
    });

    var seleccionados=[];
  

    enlace2="../../insertarEntrada";

    $('#reserva').on({
        'click': function(){
            if($("#correo").val() != "")
            {
                $(".seleccionado").each(function(){
                    var id=($(this).attr('id'));
                seleccionados.push(id);
                

                function insertarEntrada()
                {

                    $.ajax({
                        type: "POST",
                        url: enlace2,
                        data: 
                            { idAsiento: id,
                            idHorario: idH,
                            correo: $("#correo").val()},

                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText);
                        
                    }).done(function(response) {
                       
                    })
                }
                insertarEntrada();
                location.href ="http://localhost/2019-2020/cine/public/index.php";
                });
                
            }
            else
            {
                alert("Debe rellenar el correo para mandarle la reserva.")
            }
        }
    });

    
});

//$("#idHorario").val();


enlace="../../comprobarReservas/"+idH;


function comprobarReservas()
{

    $.ajax({
        type: "GET",
        url: enlace,
        data: 
            { idHorario: idH },

            
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
        console.log(enlace);
    }).done(function(response) {
        console.log(enlace);
        for (var key in response) {
            $("#"+response[key]['idAsiento']).addClass("ocupado");
            if($("#"+response[key]['idAsiento']).hasClass("minusvalido"))
            {
                $("#"+response[key]['idAsiento']).attr("src","../../../../imagenes/minusvalidoOcupado.ico");
            }
            else
            {
                $("#"+response[key]['idAsiento']).attr("src","../../../../imagenes/ocupado.ico");
            }
        }
    })
}

