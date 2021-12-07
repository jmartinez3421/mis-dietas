$(document).ready(function(){
        
    cargarHTML(getParameterByName("dieta"));
    limpiarDieta();
    window.print();

    function cargarHTML(dieta){
        if(dieta == "T1" || dieta == "T2" || dieta == "T3"){
            let datos = window.opener.document.getElementsByClassName(dieta)[0].innerHTML;
            document.getElementById("cuerpo").innerHTML = datos;
        }else{
            alert("Ha habido un error con la dieta que se tiene que imprimir, intentalo de nuevo");
        }
    }

    function limpiarDieta(){
        $("#cuerpo").find(".boton").remove();
        $("#cuerpo").find(".delete").remove();
        let tdPesos = $("#cuerpo").find(".peso");
        let pesos = $("#cuerpo").find(".inputPeso");
        for(let i=0; i<pesos.length; i++){
            tdPesos[i].innerHTML = pesos[i].value;
        }

        $("#cuerpo").find("abbr").removeAttr("title");

        $("button").removeClass("btn-default");
        $(".btn-info").css("font-weight","bold");
        $("button").removeClass("btn-info");
        $("h4").css("font-size", "medium");
        
        $("tbody").css("border-top","2px solid grey");
        let tbodys = $("table").find("tbody");
        for(let i = 0; i<tbodys.length; i++){
            if(tbodys[i].children.length < 2){
                tbodys[i].remove();
            }
        }

        
    }

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
});