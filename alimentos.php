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
    <link rel="stylesheet" href="CSS/alimentosStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="JS/alimentosJS.js" defer></script>
    <link rel="shortcut icon" href="IMG/Logo.png">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="IMG/LogoMisDietasBlanco.png" alt="Logo MisDietas" height="70px" style="padding: 5px;">
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" id='volver' class="navbar-btn a-nav"><span class="glyphicon glyphicon-log-out"></span> Volver</a></li>
                
            </ul>
        </div>
    </nav>

    <section>
        <div class="text-center">
            <form method="POST" class="form-inline">
                <div class="form-group col-sm-4">
                    <label for="nombre">Buscar: </label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introducir el nombre del alimento">
                    <button id="buscar" class="btn btn-success"><span class=" glyphicon glyphicon-search"></span></button>
                    <button id="borrar" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                </div>
                <div class="form-gorup col-sm-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAlimento" data-backdrop="static">Crear Alimento</button>
                </div>
                <div class="form-group col-sm-4">
                    <label for="clase">Filtrar por clase: </label>
                    <select name="clase" id="clase" class="form-control">
                        <option value="" selected>Todas</option>
                    </select>
                </div>
            </form>
            
            <div class="modal fade" id="ModalAlimento" role="dialog">
                <div class="modal-dialog modal-dialog-centered" style="width:90%">
                                        
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center" style="display: inline;">Crear Alimento</h4>
                            <details>
                                <summary><span class="glyphicon glyphicon-info-sign"></span>Información</summary>
                                <p class="text-warning">Los alimentos que creen los usuarios serán accesibles filtrandolos por la clase <i>Alimentos de Usuarios</i>, ya que como los valores no estan revisados no se sabe si son correctos o no.</p>
                            </details>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formAlimento">
                                <div class="row">
                                    <div class="col-sm-4"> 
                                        <label for="nombreAlimento">Nombre</label>
                                        <input type="text" class="form-control" name="nombreAlimento" id="nombreAlimento" placeholder="Nombre del alimento">
                                        <p id="estadoNombre" class="text-danger" style="color:white">_</p>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label for="kcal">Calorias</label>
                                        <input type="number" class="form-control" name="kcal" id="kcal" placeholder="Calorias del alimento">
                                        <p id="estadoKcal" class="text-danger" style="color:white">_</p>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label for="grasas">Grasas</label>
                                        <input type="number" class="form-control" name="grasas" id="grasas" placeholder="Grasas del alimento">
                                        <p id="estadoGrasas" class="text-danger" style="color:white">_</p>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label for="saturadas">Grasas Saturadas</label>
                                        <input type="number" class="form-control" name="saturadas" id="saturadas" placeholder="G.Saturadas del alimento">
                                        <p id="estadoSaturadas" class="text-danger" style="color:white">_</p>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label for="hidratos">Hidratos de Carbono</label>
                                        <input type="number" class="form-control" name="hidratos" id="hidratos" placeholder="Hidratos de carbono del alimento">
                                        <p id="estadoHidratos" class="text-danger" style="color:white">_</p>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label for="azucares">Azúcares</label>
                                        <input type="number" class="form-control" name="azucares" id="azucares" placeholder="Azúcares del alimento">
                                        <p id="estadoAzucares" class="text-danger" style="color:white">_</p>
                                    </div>

                                    <div class="col-sm-4 col-sm-offset-2">
                                        <label for="proteinas">Proteinas</label>
                                        <input type="number" class="form-control" name="proteinas" id="proteinas" placeholder="Proteinas del alimento">
                                        <p id="estadoProteinas" class="text-danger" style="color:white">_</p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="sal">Sal</label>
                                        <input type="number" class="form-control" name="sal" id="sal" placeholder="Sal del alimento">
                                        <p id="estadoSal" class="text-danger" style="color:white">_</p>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-success">Crear Alimento</button>
                                        <p id="resultado"></p>
                                    </div>
                                </div>
                                
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                                        
                </div>
            </div>
        </div> 
        <br><br><br>
        <div class="container-fluid">
            <div class="row " id="divAlimentos"></div>
        </div>
        
    </section>

    <footer class="footer container-fluid" style="background-color: green; min-height: 80px; color: white;">
      <div class="main" style="min-height: 50px;"></div>
      <p style="padding-left: 5px; display: inline-block;">MisDietas.es</p>
      <p style="float: right; padding-right: 5px;">By Jordi Martinez Grau</p>
    </footer>
</body>
</html>