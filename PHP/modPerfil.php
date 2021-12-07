<?php
    session_start();

    if(isset($_POST['obtenerDatos'])){
        require("BDD.php");
        $sql = "SELECT contrasena,nombre,apellidos,edad,sexo,peso,altura FROM usuarios WHERE usuario='".$_SESSION['user_id']."'";
        $respuesta = mysqli_query($con, $sql);
        if(mysqli_num_rows($respuesta)==0){
            echo json_encode(array("result" => "No hay ningún usuario con ese nombre"));
        }else{
            while($fila = mysqli_fetch_array($respuesta)){
                extract($fila);
                echo json_encode(array("pwd" => $contrasena, "nombre" => $nombre, "apellidos" => $apellidos, "edad" => $edad, "sexo" => $sexo, "peso" => $peso, "altura" => $altura));
            }
        }
        mysqli_close($con);
    }

    if(isset($_POST['actualizarDatos'])){
        require("funciones.php");
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

        if(!empty($pwd) && !empty($nombre) && !empty($apellidos) && !empty($edad) && !empty($sexo) && !empty($peso) && !empty($altura)){
            require("BDD.php");
            $sql = "UPDATE usuarios SET contrasena='$pwd',nombre='$nombre',apellidos='$apellidos',edad=$edad,sexo='$sexo',peso=$peso,altura=$altura WHERE usuario='".$_SESSION['user_id']."';";
            if(mysqli_query($con,$sql)){
                $_SESSION['respuesta'][] = array("codigo" => 1, "resultado" => 1);
            }else{
                $_SESSION['respuesta'][] = array("codigo" => "error", "resultado" => "Ha habido algún problema al actualizar");
            }

            
        }
        echo json_encode($_SESSION['respuesta']);
        unset($_SESSION['respuesta']);
    }
?>