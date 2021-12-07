<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: index.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MisDietas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/dietasStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="JS/dietasJS.js" defer></script>
    <link rel="shortcut icon" href="IMG/Logo.png">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="IMG/LogoMisDietasBlanco.png" alt="Logo MisDietas" height="70px" style="padding: 5px;">
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown" style="margin-right: 5px;">
                    <a class="dropdown-toggle navbar-btn a-nav" data-toggle="dropdown" style="margin-bottom: 0px;">Menú 
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="modPerfil.php"><span class="glyphicon glyphicon-cog"></span> Modificar Perfil</a></li>
                        <li><a href="ayuda.html"><span class="glyphicon glyphicon-info-sign"></span> Ayuda</a></li>
                        <li><a href="PHP/logout.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <section>
        <ul class="nav nav-pills">
            <li id="a1"><a data-toggle="pill" href="#dieta1">Dieta 1</a></li>
            <li id="a2"><a data-toggle="pill" href="#dieta2">Dieta 2</a></li>
            <li id="a3"><a data-toggle="pill" href="#dieta3">Dieta 3</a></li>
        </ul>

        <div class="tab-content">
            <div id="dieta1" class="tab-pane fade">
                <div class="text-center" style="margin:0 auto; margin-top: 10px; width: fit-content">
                    <form class="form-inline" method="POST" id="formObjetivos1">
                        <div class="form-group">
                            <label for="objetivo1">Objetivo</label><br>
                            <select name="objetivo" id="objetivo1" class="form-control">
                                <option value="-500">Definición (-500Kcal)</option>
                                <option value="-200">Definición (-200 Kcal)</option>
                                <option value="00" selected>Mantenimiento</option>
                                <option value="200">Volumen (+200 Kcal)</option>
                                <option value="500">Volumen (+500 Kcal)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            &nbsp;
                        </div>
                        <div class="form-group">
                            <label for="actividadFisica1">Actividad Física</label><br>
                            <select name="actividadFisica" id="actividadFisica1" class="form-control">
                                <option value='1.2'>Poco ejercicio o nulo</option>
                                <option value='1.375'>Ejercicio ligero(1 a 3 días a la semana)</option>
                                <option value='1.55'>Ejercicio moderado(3 a 5 días a la semana)</option>
                                <option value='1.72'>Deportista(6 a 7 días a la semana)</option>
                                <option value='1.9'>Atleta(entrenamientos mañana y tarde)</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="container-fluid" style="margin-top: 20px;">
                    <table class="table T1" id='dieta1'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Calorias</th>
                                <th class="grasasT">Grasas</th>
                                <th class='saturadasT'><abbr title="Grasas Saturadsa">Saturadas</abbr> </th>
                                <th class="hidratosT"><abbr title='Hidratos de Carbono'>HC</abbr></th>
                                <th class="azucaresT">Azucar</th>
                                <th class="proteinasT">Proteina</th>
                                <th class='salT'>Sal</th>
                                <th><abbr title="En gramos">Peso(g)</abbr></th>
                            </tr>
                        </thead>
                        <tbody id="desayuno1">
                            <tr>
                                <th class="tituloComida" colspan="9"><h4><b>Desayuno</b></h4></th>
                            </tr>
                            <tr class="boton">
                                <td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Desayuno&id_dieta=0' class="btn btn-success">+ Añadir</a></td>
                            </tr>
                        </tbody>                        
                        <tbody id="almuerzo1">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Almuerzo</b></h4></th>
                            </tr>
                            <tr class="boton">
                                <td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Almuerzo&id_dieta=0' class="btn btn-success">+ Añadir</a></td>
                            </tr>
                        </tbody>                        
                        <tbody id="comida1">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Comida</b></h4></th>
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Comida&id_dieta=0' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        <tbody id="merienda1">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Merienda</b></h4></th>
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Merienda&id_dieta=0' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        <tbody id="cena1">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Cena</b></h4></th>                                
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Cena&id_dieta=0' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        
                        <tbody>
                            <tr id="suma1">
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Llevas</button>
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Valores nutricionales actuales</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="margin: 0 auto;">
                                                    <tr><th>Calorias: </th><td class="total"></td></tr>
                                                    <tr><th>Grasas: </th><td class="total"></td></tr>
                                                    <tr><th>G.Saturadas: </th><td class="total"></td></tr>
                                                    <tr><th>Hidratos: </th><td class="total"></td></tr>
                                                    <tr><th>Azúcares: </th><td class="total"></td></tr>
                                                    <tr><th>Proteinas: </th><td class="total"></td></tr>
                                                    <tr><th>Sal: </th><td class="total"></td></tr>                                                                                                             
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td><abbr title='Calorias' class="total"></abbr></td>
                                <td class="grasasT"><abbr title='Grasas' class="total"></abbr></td>
                                <td class="saturadasT"><abbr title='Grasas Saturadas' class="total saturadasT"></abbr></td>
                                <td class="hidratosT"><abbr title='Hidratos de Carbono' class="total"></abbr></td>
                                <td class="azucaresT"><abbr title='Azúcares' class="total azucaresT"></abbr></td>
                                <td class="proteinasT"><abbr title='Proteinas' class="total"></abbr></td>
                                <td class="salT"><abbr title='Sal' class="total salT"></abbr></td>
                            </tr>
                            <tr id="total1">
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">Necesitas</button>
                                    <div class="modal fade" id="myModal2" role="dialog">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Necesitas los siguientes valores nutricionales</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="margin: 0 auto;">
                                                    <tr><th>Calorias: </th><td class="TMB"></td></tr>
                                                    <tr><th>Grasas: </th><td class="TMB"></td></tr>
                                                    <tr><th>G.Saturadas: </th><td class="TMB"></td></tr>
                                                    <tr><th>Hidratos: </th><td class="TMB"></td></tr>
                                                    <tr><th>Azúcares: </th><td class="TMB"></td></tr>
                                                    <tr><th>Proteinas: </th><td class="TMB"></td></tr>
                                                    <tr><th>Sal: </th><td class="TMB"></td></tr>                                                                                                             
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td><abbr title='Calorias' class="TMB"></abbr></td>
                                <td class="grasasT"><abbr title='Grasas' class="TMB"></abbr></td>
                                <td class="saturadasT"><abbr title='Grasas Saturadas' class="TMB"></abbr></td>
                                <td class="hidratosT"><abbr title='Hidratos de Carbono' class="TMB"></abbr></td>
                                <td class="azucaresT"><abbr title='Azúcares' class="TMB"></abbr></td>
                                <td class="proteinasT"><abbr title='Proteinas' class="TMB"></abbr></td>
                                <td class="salT"><abbr title='Sal' class="TMB salT"></abbr></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class='btn btn-success imprimir' style="margin-bottom: 10px;" value="T1"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                </div>
            </div>
            <div id="dieta2" class="tab-pane fade">
                <div class="text-center" style="margin:0 auto; margin-top: 10px; width: fit-content">
                    <form class="form-inline" method="POST" id="formObjetivos1">
                        <div class="form-group">
                            <label for="objetivo2">Objetivo</label><br>
                            <select name="objetivo" id="objetivo2" class="form-control">
                                <option value="-500">Definición (-500Kcal)</option>
                                <option value="-200">Definición (-200 Kcal)</option>
                                <option value="00" selected>Mantenimiento</option>
                                <option value="200">Volumen (+200 Kcal)</option>
                                <option value="500">Volumen (+500 Kcal)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            &nbsp;
                        </div>
                        <div class="form-group">
                            <label for="actividadFisica2">Actividad Física</label><br>
                            <select name="actividadFisica" id="actividadFisica2" class="form-control">
                                <option value='1.2'>Poco ejercicio o nulo</option>
                                <option value='1.375'>Ejercicio ligero(1 a 3 días a la semana)</option>
                                <option value='1.55'>Ejercicio moderado(3 a 5 días a la semana)</option>
                                <option value='1.72'>Deportista(6 a 7 días a la semana)</option>
                                <option value='1.9'>Atleta(entrenamientos mañana y tarde)</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="container-fluid" style="margin-top: 20px;">
                    <table class="table T2" id='dieta2'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Calorias</th>
                                <th class="grasasT">Grasas</th>
                                <th class='saturadasT'><abbr title="Grasas Saturadsa">Saturadas</abbr> </th>
                                <th class="hidratosT"><abbr title='Hidratos de Carbono'>HC</abbr></th>
                                <th class="azucaresT">Azucar</th>
                                <th class="proteinasT">Proteina</th>
                                <th class='salT'>Sal</th>
                                <th><abbr title="En gramos">Peso(g)</abbr></th>
                            </tr>
                        </thead>
                        <tbody id="desayuno2">
                            <tr>
                                <th class="tituloComida" colspan="9"><h4><b>Desayuno</b></h4></th>
                            </tr>
                            <tr class="boton">
                                <td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Desayuno&id_dieta=1' class="btn btn-success">+ Añadir</a></td>
                            </tr>
                        </tbody>                        
                        <tbody id="almuerzo2">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Almuerzo</b></h4></th>
                            </tr>
                            <tr class="boton">
                                <td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Almuerzo&id_dieta=1' class="btn btn-success">+ Añadir</a></td>
                            </tr>
                        </tbody>                        
                        <tbody id="comida2">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Comida</b></h4></th>
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Comida&id_dieta=1' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        <tbody id="merienda2">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Merienda</b></h4></th>
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Merienda&id_dieta=1' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        <tbody id="cena2">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Cena</b></h4></th>                                
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Cena&id_dieta=1' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        
                        <tbody>
                            <tr id="suma2">
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3">Llevas</button>
                                    <div class="modal fade" id="myModal3" role="dialog">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Valores nutricionales actuales</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="margin: 0 auto;">
                                                    <tr><th>Calorias: </th><td class="total"></td></tr>
                                                    <tr><th>Grasas: </th><td class="total"></td></tr>
                                                    <tr><th>G.Saturadas: </th><td class="total"></td></tr>
                                                    <tr><th>Hidratos: </th><td class="total"></td></tr>
                                                    <tr><th>Azúcares: </th><td class="total"></td></tr>
                                                    <tr><th>Proteinas: </th><td class="total"></td></tr>
                                                    <tr><th>Sal: </th><td class="total"></td></tr>                                                                                                             
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td><abbr title='Calorias' class="total"></abbr></td>
                                <td class="grasasT"><abbr title='Grasas' class="total"></abbr></td>
                                <td class="saturadasT"><abbr title='Grasas Saturadas' class="total saturadasT"></abbr></td>
                                <td class="hidratosT"><abbr title='Hidratos de Carbono' class="total"></abbr></td>
                                <td class="azucaresT"><abbr title='Azúcares' class="total azucaresT"></abbr></td>
                                <td class="proteinasT"><abbr title='Proteinas' class="total"></abbr></td>
                                <td class="salT"><abbr title='Sal' class="total salT"></abbr></td>
                            </tr>
                            <tr id="total2">
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal4">Necesitas</button>
                                    <div class="modal fade" id="myModal4" role="dialog">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Necesitas los siguientes valores nutricionales</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="margin: 0 auto;">
                                                    <tr><th>Calorias: </th><td class="TMB"></td></tr>
                                                    <tr><th>Grasas: </th><td class="TMB"></td></tr>
                                                    <tr><th>G.Saturadas: </th><td class="TMB"></td></tr>
                                                    <tr><th>Hidratos: </th><td class="TMB"></td></tr>
                                                    <tr><th>Azúcares: </th><td class="TMB"></td></tr>
                                                    <tr><th>Proteinas: </th><td class="TMB"></td></tr>
                                                    <tr><th>Sal: </th><td class="TMB"></td></tr>                                                                                                             
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td><abbr title='Calorias' class="TMB"></abbr></td>
                                <td class="grasasT"><abbr title='Grasas' class="TMB"></abbr></td>
                                <td class="saturadasT"><abbr title='Grasas Saturadas' class="TMB"></abbr></td>
                                <td class="hidratosT"><abbr title='Hidratos de Carbono' class="TMB"></abbr></td>
                                <td class="azucaresT"><abbr title='Azúcares' class="TMB"></abbr></td>
                                <td class="proteinasT"><abbr title='Proteinas' class="TMB"></abbr></td>
                                <td class="salT"><abbr title='Sal' class="TMB salT"></abbr></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class='btn btn-success imprimir' style="margin-bottom: 10px;" value="T2"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                </div>
            </div>
            <div id="dieta3" class="tab-pane fade">
                <div class="text-center" style="margin:0 auto; margin-top: 10px; width: fit-content">
                    <form class="form-inline" method="POST" id="formObjetivos1">
                        <div class="form-group">
                            <label for="objetivo3">Objetivo</label><br>
                            <select name="objetivo" id="objetivo3" class="form-control">
                                <option value="-500">Definición (-500 Kcal)</option>
                                <option value="-200">Definición (-200 Kcal)</option>
                                <option value="00" selected>Mantenimiento</option>
                                <option value="200">Volumen (+200 Kcal)</option>
                                <option value="500">Volumen (+500 Kcal)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            &nbsp;
                        </div>
                        <div class="form-group">
                            <label for="actividadFisica3">Actividad Física</label><br>
                            <select name="actividadFisica" id="actividadFisica3" class="form-control">
                                <option value='1.2'>Poco ejercicio o nulo</option>
                                <option value='1.375'>Ejercicio ligero(1 a 3 días a la semana)</option>
                                <option value='1.55'>Ejercicio moderado(3 a 5 días a la semana)</option>
                                <option value='1.72'>Deportista(6 a 7 días a la semana)</option>
                                <option value='1.9'>Atleta(entrenamientos mañana y tarde)</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="container-fluid" style="margin-top: 20px;">
                    <table class="table T3" id='dieta3'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Calorias</th>
                                <th class="grasasT">Grasas</th>
                                <th class='saturadasT'><abbr title="Grasas Saturadsa">Saturadas</abbr> </th>
                                <th class="hidratosT"><abbr title='Hidratos de Carbono'>HC</abbr></th>
                                <th class="azucaresT">Azucar</th>
                                <th class="proteinasT">Proteina</th>
                                <th class='salT'>Sal</th>
                                <th><abbr title="En gramos">Peso(g)</abbr></th>
                            </tr>
                        </thead>
                        <tbody id="desayuno3">
                            <tr>
                                <th class="tituloComida" colspan="9"><h4><b>Desayuno</b></h4></th>
                            </tr>
                            <tr class="boton">
                                <td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Desayuno&id_dieta=2' class="btn btn-success">+ Añadir</a></td>
                            </tr>
                        </tbody>                        
                        <tbody id="almuerzo3">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Almuerzo</b></h4></th>
                            </tr>
                            <tr class="boton">
                                <td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Almuerzo&id_dieta=2' class="btn btn-success">+ Añadir</a></td>
                            </tr>
                        </tbody>                        
                        <tbody id="comida3">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Comida</b></h4></th>
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Comida&id_dieta=2' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        <tbody id="merienda3">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Merienda</b></h4></th>
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Merienda&id_dieta=2' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        <tbody id="cena3">
                            <tr>
                                <th colspan="9" class="tituloComida"><h4><b>Cena</b></h4></th>                                
                            </tr>
                            <tr class="boton"><td  style="vertical-align:bottom;"><a href='alimentos.php?nombre_comida=Cena&id_dieta=2' class="btn btn-success">+ Añadir</a></td></tr>
                        </tbody>
                        
                        <tbody>
                            <tr id="suma3">
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal5">Llevas</button>
                                    <div class="modal fade" id="myModal5" role="dialog">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Valores nutricionales actuales</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="margin: 0 auto;">
                                                    <tr><th>Calorias: </th><td class="total"></td></tr>
                                                    <tr><th>Grasas: </th><td class="total"></td></tr>
                                                    <tr><th>G.Saturadas: </th><td class="total"></td></tr>
                                                    <tr><th>Hidratos: </th><td class="total"></td></tr>
                                                    <tr><th>Azúcares: </th><td class="total"></td></tr>
                                                    <tr><th>Proteinas: </th><td class="total"></td></tr>
                                                    <tr><th>Sal: </th><td class="total"></td></tr>                                                                                                             
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td><abbr title='Calorias' class="total"></abbr></td>
                                <td class="grasasT"><abbr title='Grasas' class="total"></abbr></td>
                                <td class="saturadasT"><abbr title='Grasas Saturadas' class="total saturadasT"></abbr></td>
                                <td class="hidratosT"><abbr title='Hidratos de Carbono' class="total"></abbr></td>
                                <td class="azucaresT"><abbr title='Azúcares' class="total azucaresT"></abbr></td>
                                <td class="proteinasT"><abbr title='Proteinas' class="total"></abbr></td>
                                <td class="salT"><abbr title='Sal' class="total salT"></abbr></td>
                            </tr>
                            <tr id="total3">
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal6">Necesitas</button>
                                    <div class="modal fade" id="myModal6" role="dialog">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Necesitas los siguientes valores nutricionales</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="margin: 0 auto;">
                                                    <tr><th>Calorias: </th><td class="TMB"></td></tr>
                                                    <tr><th>Grasas: </th><td class="TMB"></td></tr>
                                                    <tr><th>G.Saturadas: </th><td class="TMB"></td></tr>
                                                    <tr><th>Hidratos: </th><td class="TMB"></td></tr>
                                                    <tr><th>Azúcares: </th><td class="TMB"></td></tr>
                                                    <tr><th>Proteinas: </th><td class="TMB"></td></tr>
                                                    <tr><th>Sal: </th><td class="TMB"></td></tr>                                                                                                             
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td><abbr title='Calorias' class="TMB"></abbr></td>
                                <td class="grasasT"><abbr title='Grasas' class="TMB"></abbr></td>
                                <td class="saturadasT"><abbr title='Grasas Saturadas' class="TMB"></abbr></td>
                                <td class="hidratosT"><abbr title='Hidratos de Carbono' class="TMB"></abbr></td>
                                <td class="azucaresT"><abbr title='Azúcares' class="TMB"></abbr></td>
                                <td class="proteinasT"><abbr title='Proteinas' class="TMB"></abbr></td>
                                <td class="salT"><abbr title='Sal' class="TMB salT"></abbr></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class='btn btn-success imprimir' style="margin-bottom: 10px;" value="T3"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" style="background-color: green; min-height: 80px; color: white;">
      <div class="main" style="min-height: 50px;"></div>
      <p style="padding-left: 5px; display: inline-block;">MisDietas.es</p>
      <p style="float: right; padding-right: 5px;">By Jordi Martinez Grau</p>
    </footer>
</body>
</html>