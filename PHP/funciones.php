<?php
    
    function comprobarUsuario($usuario){
        if(!empty($usuario)){
            if(strlen($usuario)<=20){
                return $usuario;
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el usuario, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el usuario, recarga la página e intentalo de nuevo");
        }        
    }

    function comprobarContrasena($contrasena){
        if(!empty($contrasena)){
            if(strlen($contrasena)>=8 && strlen($contrasena)<=20){
                return $contrasena;
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con la contraseña, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con la contraseña, recarga la página e intentalo de nuevo");
        }
    }

    function comprobarNombre($nombre){        
        if(!empty($nombre)){
            $pattern = "/^[a-zA-Z ]+$/";
            if(preg_match($pattern, $nombre)){
                if(strlen($nombre)<=20){
                    return $nombre;
                }else{
                    $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el nombre, recarga la página e intentalo de nuevo");
                }
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el nombre, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el nombre, recarga la página e intentalo de nuevo");
        }        
    }

    function comprobarApellidos($apellidos){        
        if(!empty($apellidos)){
            $pattern = "/^[a-zA-Z ]+$/";
            if(preg_match($pattern, $apellidos)){
                if(strlen($apellidos)<=30){
                    return $apellidos;
                }else{
                    $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el apellido, recarga la página e intentalo de nuevo");
                }
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el apellido, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el apellido, recarga la página e intentalo de nuevo");
        }        
    }

    function comprobarEdad($edad){        
        if(!empty($edad)){
            if(is_numeric($edad)){
                if($edad>=14 && $edad<=100){
                    return $edad;
                }else{
                    $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con la edad, recarga la página e intentalo de nuevo");
                }
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con la edad, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con la edad, recarga la página e intentalo de nuevo");
        }
    }

    function comprobarSexo($sexo){        
        if(!empty($sexo)){
            if($sexo=="Hombre" || $sexo=='Mujer'){
                return $sexo;
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el sexo, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el sexo, recarga la página e intentalo de nuevo");
        }
    }

    function comprobarPesoAltura($peso){
        if(!empty($peso)){
            if(is_numeric($peso)){
                if($peso>=30 && $peso <=300){
                    return $peso;
                }else{
                    $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el peso/altura, recarga la página e intentalo de nuevo");
                }
            }else{
                $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el peso/altura, recarga la página e intentalo de nuevo");
            }
        }else{
            $_SESSION['respuesta'][] = array("codigo" => 0, "resultado" => "Ha habido algun error, con el peso/altura, recarga la página e intentalo de nuevo");
        }
    }
    
?>