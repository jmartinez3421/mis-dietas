<?php
    session_start();
    if(isset($_SESSION["user_id"])){
        if(isset($_SESSION['admin']) && $_SESSION['admin']){
            echo json_encode(array("codigo" => 1, "resultado" => "admin"));
        }else{
            echo json_encode(array("codigo" => 1, "resultado" => "user"));
        }        
    }else{
        if(isset($_POST['usuario'])){
            if(strlen($_POST['usuario'])<=20){
                $usuario = $_POST['usuario'];
            }else{
                echo json_encode(array("codigo" => 0, "resultado" => "El nombre de usuario no puede sobrepasar los 20 carácteres"));
            }
        }else{
            echo json_encode(array("codigo" => 0, "resultado" => "El usuario no puede estar vacío"));
        }

        if(!empty($_POST["pwd"])){
            if(strlen($_POST["pwd"])>=8 && strlen($_POST["pwd"])<=20){
                $contrasena = $_POST["pwd"];
            }else{
                echo json_encode(array("codigo" => 0, "resultado" => "La contraseña tiene que tener entre 8 y 20 carácteres"));
            }
        }else{
            echo json_encode(array("codigo" => 0, "resultado" => "Tienes que introducir una contraseña"));
        }

        if(isset($usuario) && isset($contrasena)){
            require("BDD.php");

            $sql = "SELECT admin FROM usuarios WHERE usuario='".$usuario."' AND contrasena='".$contrasena."';";
            $resultado = mysqli_query($con, $sql);
            if(mysqli_num_rows($resultado)==1){
                if(isset($_POST["cookie"]) && $_POST['cookie']){
                    setcookie("username", $usuario, time()+3600);
                }else{
                    setcookie("username", "", time()-100);
                }
                $_SESSION['user_id'] = $usuario;
                if(mysqli_fetch_array($resultado)[0][0]==1){
                    
                    $_SESSION['admin'] = true;
                    echo json_encode(array("codigo" => 1, "resultado" => "admin"));
                }else{
                    echo json_encode(array("codigo" => 1, "resultado" => "user"));
                }                                               
            
            }else{
                echo json_encode(array("codigo" => 0, "resultado" => "El usuario y la contraseña no corresponden"));
            }
            mysqli_close($con);
        }
    }
?>