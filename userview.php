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
                            Melomanía <small>Página Principal</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2 class="centertext">Bienvenido a Melomanía </h2>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="center">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="circle-img img-circle">
                          <img src="img/chatgeneral.png" >
                        </div>
                        <br>
                          <p>Aqui ira texto de la descripcion del chat general</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="circle-img img-circle">
                          <img src="img/chatgrupal.jpeg" >
                        </div>
                        <br>
                          <p>Aqui ira texto de la descripcion del chat grupal</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  ">
                        <div class="circle-img img-circle">
                          <img src="img/cahtprivado.png" >
                        </div>
                        <br>
                          <p>Aqui ira texto de la descripcion del chat privado</p>
                    </div>
                </div>
                <!-- /.row -->

                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>

</body>
</html>