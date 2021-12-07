<?php
    session_start();
    
    if(isset($_POST['obtenerDietas'])){
        require("BDD.php");
        $sql = "SELECT id FROM dietas WHERE usuario='".$_SESSION['user_id']."'";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado) == 0){
            die("Ha habido un error al obtener las dietas");
        }else{
            $arrayIDS = [];
            while($fila = mysqli_fetch_array($resultado)){
                extract($fila);
                $arrayIDS[] = array("Dieta" => $id);
            }
            echo json_encode($arrayIDS, JSON_FORCE_OBJECT);
        }
        mysqli_close($con);
    }

    if(isset($_POST['obtenerAlimentos'])){
        require("BDD.php");
        $sql = "SELECT * FROM `alimentos`";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado) == 0){
            echo json_encode(array("result" => "No hay alimentos en la BDD"));
        }else{
            $respuesta = [];
            while($fila = mysqli_fetch_array($resultado)){
                extract($fila);
                $respuesta[] = array("ID" => $id, "Nombre" => $nombre, "Kcal" => $kcal, "Grasas" => $grasas, "Saturadas" => $saturadas, "Hidratos" => $hidratos, "Azucares" => $azucares, "Proteinas" => $proteinas, "Sal" => $sal, "Clase" => $clase);
            }
            echo json_encode($respuesta, JSON_FORCE_OBJECT);
        }
        mysqli_close($con);
    }

    if(isset($_POST['obtenerClases'])){
        require("BDD.php");
        $sql = "SELECT DISTINCT clase FROM alimentos";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado) == 0){
            echo json_encode(array("result" => "No hay ninguna clase"));
        }else{
            $respuesta = [];
            while($fila = mysqli_fetch_assoc($resultado)){
                extract($fila);
                $respuesta[] = array("Clase" => $clase);
            }
            echo json_encode($respuesta, JSON_FORCE_OBJECT);
        }
        mysqli_close($con);
    }

    if(isset($_POST['crearComida'])){
        if(isset($_POST['peso']) && isset($_POST['alimento']) && isset($_POST['nombreComida']) && isset($_POST['dieta'])){
            $peso = $_POST['peso']; $alimento = $_POST['alimento']; $comida = $_POST['nombreComida']; $dieta = $_POST['dieta'];

            if(is_numeric($peso)){
                if(comprobarIDAlimento($alimento)){
                    if(comprobarComida($comida)){
                        if(comprobarDieta($dieta)){
                            require("BDD.php");
                            $sql = "INSERT INTO comidas(nombre,id_dieta,id_alimento,peso) VALUES('$comida', $dieta, $alimento, $peso)";
                            if(mysqli_query($con, $sql)){
                                echo json_encode(array("result" => 0));
                            }else{
                                echo json_encode(array("result" => "Error al crear la comida"));
                            }
                        }else{
                            echo json_encode(array("result" => "La dieta no és válida"));
                        }
                    }else{
                        echo json_encode(array("result" => "La comida no és válida"));
                    }
                }else{
                    echo json_encode(array("result" => "Ese alimento no existe"));
                }
            }else{
                echo json_encode(array("result" => "El peso no es válido"));
            }
        }
    }

    if(isset($_POST['crearAlimento'])){
        if(isset($_POST['nombre']) && isset($_POST['kcal']) && isset($_POST['grasas']) && isset($_POST['saturadas']) && isset($_POST['hidratos']) && isset($_POST['azucares']) && isset($_POST['proteinas']) && isset($_POST['sal'])){
            $nombre = $_POST['nombre'];         $kcal = $_POST['kcal'];             $grasas = $_POST['grasas']; 
            $saturadas = $_POST['saturadas'];   $hidratos = $_POST['hidratos'];     $azucares = $_POST['azucares'];
            $proteinas = $_POST['proteinas'];   $sal = $_POST['sal'];

            if(comprobarNombre($nombre) && comprobarValor($kcal) && comprobarValor($grasas) && comprobarValor($saturadas) && comprobarValor($hidratos) && comprobarValor($azucares) && comprobarValor($proteinas) && comprobarValor($sal)){
                require("BDD.php");
                $sql = "INSERT INTO alimentos(nombre,kcal,grasas,saturadas,hidratos,azucares,proteinas,sal,clase) VALUES('$nombre', $kcal, $grasas, $saturadas, $hidratos, $azucares, $proteinas, $sal, 'Alimentos de Usuarios')";
                if(mysqli_query($con, $sql)){
                    echo json_encode(array("result" => 1));
                }else{
                    echo json_encode(array("result" => "Ha habido un error al crear el alimento"));
                }
            }else{
                echo json_encode(array("result" => "Ha habido un error con algún dato, intentalo de nuevo"));
            }
        }
    }

    function comprobarIDAlimento($id){
        require("BDD.php");
        $sql = "SELECT * FROM alimentos WHERE id=$id";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado)==0){
            return false;
        }else{
            return true;
        }
    }

    function comprobarComida($nombre){
        if($nombre == "Desayuno" || $nombre == "Almuerzo" || $nombre == "Comida" || $nombre == "Merienda" || $nombre == "Cena"){
            return true;
        }else{
            return false;
        }
    }

    function comprobarDieta($dieta){
        require("BDD.php");
        $sql = "SELECT id FROM dietas WHERE usuario='".$_SESSION['user_id']."' AND id=$dieta";
        $resultado = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultado) == 0){
            return false;
        }else{
            return true;
        }
    }

    function comprobarNombre($nombre){
        if($nombre != "" && strlen($nombre)<=30 && preg_match("/^[A-Za-z ]*$/",$nombre)){
            return true;
        }
        return false;
    }

    function comprobarValor($valor){
        if($valor != "" && is_numeric($valor) && $valor >= 00){
            return true;
        }
        return false;
    }
?>