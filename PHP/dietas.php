<?php
    session_start();

    if(isset($_POST['obtenerDietas'])){
        require("BDD.php");
        $sql = "SELECT id, objetivo, actividadFisica FROM dietas WHERE usuario='".$_SESSION['user_id']."'";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado) == 0){
            die("Ha habido un error al obtener las dietas");
        }else{
            $arrayIDS = [];
            while($fila = mysqli_fetch_array($resultado)){
                extract($fila);
                $arrayIDS[] = array("Dieta" => $id, "Objetivo" => $objetivo, "Actividad" => $actividadFisica);
            }
            echo json_encode($arrayIDS, JSON_FORCE_OBJECT);
        }
        mysqli_close($con);
    }

    if(isset($_POST['actualizarObjetivo'])){
        if(isset($_POST['objetivo']) && isset($_POST['dieta'])){
            $objetivo = $_POST['objetivo'];
            $dieta = $_POST['dieta'];
            if($objetivo == -500 || $objetivo == -200 || $objetivo == 00 || $objetivo == 200 || $objetivo == 500){
                require("BDD.php");
                $sql = "UPDATE dietas SET objetivo='$objetivo' WHERE id='$dieta' AND usuario='".$_SESSION['user_id']."'";
                
                if(mysqli_query($con, $sql)){
                    echo json_encode(array("result" => 1));
                }else{
                    echo json_encode(array("result" => 0));
                }
                mysqli_close($con);
            }
        }
    }

    if(isset($_POST['actualizarActividad'])){
        if(isset($_POST['actividad']) && isset($_POST['dieta'])){
            $actividad = $_POST['actividad'];
            $dieta = $_POST['dieta'];
            
            if($actividad == 1.2 || $actividad == 1.375 || $actividad == 1.55 || $actividad == 1.72 || $actividad == 1.9){
                require("BDD.php");
                $sql = $sql = "UPDATE dietas SET actividadFisica = '$actividad' WHERE id='$dieta' AND usuario='".$_SESSION['user_id']."'";
                if(mysqli_query($con, $sql)){
                    echo json_encode(array("result" => 1));
                }else{
                    echo json_encode(array("result" => 0));
                }
                mysqli_close($con);
            }
        }
    }

    if(isset($_POST['obtenerComidas'])){
        if(isset($_POST['dieta'])){
            $dieta = $_POST['dieta'];
            require("BDD.php");
            $sql = "SELECT c.id, a.nombre,a.kcal,a.grasas,a.saturadas,a.hidratos,a.azucares,a.proteinas,a.sal,c.peso, c.nombre as comida FROM alimentos a INNER JOIN comidas c INNER JOIN dietas d WHERE d.id=$dieta AND d.usuario='".$_SESSION['user_id']."' AND c.id_dieta='$dieta' AND a.id=c.id_alimento";
            $resultado = mysqli_query($con,$sql);

            if(mysqli_num_rows($resultado) == 0){
                echo json_encode(array("resut"=>"Lo sentimos, pero no hay ninguna comida en la dieta"));
            }else{
                $arrayComidas = [];
                
                while($fila = mysqli_fetch_array($resultado)){
                    $arrayComidas[] = array("id" => $fila[0], "nombre" => $fila[1], "kcal" => $fila[2], "grasas" => $fila[3], "saturadas" => $fila[4], "hidratos" => $fila[5], "azucares" => $fila[6], "proteinas" => $fila[7], "sal" => $fila[8], "peso" => $fila[9], "Comida" => $fila[10]);    
                }
                echo json_encode($arrayComidas, JSON_FORCE_OBJECT);
            }
        }
    }

    if(isset($_POST['borrarComida'])){
        if(isset($_POST['comida'])){
            require("BDD.php");
            $sql = "SELECT c.* FROM comidas c, dietas d WHERE c.id='".$_POST['comida']."' AND d.usuario='".$_SESSION['user_id']."' AND c.id_dieta=d.id";
            $resultado = mysqli_query($con, $sql);
            if(mysqli_num_rows($resultado)==1){
                $sql = "DELETE FROM comidas WHERE id='".$_POST['comida']."'";
                if(mysqli_query($con, $sql)){
                    echo json_encode(array("result" => "Comida borrada"));
                }else{
                    echo json_encode(array("result" => "Error al borrar la comida"));  
                }
            }else{
                echo json_encode(array("result" => "No existe esa comida, intentalo de nuevo"));       
            }
        }
    }

    if(isset($_POST['calcularTMB'])){
        if(isset($_POST['iddieta'])){
            require("BDD.php");
            $sql = "SELECT u.sexo, u.peso, u.altura, u.edad, d.objetivo, d.actividadFisica FROM usuarios u, dietas d WHERE u.usuario='".$_SESSION['user_id']."' AND d.id=".$_POST['iddieta'];
            $resultado = mysqli_query($con, $sql);
            if(mysqli_num_rows($resultado) == 0){
                echo json_encode(array("result" => "No hay ninguna dieta"));
            }else{
                while($fila = mysqli_fetch_array($resultado)){
                    extract($fila);
                    echo json_encode(array("Sexo" => $sexo, "Peso" => $peso, "Altura" => $altura, "Edad" => $edad, "Objetivo" => $objetivo, "Actividad" => $actividadFisica));
                }
            }
            mysqli_close($con);
        }
    }

    if(isset($_POST['actualizarPeso'])){
        if(isset($_POST['peso']) && $_POST['peso'] != 0 && isset($_POST['comida']) && isset($_POST['dieta'])){
            $peso = $_POST['peso']; $comida = $_POST['comida']; $dieta = $_POST['dieta'];
            require("BDD.php");
            $sql = "SELECT id FROM dietas WHERE id=$dieta AND usuario='".$_SESSION['user_id']."'";
            $resultado = mysqli_query($con, $sql);
            if(mysqli_num_rows($resultado) == 0){
                echo json_encode(array("result" => "error"));
            }else{
                $sql = "SELECT peso as pesoAnt FROM comidas WHERE id_dieta=$dieta AND id=$comida";
                $resultado = mysqli_query($con, $sql);
                if(mysqli_num_rows($resultado)==0){
                    echo json_encode(array("result" => "error"));
                }else{
                    while($fila = mysqli_fetch_array($resultado)){
                        extract($fila);
                        $pesoAnterior = $pesoAnt;
                    }
                    $sql = "UPDATE comidas SET peso=$peso WHERE id_dieta=$dieta AND id=$comida";
                    if(mysqli_query($con, $sql)){
                        echo json_encode(array("result" => $pesoAnterior));
                    }else{
                        echo json_encode(array("result" => "error"));
                    }
                }
                
            }
            mysqli_close($con);            
        }
    }
?>