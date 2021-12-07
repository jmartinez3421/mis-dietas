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
    <link rel="stylesheet" href="CSS/modPerfilStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="JS/modPerfilJS.js" defer></script>
    <link rel="shortcut icon" href="IMG/Logo.png">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="IMG/LogoMisDietasBlanco.png" alt="Logo MisDietas" height="70px" style="padding: 5px;">
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="dietas.php" id='volver' class="navbar-btn a-nav"><span class="glyphicon glyphicon-log-out"></span> Volver</a></li>
                
            </ul>
        </div>
    </nav>
    
    <section>
    
    <form method="POST" id="formMod">
            <div class="row" style="padding-top: 10px;">
                <div class="form-group col-sm-4 col-sm-offset-2 text-center">
                    <label for="user">Usuario</label><br>
                    <b><?php echo $_SESSION['user_id'] ?></b>
                </div>
                <div class="form-group col-sm-4 text-center">
                    <label for="pwd">Contraseña</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Introducir contraseña">
                    <p id="estadoPass" class="text-danger" style="display: none;"></p>
                </div>
            </div>

            <div class="row" style="padding-top: 10px;">
                <div class="form-group col-sm-4 col-sm-offset-2 text-center">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Introducir nombre">
                    <p id="estadoNombre" class="text-danger" style="display: none;"></p>
                </div>
                <div class="form-group col-sm-4 text-center">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" placeholder="Introducir apellidos">
                    <p id="estadoApellidos" class="text-danger" style="display: none;"></p>
                </div>
            </div>

            <div class="row" style="padding-top: 10px;">
                <div class="form-group col-sm-4 col-sm-offset-2 text-center">
                    <label for="nombre">Edad</label>
                    <input type="number" class="form-control" id="edad" placeholder="Introducir edad">
                    <p id="estadoEdad" class="text-danger" style="display: none;"></p>
                </div>
                <div class="form-group col-sm-4 text-center">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="Hombre" selected>Hombre</option>
                        <option value="Mujer">Mujer</option>
                    </select>
                    <p id="estadoSexo" class="text-danger" style="display: none;"></p>
                </div>
            </div>

            <div class="row" style="padding-top: 10px;">
                <div class="form-group col-sm-4 col-sm-offset-2 text-center">
                    <label for="peso">Peso (Kg)</label>
                    <input type="number" step='0.01' class="form-control" id="peso" placeholder="Introducir peso">
                    <p id="estadoPeso" class="text-danger" style="display: none;"></p>
                </div>
                <div class="form-group col-sm-4 text-center">
                    <label for="altura">Altura (cm)</label>
                    <input type="number" class="form-control" id="altura" placeholder="Introducir altura">
                    <p id="estadoAltura" class="text-danger" style="display: none;"></p>
                </div>
            </div>

            <div class="row" id="divResultado" style="display: none;">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <p class="text-danger" id="pResultado"></p>
                </div>                
            </div>

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <button type="submit" class="btn btn-success btn-lg">Actualizar</button>
                </div>                
            </div>
            
          </form>
    </section>

    <footer class="footer container-fluid" style="background-color: green; min-height: 80px; color: white;">
      <div class="main" style="min-height: 50px;"></div>
      <p style="padding-left: 5px; display: inline-block;">MisDietas.es</p>
      <p style="float: right; padding-right: 5px;">By Jordi Martinez Grau</p>
    </footer>
</body>
</html>