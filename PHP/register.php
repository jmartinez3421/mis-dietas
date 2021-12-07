<?php
    session_start();
    
    if(isset($_POST['comprobarUsu']) && isset($_POST['user'])){
        require("BDD.php");
        $sql = "SELECT usuario FROM usuarios WHERE usuario='".$_POST['user']."'";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado)==1){
            echo json_encode(array("codigo" => "error", "resultado" => "Este usuario ya existe"));
        }else{
            echo json_encode(array("codigo" => 1, "resultado" => "Usuario disponible"));
        }
        mysqli_close($con);
    }else{
        require("funciones.php");        
        
        if(isset($_POST['user'])){
            $usuario = comprobarUsuario($_POST['user']);
        }
        if(isset($_POST['pwd'])){
            $pwd = comprobarContrasena($_POST['pwd']);
        }
        if(isset($_POST['nombre'])){
            $nombre = comprobarNombre($_POST['nombre']);
        }
        if(isset($_POST['apellidos'])){
            $apellidos = comprobarApellidos($_POST['apellidos']);
        }
        if(isset($_POST['edad'])){
            $edad = comprobarEdad($_POST['edad']);
        }
        if(isset($_POST['sexo'])){
            $sexo = comprobarSexo($_POST['sexo']);
        }
        if(isset($_POST['peso'])){
            $peso = comprobarPesoAltura($_POST['peso']);
        }
        if(isset($_POST['altura'])){
            $altura = comprobarPesoAltura($_POST['altura']);
        }
        
        if(!empty($usuario) && !empty($pwd) && !empty($nombre) && !empty($apellidos) && !empty($edad) && !empty($sexo) && !empty($peso) && !empty($altura)){
            require("BDD.php");
            $sql = "SELECT usuario FROM usuarios WHERE usuario='$usuario'";
            $resultado = mysqli_query($con, $sql);
            if(mysqli_num_rows($resultado)==1){
                $_SESSION['respuesta'][] = array("codigo" => "error", "resultado" => "Este usuario ya existe");
            }else{
                $sql = "INSERT INTO usuarios VALUES('$usuario','$pwd','$nombre','$apellidos',$edad,'$sexo',$peso,$altura, false)";
                if(mysqli_query($con, $sql)){
                    $contador = 1;
                        while($contador<4){
                            $sql = "INSERT INTO dietas(nombreDieta, usuario, objetivo , actividadFisica) VALUES('Dieta$contador', '$usuario', 00, 1.375)";
                            if(mysqli_query($con, $sql)){
                                $contador++;
                            }else{
                                $_SESSION['respuesta'][] = array("codigo" => "error", "resultado" => "Ha habido un problema al crear las dietas");
                            } 
                            
                        }  
                    $_SESSION['user_id'] = $usuario;
                    $_SESSION['respuesta'][] = array("codigo" => 1, "resultado" => 1);  
                }else{
                    $_SESSION['respuesta'][] = array("codigo" => "error", "resultado" => "Ha habido algun error, con el registro, recarga la página e intentalo de nuevo");
                }
            }
        }

        echo json_encode($_SESSION['respuesta'], JSON_FORCE_OBJECT);
        unset($_SESSION['respuesta']);
    }
?>