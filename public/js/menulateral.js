window.addEventListener("load",function(ev)
{
    var mantenimiento=document.getElementById("manteni");
    var contacto=document.getElementById("contacto");
    var entradas=document.getElementById("entradas");
    var peliculas=document.getElementById("pelis");
    var trailer=document.getElementById("trailer");
    var principal=document.getElementById("principal");

    /*principal.classList.add("active");

    ev.preventDefault();

    mantenimiento.onclick=function(ev)
    {
        contacto.classList.remove("active");
        entradas.classList.remove("active");
        peliculas.classList.remove("active");
        trailer.classList.remove("active");
        principal.classList.remove("active");

        mantenimiento.classList.add("active");
    }*/

    var ruta= window.location.pathname;
    ruta=ruta.split("/");

    busqueda=ruta.indexOf("index.php");

    if(ruta[busqueda+1]=="mantenimiento")
    {
        contacto.classList.remove("active");
        entradas.classList.remove("active");
        peliculas.classList.remove("active");
        trailer.classList.remove("active");
        principal.classList.remove("active");

        mantenimiento.classList.add("active");
    }
    else if(ruta[ruta.length-1]=="index.php")
    {
        contacto.classList.remove("active");
        entradas.classList.remove("active");
        peliculas.classList.remove("active");
        trailer.classList.remove("active");
        mantenimiento.classList.remove("active");

        principal.classList.add("active");
    }

})