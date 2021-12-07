$(document).ready(function(){
    calcularAlturaMarginTopSection();

    $(window).resize(calcularAlturaMarginTopSection);

    function calcularAlturaMarginTopSection(){
        let section = $("section");
        let header = $("nav.navbar");
        let footer = $("footer");

        let alturaSection = $(window).height() - header.height() - footer.height();
        section.css("min-height", alturaSection);
        section.css("margin-top", header.height());
    }

    let inputUsuario = $("#user");
    inputUsuario.blur(validarUsuario);

    let inputPwd = $("#pwd");
    inputPwd.blur(validarPwd);

    let inputNombre = $("#nombre");
    inputNombre.blur(validarNombre);

    let inputApellidos = $("#apellidos");
    inputApellidos.blur(validarApellidos);

    let inputEdad = $("#edad");
    inputEdad.blur(validarEdad);

    let selectSexo = $("#sexo");
    selectSexo.blur(validarSexo);

    let inputPeso = $("#peso");
    inputPeso.blur(validarPeso);

    let inputAltura = $("#altura");
    inputAltura.blur(validarAltura);

    let formRegistro = $("#formRegister");
    formRegistro.submit(function(e){
        e.preventDefault();
            usuario = inputUsuario.val();
            pwd = inputPwd.val();
            nombre = inputNombre.val();
            apellidos = inputApellidos.val(); 
            edad = inputEdad.val();
            sexo = selectSexo.val();
            peso = inputPeso.val();
            altura = inputAltura.val();

        if(validarUsuario() && validarPwd() && validarNombre() && validarApellidos() && validarEdad() && validarSexo() && validarPeso() && validarAltura()){
            $.ajax({
                type: "POST",
                url: "PHP/register.php",
                data:{
                    user: usuario,
                    pwd: pwd,
                    nombre: nombre,
                    apellidos: apellidos,
                    edad: edad,
                    sexo: sexo,
                    peso: peso,
                    altura: altura
                },
                success: function(response){
                    console.log(response);
                    let respuesta = JSON.parse(response);                    
                    arrayRespuesta = Object.values(Object.values(respuesta)[0]);
                    
                    if(arrayRespuesta[1] == 1){
                        $(location).attr("href", "dietas.php");                        
                    }else{
                        $("#divResultado").css("display", "block");
                        $("#pResultado").text(arrayRespuesta[1]);
                    }
                }
            });
        }
    });

    function validarUsuario(){
        let valUsu = inputUsuario.val();
        let pUsu = $("#estadoUsu");
        var flag = false;
        
        if(valUsu!=""){
            if(valUsu.length > 20){
                pUsu.css("display", "block");
                pUsu.text("El usuario no puede tener más de 20 carácteres");
            }else{
                
                $.ajax({
                    type: "POST",
                    url: "PHP/register.php",
                    async: false,
                    data:{
                        comprobarUsu: true,
                        user: valUsu
                    },
                    success: function(response){
                        var respuesta = JSON.parse(response);

                        if(respuesta.codigo == "error"){
                            pUsu.css("display", "block");
                            pUsu.removeClass("text-success");
                            pUsu.addClass("text-danger");
                            pUsu.text(respuesta.resultado);
                        }else{
                            pUsu.css("display", "block");
                            pUsu.removeClass("text-danger");
                            pUsu.addClass("text-success");
                            pUsu.text(respuesta.resultado);
                            flag = true;                            
                        }
                    }
                })                
            }
        }else{
            pUsu.css("display", "block");
            pUsu.text("El usuario no puede estar vacío");
        }
        return flag;
    }

    function validarPwd(){
        let valPass = $("#pwd").val();
        let pPass = $("#estadoPass");

        if(valPass != ""){
            if(valPass.length < 8 || valPass.length > 20){
                pPass.css("display", "block");
                pPass.text("La contraseña tiene que tener entre 8 y 20 carácteres");
            }else{
                pPass.css("display", "none");
                return true;
            }
        }else{
            pPass.css("display", "block");
            pPass.text("La contraseña no puede estar vacía");
        }
        return false;
    }

    function validarNombre(){
        let valNombre = inputNombre.val();
        let pNombre = $("#estadoNombre");

        let regex = /^[a-zA-Z ]+$/;
        if(valNombre != ""){
            if(regex.test(valNombre)){
                if(valNombre.length <= 20){
                    pNombre.css("display", "none");
                    return true;
                }else{
                    pNombre.css("display", "block");
                    pNombre.text("El nombre no puede tener más de 20 carácteres");
                }
            }else{
                pNombre.css("display", "block");
                pNombre.text("El nombre solo puede contener letras");
            }
        }else{
            pNombre.css("display", "block");
            pNombre.text("El nombre no puede estar vacío");
        }
        return false;
    }
    
    function validarApellidos(){
        let valApellidos = inputApellidos.val();
        let pApellidos = $("#estadoApellidos");

        let regex = /^[a-zA-Z ]+$/;
        if(valApellidos != ""){
            if(regex.test(valApellidos)){
                if(valApellidos.length <= 30){
                    pApellidos.css("display", "none");
                    return true;
                }else{
                    pApellidos.css("display", "block");
                    pApellidos.text("Los apellidos no pueden tener más de 30 carácteres");
                }
            }else{
                pApellidos.css("display", "block");
                pApellidos.text("Los apellidos solo pueden contener letras");
            }
        }else{
            pApellidos.css("display", "block");
            pApellidos.text("Los apellidos no pueden estar vacíos");
        }
        return false;
    }

    function validarEdad(){
        let valEdad = inputEdad.val();
        let pEdad = $("#estadoEdad");

        if(valEdad != 0){
            if(!isNaN(valEdad)){
                if(valEdad > 14){
                    if(valEdad < 100){
                        pEdad.css("display", "none");
                        return true;
                    }else{
                        pEdad.css("display", "block");
                        pEdad.text("La edad como máximo puede ser 100 años");
                    }
                }else{
                    pEdad.css("display", "block");
                    pEdad.text("Tienes que tener como mínimo 14 años");
                }
            }else{
                pEdad.css("display", "block");
                pEdad.text("La edad tiene que ser un número");
            }
        }else{
            pEdad.css("display", "block");
            pEdad.text("Tienes que introducir una edad");
        }
        return false;
    }

    function validarSexo(){
        let valSexo = selectSexo.val();
        let pSexo = $("#estadoSexo");

        if(valSexo != ""){
            if(valSexo == "Hombre" || valSexo == "Mujer"){
                pSexo.css("display", "none");
                return true;
            }else{
                pSexo.css("display", "block");
                pSexo.text("Ha habido un error, recarga la página");
            }
        }else{
            pSexo.css("display", "block");
            pSexo.text("Tienes que seleccionar un sexo");
        }   
        return false;     
    }

    function validarPeso(){
        let valPeso = inputPeso.val();
        let pPeso = $("#estadoPeso");

        if(valPeso != 0){
            if(!isNaN(valPeso)){
                if(valPeso >= 30){
                    if(valPeso <= 300){
                        pPeso.css("display", "none");
                        return true;
                    }else{
                        pPeso.css("display", "block");
                        pPeso.text("El peso máximo son 300kg");
                    }
                }else{
                    pPeso.css("display", "block");
                    pPeso.text("El peso mínimo son 30kg");
                }
            }else{
                pPeso.css("display", "block");
                pPeso.text("El peso tiene que ser un número");
            }
        }else{
            pPeso.css("display", "block");
            pPeso.text("Tienes que introducir un peso");
        }
        return false;
    }

    function validarAltura(){
        let valAltura = inputAltura.val();
        let pAltura = $("#estadoAltura");

        if(valAltura != ""){
            if(!isNaN(valAltura)){
                if(valAltura >= 100){
                    if(valAltura <= 300){
                        pAltura.css("display", "none");
                        return true;
                    }else{
                        pAltura.css("display", "block");
                        pAltura.text("La altura no puede ser más de 300cm");
                    }
                }else{
                    pAltura.css("display", "block");
                    pAltura.text("La altura mínima son 100cm");
                }
            }else{
                pAltura.css("display", "block");
                pAltura.text("La altura tiene que ser un número");
            }
        }else{
            pAltura.css("display", "block");
            pAltura.text("Tienes que introducir una altura");
        }
        return false;
    }
});