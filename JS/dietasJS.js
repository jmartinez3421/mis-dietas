$(document).ready(function(){
    calcularAlturaMarginTopSection();

    $(window).resize(calcularAlturaMarginTopSection);

    function calcularAlturaMarginTopSection(){
        let section = $("section");
        let header = $("nav.navbar");
        let footer = $("footer");

        let alturaSection = $(window).height() - header.height() - footer.height() - 10;
        section.css("min-height", alturaSection);
        section.css("margin-top", header.height() + 10);
    }

    
    var arrayDietas = [];

    $.ajax({
        type: "POST",
        url: "PHP/dietas.php",
        data:{
            obtenerDietas: true
        },
        async: false,
        success: function(response){
            let respuesta = JSON.parse(response);
            let arrayRespuesta = Object.values(Object.values(respuesta));
            for(let i=0; i<arrayRespuesta.length; i++){
                arrayDietas.push(
                    {
                        'id':arrayRespuesta[i].Dieta, 
                        'objetivo':arrayRespuesta[i].Objetivo, 
                        'actividad':arrayRespuesta[i].Actividad
                    });
            }
        }
    });

    let objetivo1 = $("#objetivo1");
    seleccinarOption(objetivo1, arrayDietas[0].objetivo);
    objetivo1.change(function(){ actualizarObjetivo($(this).val(),arrayDietas[0].id), calcularTMB(arrayDietas[0].id, 1); });
    
    let actividadFisica1 = $("#actividadFisica1");
    seleccinarOption(actividadFisica1, arrayDietas[0].actividad);
    actividadFisica1.change(function(){ actualizarActividadFisica($(this).val(), arrayDietas[0].id); calcularTMB(arrayDietas[0].id, 1);});

    let objetivo2 = $("#objetivo2");
    seleccinarOption(objetivo2, arrayDietas[1].objetivo);
    objetivo2.change(function(){ actualizarObjetivo($(this).val(),arrayDietas[1].id), calcularTMB(arrayDietas[1].id, 2); });

    let actividadFisica2 = $("#actividadFisica2");
    seleccinarOption(actividadFisica2, arrayDietas[1].actividad);
    actividadFisica2.change(function(){ actualizarActividadFisica($(this).val(), arrayDietas[1].id); calcularTMB(arrayDietas[1].id, 2);});
    
    let objetivo3 = $("#objetivo3");
    seleccinarOption(objetivo3, arrayDietas[2].objetivo);
    objetivo3.change(function(){ actualizarObjetivo($(this).val(),arrayDietas[2].id), calcularTMB(arrayDietas[2].id, 3); });

    let actividadFisica3 = $("#actividadFisica3");
    seleccinarOption(actividadFisica3, arrayDietas[2].actividad);
    actividadFisica3.change(function(){ actualizarActividadFisica($(this).val(), arrayDietas[2].id); calcularTMB(arrayDietas[2].id, 3);});

    $(".imprimir").click(function(e){
        let dietaImprimir = $(this).val();
        let nuevaVentana = window.open("imprimir.html?dieta="+dietaImprimir,"Imprimir Dieta", "width=800, height=800");

    });

    obtenerComidas(arrayDietas[0].id, 1);calcularTMB(arrayDietas[0].id, 1);
    obtenerComidas(arrayDietas[1].id, 2);calcularTMB(arrayDietas[1].id, 2);
    obtenerComidas(arrayDietas[2].id, 3);calcularTMB(arrayDietas[2].id, 3);
    abrirDieta();

    $(".formPeso").submit(function(e){
        e.preventDefault();
        let peso = $(this).find(".inputPeso").val();
        let input = $(this).find(".inputID").val().split(",");
        let idComida = input[0];
        let idDieta = input[1]

        if(peso == 0){
            alert("El peso no puede ser 0");
            return;
        }

        //tengo que conseguir los valores nutricionales del alimento para poder hacer bien la regla de tres
        $.ajax({
            type: "POST",
            url: "PHP/dietas.php",
            data:{
                actualizarPeso: true,
                peso: peso,
                comida: idComida,
                dieta: idDieta
            },
            success: function(response){
                let respuesta = JSON.parse(response);
                
                if(respuesta.result == "error"){
                    alert("Ha habido un error al actualizar el peso");
                }else{
                    actualizarComida(idComida, peso, respuesta.result);
                    sumaValores(1);
                    sumaValores(2);
                    sumaValores(3);
                    
                }               
            }
        });
    })

    $(".borrar").click(function(){
        let valor = $(this).val().split(",");
        let idComida = valor[0];
        let idDieta = valor[1];
        let pos = valor[2];

        $.ajax({
            type: "POST",
            url: "PHP/dietas.php",
            data:{
                borrarComida: true,
                comida: idComida,
            },
            success: function(response){
                let respuesta = JSON.parse(response);
                console.log(respuesta.result)                
            }
        });

        if(pos == 1){
            $("#dieta1").find("#"+idComida).remove();
        }else if(pos == 2){
            $("#dieta2").find("#"+idComida).remove();
        }else{
            $("#dieta3").find("#"+idComida).remove();
        }

        sumaValores(pos);
    });
    
    function actualizarComida(id, peso, pesoAnterior){
        $("#"+id).find(".kcal").text(reglaDeTresPlus($("#"+id).find(".kcal").text(), peso, pesoAnterior));
        $("#"+id).find(".grasas").text(reglaDeTresPlus($("#"+id).find(".grasas").text(), peso, pesoAnterior));
        $("#"+id).find(".saturadas").text(reglaDeTresPlus($("#"+id).find(".saturadas").text(), peso, pesoAnterior));
        $("#"+id).find(".hidratos").text(reglaDeTresPlus($("#"+id).find(".hidratos").text(), peso, pesoAnterior));
        $("#"+id).find(".azucares").text(reglaDeTresPlus($("#"+id).find(".azucares").text(), peso, pesoAnterior));
        $("#"+id).find(".proteinas").text(reglaDeTresPlus($("#"+id).find(".proteinas").text(), peso, pesoAnterior));
        $("#"+id).find(".sal").text(reglaDeTresPlus($("#"+id).find(".sal").text(), peso, pesoAnterior));

        $("#modalComida"+id).find(".kcal").text(reglaDeTresPlus($("#modalComida"+id).find(".kcal").text(), peso, pesoAnterior));
        $("#modalComida"+id).find(".grasas").text(reglaDeTresPlus($("#modalComida"+id).find(".grasas").text(), peso, pesoAnterior));
        $("#modalComida"+id).find(".saturadas").text(reglaDeTresPlus($("#modalComida"+id).find(".saturadas").text(), peso, pesoAnterior));
        $("#modalComida"+id).find(".hidratos").text(reglaDeTresPlus($("#modalComida"+id).find(".hidratos").text(), peso, pesoAnterior));
        $("#modalComida"+id).find(".azucares").text(reglaDeTresPlus($("#modalComida"+id).find(".azucares").text(), peso, pesoAnterior));
        $("#modalComida"+id).find(".proteinas").text(reglaDeTresPlus($("#modalComida"+id).find(".proteinas").text(), peso, pesoAnterior));
        $("#modalComida"+id).find(".sal").text(reglaDeTresPlus($("#modalComida"+id).find(".sal").text(), peso, pesoAnterior));
    }

    function reglaDeTresPlus(valor, peso, pesoAnterior){
        return Math.round((valor*peso)/pesoAnterior);
    }

    function seleccinarOption(select, valor){
        let options = select.find('option');

        for(let i=0; i<options.length; i++){
            if(options[i].value == valor){
                options[i].selected = "selected";
            }
        }
    }

    function obtenerComidas(dieta, pos){
        $.ajax({
            type: "POST",
            url: "PHP/dietas.php",
            data:{
                obtenerComidas: true,
                dieta: dieta
            },
            async: false,
            success: function(response){
                let respuesta = JSON.parse(response);
                let arrayRespuesta = Object.values(Object.values(respuesta));

                for(let i=0; i<arrayRespuesta.length; i++){
                    let fila = arrayRespuesta[i];
                    
                    let newRow = 
                        "<tr class='comida' id='"+ fila.id +"'> <td class='nombre'> <a data-toggle='modal' data-target='#modalComida"+fila.id+"'>"+ fila.nombre  +"</a></td>" +
                        "<td class='kcal'>" + Math.round(reglaDeTres(fila.kcal, fila.peso)) + "</td>"+
                        "<td class='grasas'>" + Math.round(reglaDeTres(fila.grasas, fila.peso)) + "</td>"+
                        "<td class='saturadas'>" + Math.round(reglaDeTres(fila.saturadas, fila.peso)) + "</td>"+
                        "<td class='hidratos'>" + Math.round(reglaDeTres(fila.hidratos, fila.peso)) + "</td>"+
                        "<td class='azucares'>" + Math.round(reglaDeTres(fila.azucares, fila.peso)) + "</td>"+
                        "<td class='proteinas'>" + Math.round(reglaDeTres(fila.proteinas, fila.peso)) + "</td>"+
                        "<td class='sal'>" + Math.round(reglaDeTres(fila.sal, fila.peso)) + "</td>"+
                        "<td class='peso'><form class='formPeso form-inline'><input type='text' class='form-control inputPeso' value='"+ Math.round(fila.peso) +"' style='width:50px'> <input type='hidden'  class='inputID' value='"+ fila.id +","+ dieta +"'> <button class='btn btn-success btn-xs'><span class='glyphicon glyphicon-refresh'></span></td>" +
                        "<td class='delete'><button class='btn btn-default borrar' value='"+ fila.id +","+ dieta +","+ pos +"'><span class='glyphicon glyphicon-trash'></span></button></tr>"
                    ;

                    let newModal = "<div class='modal fade' id='modalComida"+ fila.id +"' role='dialog'>" +
                                        "<div class='modal-dialog modal-dialog-centered' style='width:200px; margin:0 auto; margin-top:100px'>" +
                                            "<div class='modal-content'>" +
                                                "<div class='modal-header'>"+
                                                    "<button type='button' class='close' data-dismiss='modal'>&times;</button>"+
                                                    "<h4 class='modal-title text-center'>"+ fila.nombre +"</h4>"+
                                                "</div>"+
                                                "<div class='modal-body'>"+
                                                    "<table style='margin: 0 auto;'>"+
                                                        "<tr><th>Calorias: </th><td class='kcal'>"+ Math.round(reglaDeTres(fila.kcal, fila.peso)) +"</td></tr>"+
                                                        "<tr><th>Grasas: </th><td class='grasas'>"+ Math.round(reglaDeTres(fila.grasas, fila.peso)) +"</td></tr>"+
                                                        "<tr><th>G.Saturadas: </th><td class='saturadas'>"+ Math.round(reglaDeTres(fila.saturadas, fila.peso)) +"</td></tr>"+
                                                        "<tr><th>Hidratos: </th><td class='hidratos'>"+ Math.round(reglaDeTres(fila.hidratos, fila.peso)) +"</td></tr>"+
                                                        "<tr><th>Azúcares: </th><td class='azucares'>"+ Math.round(reglaDeTres(fila.azucares, fila.peso)) +"</td></tr>"+
                                                        "<tr><th>Proteinas: </th><td class='proteinas'>"+ Math.round(reglaDeTres(fila.proteinas, fila.peso)) +"</td></tr>"+
                                                        "<tr><th>Sal: </th><td class='sal'>"+ Math.round(reglaDeTres(fila.sal, fila.peso)) +"</td></tr>"+                                                                                                             
                                                    "</table>"+
                                                "</div>"+
                                                "<div class='modal-footer'>"+
                                                    "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"+
                                    "</div>";
                    
                    $("body").append(newModal);

                    let comida = fila.Comida;

                    if(pos == 1){
                        switch(comida){
                            case "Desayuno":
                                $("#desayuno1 .boton").before(newRow);
                                break;

                            case "Almuerzo":
                                $("#almuerzo1 .boton").before(newRow);
                                break;

                            case "Comida":
                                $("#comida1 .boton").before(newRow);
                                break;

                            case "Merienda":
                                $("#merienda1 .boton").before(newRow);
                                break;

                            case "Cena":
                                $("#cena1 .boton").before(newRow);
                                break;
                        }
                    }else if(pos == 2){
                        switch(comida){
                            case "Desayuno":
                                $("#desayuno2 .boton").before(newRow);
                                break;

                            case "Almuerzo":
                                $("#almuerzo2 .boton").before(newRow);
                                break;

                            case "Comida":
                                $("#comida2 .boton").before(newRow);
                                break;

                            case "Merienda":
                                $("#merienda2 .boton").before(newRow);
                                break;

                            case "Cena":
                                $("#cena2 .boton").before(newRow);
                                break;
                        }
                    }else{
                        switch(comida){
                            case "Desayuno":
                                $("#desayuno3 .boton").before(newRow);
                                break;

                            case "Almuerzo":
                                $("#almuerzo3 .boton").before(newRow);
                                break;

                            case "Comida":
                                $("#comida3 .boton").before(newRow);
                                break;

                            case "Merienda":
                                $("#merienda3 .boton").before(newRow);
                                break;

                            case "Cena":
                                $("#cena3 .boton").before(newRow);
                                break;
                            
                        }
                    }
                }
                sumaValores(pos);
            }
        });
    }

    function reglaDeTres(valor, peso){
        return (peso*valor)/100;
    }

    function sumaValores(pos){
        if(pos == 1){
            let kcal = sumar($("#dieta1").find(".kcal"));
            let grasas = sumar($("#dieta1").find(".grasas"));
            let saturadas = sumar($("#dieta1").find(".saturadas"));
            let hidratos = sumar($("#dieta1").find(".hidratos"));
            let azucares = sumar($("#dieta1").find(".azucares"));
            let proteinas = sumar($("#dieta1").find(".proteinas"));
            let sal = sumar($("#dieta1").find(".sal"));

            let arrayTotales = [kcal, grasas, saturadas, hidratos, azucares, proteinas, sal];
            let totales = $("#suma1").find(".total");
            contador = 0;
            for(let i=0; i<totales.length; i++){
                totales[i].innerHTML = arrayTotales[contador];
                contador++;
                if(contador == arrayTotales.length){
                    contador = 0;
                }
            }
        }else if(pos == 2){
            let kcal = sumar($("#dieta2").find(".kcal"));
            let grasas = sumar($("#dieta2").find(".grasas"));
            let saturadas = sumar($("#dieta2").find(".saturadas"));
            let hidratos = sumar($("#dieta2").find(".hidratos"));
            let azucares = sumar($("#dieta2").find(".azucares"));
            let proteinas = sumar($("#dieta2").find(".proteinas"));
            let sal = sumar($("#dieta2").find(".sal"));

            let arrayTotales = [kcal, grasas, saturadas, hidratos, azucares, proteinas, sal];
            let totales = $("#suma2").find(".total");
            contador = 0;
            for(let i=0; i<totales.length; i++){
                totales[i].innerHTML = arrayTotales[contador];
                contador++;
                if(contador == arrayTotales.length){
                    contador = 0;
                }
            }
        }else{
            let kcal = sumar($("#dieta3").find(".kcal"));
            let grasas = sumar($("#dieta3").find(".grasas"));
            let saturadas = sumar($("#dieta3").find(".saturadas"));
            let hidratos = sumar($("#dieta3").find(".hidratos"));
            let azucares = sumar($("#dieta3").find(".azucares"));
            let proteinas = sumar($("#dieta3").find(".proteinas"));
            let sal = sumar($("#dieta3").find(".sal"));

            let arrayTotales = [kcal, grasas, saturadas, hidratos, azucares, proteinas, sal];
            let totales = $("#suma3").find(".total");
            contador = 0;
            for(let i=0; i<totales.length; i++){
                totales[i].innerHTML = arrayTotales[contador];
                contador++;
                if(contador == arrayTotales.length){
                    contador = 0;
                }
            }
        }
    }

    function sumar(arrayValores){
        let resultado = 0;
        for(let i=0; i<arrayValores.length; i++){
            let td = arrayValores[i];
            resultado += parseFloat(td.innerHTML);
        }
        return Math.round(resultado);
    }

    function calcularTMB(dieta, pos){
        $.ajax({
            type: "POST",
            url: "PHP/dietas.php",
            data:{
                calcularTMB: true,
                iddieta: dieta
            },
            async: false,
            success: function(response){
                let respuesta = JSON.parse(response);
                console.log(respuesta);
                let kcal = 0;
                let grasas = 0;
                let proteinas = 0;

                if(respuesta.Sexo == "Hombre"){
                    kcal = Math.round((66 + (13.7 * respuesta.Peso) + (5 * respuesta.Altura) - (6.75 * respuesta.Edad))*respuesta.Actividad);
                }else if(respuesta.Sexo == "Mujer"){
                    kcal = Math.round((655 + (9.6 * respuesta.Peso) + (1.8 * respuesta.Altura) - (4.7 * respuesta.Edad))*respuesta.Actividad);
                }

                kcal = kcal + Math.round(parseInt(respuesta.Objetivo));
                
                if(respuesta.Objetivo<0){
                    grasas = Math.round(respuesta.Peso * 0.8);
                }else if(respuesta.Objetivo == 0){
                    grasas = Math.round(respuesta.Peso * 1);
                }else{
                    grasas = Math.round(respuesta.Peso * 1.2);
                }

                if(respuesta.Actividad == 1.2){
                    proteinas = Math.round(respuesta.Peso * 1);
                }else if(respuesta.Actividad >1.2 && respuesta.Objetivo >0){
                    proteinas = Math.round(respuesta.Peso * 2);
                }else{
                    proteinas = Math.round(respuesta.Peso * 1.6);
                }

                let grasasSaturadas = 20;
                let azucares = 25;
                let sal = 5;
                let hidratos = Math.round((kcal-((grasas*9)+(proteinas*4)))/4);
                
                let arrayValores = [kcal, grasas, grasasSaturadas, hidratos, azucares, proteinas, sal];
                console.log("Kcal: "+kcal+ "  || Grasas: " + grasas + " || Grasas Saturadas: " + grasasSaturadas + " || Hidratos: " + hidratos+ " || Azucares: " + azucares + " || Proteinas: " + proteinas + " || Sal: " + sal);
                
                
                if(pos == 1){
                    let arrayTd = $("#total1").find(".TMB");
                    let contador = 0;
                    for(let i=0; i<arrayTd.length; i++){
                        arrayTd[i].innerHTML = arrayValores[contador];
                        contador++;
                        if(contador == arrayValores.length){
                            contador = 0;
                        } 
                    }
                }else if(pos == 2){
                    let arrayTd = $("#total2").find(".TMB");
                    let contador = 0;
                    for(let i=0; i<arrayTd.length; i++){
                        arrayTd[i].innerHTML = arrayValores[contador];
                        contador++;
                        if(contador == arrayValores.length){
                            contador = 0;
                        } 
                    }
                }else{
                    let arrayTd = $("#total3").find(".TMB");
                    let contador = 0;
                    for(let i=0; i<arrayTd.length; i++){
                        arrayTd[i].innerHTML = arrayValores[contador];
                        contador++;
                        if(contador == arrayValores.length){
                            contador = 0;
                        } 
                    }
                }
            }
        });
    }


    function actualizarObjetivo(valObjetivo, iddieta){
        if(comprobarObjetivo(valObjetivo)){
            $.ajax({
                type: "POST",
                url: "PHP/dietas.php",
                data: {
                    actualizarObjetivo: true,
                    dieta: iddieta,
                    objetivo: valObjetivo
                },
                success: function(response){
                    let respuesta = JSON.parse(response);
                }
            });
        }
    }

    function actualizarActividadFisica(valActividad, iddieta){
        if(comprobarActividadFisica(valActividad)){
            $.ajax({
                type: "POST",
                url: "PHP/dietas.php",
                data: {
                    actualizarActividad: true,
                    dieta: iddieta,
                    actividad: valActividad
                },
                success: function(response){
                    let respuesta = JSON.parse(response);

                }
            });
        }
    }

    function comprobarObjetivo(objetivo){
        if(objetivo == -500 || objetivo == -200 || objetivo == 00 || objetivo == 200 || objetivo == 500){
            return true;
        }else{
            return false;
        }
    }

    function comprobarActividadFisica(actividad){
        if(actividad == 1.2 || actividad == 1.375 || actividad == 1.55 || actividad == 1.72 || actividad == 1.9){
            return true;
        }else{
            return false;
        }
    }


    function abrirDieta(){
        let abierto = getParameterByName('abierto');
        if(abierto == 0){
            $("#a1").addClass('active');
            $("div#dieta1").addClass("active");
            $("div#dieta1").addClass("in");
        }else if(abierto == 1){
            $("#a2").addClass('active');
            $("div#dieta2").addClass("active");
            $("div#dieta2").addClass("in");
        }else if(abierto == 2){
            $("#a3").addClass('active');
            $("div#dieta3").addClass("active");
            $("div#dieta3").addClass("in");
        }else{
            $("#a1").addClass('active');
            $("div#dieta1").addClass("active");
            $("div#dieta1").addClass("in");
        }
    }

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    
});