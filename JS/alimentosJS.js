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

    let url = "dietas.php?abierto="+ getParameterByName("id_dieta");
    $("#volver").attr("href", url);

    let arrayAlimentos = imprimirAlimientos();
    console.log(arrayAlimentos);
    let arrayDietas = obtenerDietas();
    let arrayClases = obtenerClases();

    $("#borrar").click(function(e){ e.preventDefault(); buscarAlimento("", arrayAlimentos)});
    $("#buscar").click(function(e){ e.preventDefault(); buscarAlimento($("#nombre").val(), arrayAlimentos)});

    $("#clase").change(function(e){ e.preventDefault(); filtrarClase($(this).val(), arrayClases, arrayAlimentos)});

    $(".formPeso").submit(function(e){
        e.preventDefault();
        let input = $(this).find(".peso").val();
        let idAlimento = $(this).find(".idAlimento").val();

        if(!isNaN(input) && input != ""){
            $(this).find(".peso").css("background-color","white");
            $(this).find(".peso").css("color","black");
            if(comprobarID(idAlimento, arrayAlimentos)){
                if(comprobarNombreComida() && comprobarIDDieta()){
                    $.ajax({
                        type: "POST",
                        url: "PHP/alimentos.php",
                        data:{
                            crearComida: true,
                            peso: input,
                            alimento: idAlimento,
                            nombreComida: getParameterByName("nombre_comida"),
                            dieta: arrayDietas[getParameterByName('id_dieta')].id
                        },
                        async: false,
                        success: function(response){
                            let respuesta = JSON.parse(response);
                            let url = "dietas.php?abierto="+ getParameterByName("id_dieta");
                            if(respuesta.result == 0){
                                $(location).attr("href", url);
                            }else{
                                alert("Ha habido un error al crear la comida, vuelve a intentarlo");
                                $(location).attr("href", url);
                            }
                        }
                    });
                }
            }else{
                $(this).find(".peso").css("background-color","red");
                $(this).find(".peso").css("color","white");
                $(this).find(".peso").val("RECARGA LA PÁGINA");
            }
        }else{
            
        }
    })

    function comprobarNombreComida(){
        let nombre = getParameterByName("nombre_comida");
        if(nombre == "Desayuno" || nombre == "Almuerzo" || nombre == "Comida" || nombre == "Merienda" || nombre == "Cena"){
            return true;
        }else{
            alert("Ha habido un error, vuelve a intentarlo");
            $(location).attr("href", "dietas.php");
        }
    }

    function comprobarIDDieta(){
        let iddieta = getParameterByName("id_dieta");
        if(iddieta == 0 || iddieta == 1 || iddieta==2){
            return true;
        }else{
            alert("Ha habido un error, vuelve a intentarlo");
            $(location).attr("href", "dietas.php");
        }
    }

    function comprobarID(id, arrayAlimentos){
        for(let i=0; i<arrayAlimentos.length; i++){
            if(arrayAlimentos[i].ID == id){
                return true;
            }
        }
        return false;
    }

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function buscarAlimento(nombre, arrayAlimentos){
        if(nombre == ""){
            $("#divAlimentos").find(".alimento").css("display","block");
            $("#nombre").val("");
        }else{
            $("#divAlimentos").find(".alimento").css("display","none");
            for(let i=0; i<arrayAlimentos.length; i++){
                nombreAlimento = nombre.toLowerCase();
                nombreArray = arrayAlimentos[i].Nombre.toLowerCase();
                if(nombreArray == nombreAlimento){                    
                    $("#"+arrayAlimentos[i].ID).css("display","block");
                }else if(nombreArray.includes(nombreAlimento)){
                    $("#"+arrayAlimentos[i].ID).css("display","block");
                }
            }             
        }        
    }

    function obtenerDietas(){
        let arrayDietas = [];

        $.ajax({
            type: "POST",
            url: "PHP/alimentos.php",
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
                        });
                }
            }
        });
        return arrayDietas;
    }

    function imprimirAlimientos(arrayAlimentos){    
        var arrayAlimentos = [];    
        $.ajax({
            type: "POST",
            url: "PHP/alimentos.php",
            data: {
                obtenerAlimentos: true
            },
            async: false,
            success: function(response){
                let respuesta = JSON.parse(response);
                let arrayRespuesta = Object.values(respuesta);
                
                for(let i=0; i<arrayRespuesta.length; i++){
                    let alimento = arrayRespuesta[i];
                    arrayAlimentos.push({"ID":alimento.ID, "Nombre":alimento.Nombre, "Clase": alimento.Clase});
                    let newDiv = "<div class='col-lg-2 col-sm-3 col-xs-6 alimento' id='"+ alimento.ID +"'>" +
                        "<h4 class='text-center'>"+ alimento.Nombre + "</h4>" +
                        "<table>" +
                        "<tr><th>Calorias: </th><td>" + alimento.Kcal + "</td></tr>" +
                        "<tr><th>Grasas: </th><td>" + alimento.Grasas + "</td></tr>" +
                        "<tr><th>Saturadas: </th><td>" + alimento.Saturadas + "</td></tr>" +
                        "<tr><th>HC: </th><td>" + alimento.Hidratos + "</td></tr>" +
                        "<tr><th>Azucares: </th><td>" + alimento.Azucares + "</td></tr>" +
                        "<tr><th>Proteinas: </th><td>" + alimento.Proteinas + "</td></tr>" +
                        "<tr><th>Sal: </th><td>" + alimento.Sal + "</td></tr></table> <br>" +
                        "<form class='formPeso col-sm-12 text-center'><div class='form-group'> <label for='peso'> Peso </label> <input type='number' name='peso' class='form-control peso' placeholder='Introducir Peso'> <input type='hidden' class='idAlimento' value='"+ alimento.ID +"'> </div> <button class='btn btn-success'><span class='glyphicon glyphicon-plus'></span> Añadir  </form>"
                    
                    
                    $("#divAlimentos").append(newDiv);
                    if(alimento.Clase == "Alimentos de Usuarios"){
                        $("#"+alimento.ID).css("display","none");
                        $("#"+alimento.ID).css("background-color","lightblue");
                    }
                }
            }
        })
        return arrayAlimentos;
    }

    function obtenerClases(){
        var arrayClases = [];
        $.ajax({
            type: "POST",
            url: "PHP/alimentos.php",
            async: false,
            data:{
                obtenerClases: true
            },
            success: function(response){
                let respuesta = JSON.parse(response);
                let arrayRespuesta = Object.values(respuesta);
                
                for(let i=0; i<arrayRespuesta.length; i++){
                    let clase = arrayRespuesta[i];
                    arrayClases.push(clase.Clase);
                    let newOption = "<option value='"+ clase.Clase +"'>"+ clase.Clase+"</option>";
                    $("#clase").append(newOption);
                }
            }
        });
        return arrayClases;
    }

    function filtrarClase(clase, arrayClases, arrayAlimentos){
        if(clase == ""){
            $("#divAlimentos").find(".alimento").css("display","block");
            for(let i=0; i<arrayAlimentos.length; i++){
                if(arrayAlimentos[i].Clase == "Alimentos de Usuarios"){
                    $("#"+arrayAlimentos[i].ID).css("display","none");
                }
            }
        }else if(arrayClases.includes(clase)){
            $("#divAlimentos").find(".alimento").css("display","none");
            for(let i=0; i<arrayAlimentos.length; i++){
                if(arrayAlimentos[i].Clase == clase){
                    $("#"+arrayAlimentos[i].ID).css("display","block");
                }
            }
        }
    }

    
    let inputNombre = $("#nombreAlimento");
    inputNombre.blur(comprobarNombre);

    let inputKcal = $("#kcal");
    inputKcal.blur(function(){comprobarValor(inputKcal.val(),$("#estadoKcal"))});
    
    let inputGrasas = $("#grasas");
    inputGrasas.blur(function(){comprobarValor(inputGrasas.val(),$("#estadoGrasas"))});

    let inputSaturadas = $("#saturadas");
    inputSaturadas.blur(function(){comprobarValor(inputGrasas.val(),$("#estadoSaturadas"))});

    let inputHidratos = $("#hidratos");
    inputHidratos.blur(function(){comprobarValor(inputHidratos.val(),$("#estadoHidratos"))});

    let inputAzucares = $("#azucares");
    inputAzucares.blur(function(){comprobarValor(inputAzucares.val(),$("#estadoAzucares"))});

    let inputProteinas = $("#proteinas");
    inputProteinas.blur(function(){comprobarValor(inputProteinas.val(),$("#estadoProteinas"))});

    let inputSal = $("#sal");
    inputSal.blur(function(){comprobarValor(inputSal.val(),$("#estadoSal"))});

    let formAlimento = $("#formAlimento")
    formAlimento.submit(function(e){
        e.preventDefault();

        nombreCorrecto = comprobarNombre();
        kcalCorrecto = comprobarValor(inputKcal.val(),$("#estadoKcal"));
        grasasCorrecto = comprobarValor(inputGrasas.val(),$("#estadoGrasas"));
        saturadasCorrecto = comprobarValor(inputGrasas.val(),$("#estadoSaturadas"));
        hidratosCorrecto = comprobarValor(inputHidratos.val(),$("#estadoHidratos"));
        azucaresCorrecto = comprobarValor(inputAzucares.val(),$("#estadoAzucares"));
        proteinasCorrecto = comprobarValor(inputProteinas.val(),$("#estadoProteinas"));
        salCorrecto = comprobarValor(inputSal.val(),$("#estadoSal"));

        if(nombreCorrecto && kcalCorrecto && grasasCorrecto && saturadasCorrecto && hidratosCorrecto && azucaresCorrecto && proteinasCorrecto && salCorrecto){
            nombreAlimento = inputNombre.val();
            kcalAlimento = inputKcal.val();
            grasasAlimento = inputGrasas.val();
            saturadasAlimento = inputSaturadas.val();
            hidratosAlimento = inputHidratos.val();
            azucaresAlimento = inputAzucares.val();
            proteinasAlimento = inputProteinas.val();
            salAlimento = inputSal.val();

            $.ajax({
                type: "POST",
                url: "PHP/alimentos.php",
                data:{
                    crearAlimento: true,
                    nombre: nombreAlimento,
                    kcal: kcalAlimento,
                    grasas: grasasAlimento,
                    saturadas: saturadasAlimento,
                    hidratos: hidratosAlimento,
                    azucares: azucaresAlimento,
                    proteinas: proteinasAlimento,
                    sal: salAlimento
                },
                success: function(response){
                    let respuesta = JSON.parse(response);
                    if(respuesta.result == 1){
                        alert("El alimento ha sido creado con exito");
                        
                        inputNombre.val("");
                        inputKcal.val("");
                        inputGrasas.val("");
                        inputSaturadas.val("");
                        inputHidratos.val("");
                        inputAzucares.val("");
                        inputProteinas.val("");
                        inputSal.val("");

                        arrayAlimentos = imprimirAlimientos();
                        filtrarClase("Alimentos de Usuarios", arrayClases, arrayAlimentos);
                        $("#clase").val("Alimentos de Usuarios");
                        $("#cerrar").click();
                    }else{
                        alert(respuesta.result);
                    }
                }
            })
        }
    })

    function comprobarNombre(){
        let nombre = $("#nombreAlimento").val();
        let pNombre = $("#estadoNombre");
        let regex = /^[A-Za-z ]*$/;
        if(nombre != ""){
            if(nombre.length <= 30){
                if(regex.test(nombre)){
                    pNombre.text("_");
                    pNombre.css("color","white");
                    return true;
                }else{
                    pNombre.css("color","");
                    pNombre.text("El nombre no puede contener números");
                }
            }else{
                pNombre.css("color","");
                pNombre.text("El nombre no puede tener más de 30 carácteres");
            }
        }else{
            pNombre.css("color","");
            pNombre.text("El nombre no puede estar vacío");
        }
        return false;
    }

    function comprobarValor(valor, p){
        if(valor != ""){
            if(!isNaN(valor)){
                if(valor>=00){
                    p.css("color","white");
                    p.text("_");
                    return true;
                }else{
                    p.css("color","");
                    p.text("Tiene que ser igual o mayor a 0");
                }
            }else{
                p.css("color","");
                p.text("Tiene que ser un número");
            }
        }else{
            p.css("color","");
            p.text("No puede estar vacío");
        }
        
        return false;
    }
});
    