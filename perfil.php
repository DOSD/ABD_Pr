<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="es">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  <link href="styles/sb-admin.css" rel="stylesheet">
  <script src="js/scripts.js"></script>

    <title>Melomanía</title>
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
                <a class="navbar-brand" href="userview.php">MELOMANÍA</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ></span><?php echo $_SESSION['CurrentUser']; ?><span class="glyphicon glyphicon-triangle-bottom" ></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php"><span class="glyphicon glyphicon-user user-icon"></span> Mi perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="index.php"> <span class="glyphicon glyphicon-off user-icon"></span>Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="chatgeneral.php">Chat general</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo">Mis contactos </a>
                        <ul id="demo" class="collapse">
                            
                        <?php 
                            $db  = mysqli_connect('localhost','root','','abd_practica');
                            $sql = mysqli_query($db, "SELECT Username FROM user ");
                           
                            while($userslist =  mysqli_fetch_object($sql)){
                                if($userslist->Username != $_SESSION['CurrentUser'] && $userslist->Username != "ADMIN"){
                                    echo "<li><a href='privatechat.php?currentPartener=" .$userslist->Username. "'>" .$userslist->Username  . "</a></li>";
                                }
                            }
                            mysqli_close($db);
                        ?>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#dem">Mis grupos </a>
                        <ul id="dem" class="collapse">
                            <?php 
                            $db  = mysqli_connect('localhost','root','','abd_practica');
                            $usuarioActual = $_SESSION['CurrentUser'];
                            $sql_group = mysqli_query($db, "SELECT * FROM grupo ");
                            $sql_user = mysqli_query($db, "SELECT * FROM user WHERE Username = '$usuarioActual' ");
                            $uerInfo = mysqli_fetch_object($sql_user);
                            while($grouplist =  mysqli_fetch_object($sql_group)){
                                if($grouplist->Genero == $uerInfo->TipoMusica && $uerInfo->Edad >= $grouplist->EdadMinima && $uerInfo->Edad <= $grouplist->EdadMaxima){
                                     echo "<li><a href='groupchat.php?currentGroup=" .$grouplist->Nombre. "'>" .$grouplist->Nombre  . "</a></li>";
                                }
                            }
                            mysqli_close($db);
                        ?>
                        </ul>
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
                            Melomanía <small>Perfil de <?php echo $_SESSION['CurrentUser']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
           
           
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title"><?php echo $_SESSION['CurrentUser']; ?></h3>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/userpic.png" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 "> 
                          <table class="table table-user-information">
                            <tbody>
                            <?php
                                $db  = mysqli_connect('localhost','root','','abd_practica');
                                $usuarioActual = $_SESSION['CurrentUser'];
                                $sql_user = mysqli_query($db, "SELECT * FROM user WHERE Username = '$usuarioActual' ");
                                $uerInfo = mysqli_fetch_object($sql_user);
                                echo"
                                  <tr>
                                    <td>Nombre:</td>
                                    <td>".$uerInfo->Nombre."</td>
                                  </tr>
                                  <tr>
                                    <td>Nombre de usuario:</td>
                                    <td>".$uerInfo->Username."</td>
                                  </tr>
                                  <tr>
                                    <td>Edad</td>
                                    <td>".$uerInfo->Edad."</td>
                                  </tr> 
                                  <tr>
                                    <td>Tipo de musica preferido</td>
                                    <td>".$uerInfo->TipoMusica."</td>
                                  </tr>
                                  <tr>
                                    <td>Email</td>
                                    <td>".$uerInfo->Email."</td>
                                  </tr>
                                  ";
                                   mysqli_close($db);
                             ?> 
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                         
                  </div>
                </div>
              </div>
            </div>
                
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>

</body>
</html>