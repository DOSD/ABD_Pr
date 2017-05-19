<?php
  session_start();

  $db  = mysqli_connect('localhost','root','','abd_practica');

            if(isset($_POST["nombre"]) && isset($_POST ["genero"]) && isset($_POST ["edadminima"]) && isset($_POST ["edadmaxima"])){
                 $nombre = $_POST ["nombre"];
                 $genero = $_POST ["genero"];
                 $edadminima = $_POST ["edadminima"];
                 $edadmaxima = $_POST ["edadmaxima"];

               
                      $sql="INSERT INTO grupo VALUES ('$nombre','$genero','$edadminima','$edadmaxima')";
                      if(!mysqli_query($db, $sql)){
                        echo "<script>alert('Algo ha fallado al registrar el grupo. Intentalo de nuevo')</script>"; 
                      }
                      else{ 
                        header("Location: adminview.php");  
                      }
              }
          mysqli_close($db);
?>


<!DOCTYPE html>
<html lang="es">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  <link href="styles/sb-admin.css" rel="stylesheet">
  <script src="js/scripts.js"></script>

    <title>Administración</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

</head>
<body>
  
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="adminview.php">MELOMANÍA</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['CurrentUser']; ?><span class="glyphicon glyphicon-triangle-bottom"></a>
                    <ul class="dropdown-menu">
                        
                        <li class="divider"></li>
                        <li>
                            <a href="index.php" ><span class="glyphicon glyphicon-off user-icon"></span> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="vergrupos.php">Ver todos los grupos</a>
                    </li>
                    <li>
                        <a href="dardealtagrupo.php">Dar de alta Grupo</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div class="container-fluid page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Melomanía <small>Crea un grupo</small>
                        </h1>
                    </div>
                </div>
                 
                <form class="form-horizontal" action="dardealtagrupo.php" method="POST">

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el Nombre" required>
                      </div>
                    </div>
                   
                   
                    <fieldset class="form-group">
                       <label class="control-label col-sm-2" >Genero:</label>
                      <div class="col-sm-offset-2 col-sm-10 row">
                        <?php
                            $db  = mysqli_connect('localhost','root','','abd_practica');

                        $sql = "SELECT * FROM genero";
                        $consulta = mysqli_query($db,$sql);

                     
                        while($listaGeneros =  mysqli_fetch_object($consulta)){
                          echo '<div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="genero" value ="' .$listaGeneros->Nombre. '"required>' .$listaGeneros->Nombre. '
                              </label>
                            </div>';
                        }
                            mysqli_close($db);
                        ?>
                      </div>
                    </fieldset>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="edadminima">Edad Mínima:</label>
                      <div class="col-sm-10">
                        <input type="number" min="0" class="form-control" placeholder="Introduce Edad Mínima" name="edadminima" id="edadminima" required="required">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="edadmaxima">Edad Maxima:</label>
                      <div class="col-sm-10">
                        <input type="number"  min="0" class="form-control" placeholder="Introduce Edad Máxima" name="edadmaxima" id="edadmaxima" required="required">
                      </div>
                    </div>
                   
                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                      </div>
                    </div>
                  </form>
        </div>
        <!-- /#page-wrapper -->

    </div>

</body>
</html>