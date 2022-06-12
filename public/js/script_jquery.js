/******************************************************************* */

/*Utilizamos jquery para estas animaciones solo
    lo demás utilizaremos js*/

$(document).ready(function () {
    $(".div_lista_alumno").hover(
        function () {
            $(this).css("animation", "Hola");
        },
        function () {
            $(this).css("animation", "upDown 4.1s linear infinite");
        }
    );
    $(".div_ciclos_modulos").hover(
        function () {
            $(this).css("animation", "Hola");
        },
        function () {
            $(this).css("animation", "upDown 4.1s linear infinite");
        }
    );
});

function divAlert(){
    
    let div = document.querySelector('.alert');

    if(document.body.contains(div)){
        $("document").ready(function(){
            $("div.alert").fadeOut(5000);
            setTimeout(function(){
               $("div.alert").remove();
            }, 5000 );
        
        });
    }

}
divAlert();
/************************************************************************* */
