$(document).ready(function(){
    calcularAlturaImagen();
    $(window).resize(calcularAlturaImagen);

    function calcularAlturaImagen(){
        let divImagen = $(".imagen");
        let header = $("nav.navbar");
        let section = $("section");
        let footer = $("footer");

        let alturaImagen = $(window).height() - header.height() - footer.height();
        divImagen.height(alturaImagen);

        if($(window).width()< 768){
            section.height(alturaImagen-11);
        }
    }

    



    $("#user").blur(validarUsu);

    function validarUsu(){
        let valUsu = $("#user").val();
        let pUsu = $("#estadoUsu");
        
        if(valUsu!=""){
            if(valUsu.length > 20){
                pUsu.css("display", "block");
                pUsu.text("El usuario no puede tener más de 20 carácteres");
            }else{
                pUsu.css("display", "none");
                return valUsu;
            }
        }else{
            pUsu.css("display", "block");
            pUsu.text("El usuario no puede estar vacío");
        }
    }

    $("#pwd").blur(validarPwd);

    function validarPwd(){
        let valPass = $("#pwd").val();
        let pPass = $("#estadoPass");

        if(valPass != ""){
            if(valPass.length < 8 || valPass.length > 20){
                pPass.css("display", "block");
                pPass.text("La contraseña tiene que tener entre 8 y 20 carácteres");
            }else{
                pPass.css("display", "none");
                return valPass;
            }
        }else{
            pPass.css("display", "block");
            pPass.text("La contraseña no puede estar vacía");
        }
    }

    $("#formLogin").submit(function(e){
        e.preventDefault();

        if(validarUsu() && validarPwd()){
            if($("#cookie").attr("selected") == true){
                setCookie("username",$("#user").val(), 30);
            }
            $.ajax({
                type: "POST",
                url: "PHP/login.php",
                data: {
                    usuario: validarUsu(),
                    pwd: validarPwd(),
                    cookie: $("#cookie").prop("checked")
                },
                success: function(response){
                    var respuesta = JSON.parse(response);
                    if(respuesta.codigo == 1){
                        if(respuesta.resultado == "admin"){
                            $(location).attr('href', "dietasAdmin.php");
                        }else{
                            $(location).attr('href', "dietas.php");
                        }
                        
                    }else{
                        $("#estadoPass").css("display", "block");
                        $("#estadoPass").text(respuesta.resultado);
                    }
                }
            }); 
        }
               
    });

    if(getCookie("username") != ""){
        $("#user").val(getCookie("username"));
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
    
});