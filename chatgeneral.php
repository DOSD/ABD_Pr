<?php
  session_start();

    if(isset($_POST["mensaje"])){  

        $db  = mysqli_connect('localhost','root','','abd_practica');
         if (!$db){
        echo "<script>alert('pene')</script>";
       }
        $mensaje = $_POST ["mensaje"];
        $currentPartener="ALL";
        $currentUser=$_SESSION['CurrentUser'];
        
        $consulta="SELECT * FROM mensaje";
        $nummensajes=mysqli_num_rows( mysqli_query($db, $consulta)) ;
        $sql = "INSERT INTO mensaje VALUES ('$currentUser','$currentPartener','none',NOW(),'$mensaje','$nummensajes')";
        $result= mysqli_query($db, $sql);
       if (!$result){
        echo "<script>alert('pene')</script>";
       }
        mysqli_close($db);         
  }
?>


<!DOCTYPE html>
<html lang="es">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  <link href="styles/sb-admin.css" rel="stylesheet">
  <script src="js/scripts.js"></script>

    <title>Chat General</title>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['CurrentUser']; ?><span class="glyphicon glyphicon-triangle-bottom"></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li>
                            <a href="index.php"><span class="glyphicon glyphicon-off user-icon"></span> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
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
                           Melomanía<small>  Chat General</small>
                        </h1>
                    </div>
                </div>
                
 <div class="container">
    <div class="row form-group">
        <div class="col-xs-12 col-md-offset-2 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                </div>
                <div class="panel-body body-panel myscroll">
                    <ul class="chat mytable" >
                        <?php 
                            $db  = mysqli_connect('localhost','root','','abd_practica');

                            $currentPartener="ALL";
                            $currentUser=$_SESSION['CurrentUser'];
                            $nomensajes=true;
                            $sql = "SELECT * FROM mensaje";
                            $consulta = mysqli_query($db,$sql);

                            while($listaMensajes =  mysqli_fetch_object($consulta)){
                                if($listaMensajes->Receptor == "ALL" &&  $listaMensajes->Emisor != $currentUser){
                                    echo '<li class="left clearfix"><span class="chat-img pull-left">
                                            <img src="img/usermessage.png" alt="User Avatar" class="img-circle user-icon" /></span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font">' .$listaMensajes->Emisor. '</strong> <small class="pull-right text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>' .$listaMensajes->Fecha. '</small>
                                                </div>
                                                <p>' .$listaMensajes->Texto. '
                                                    
                                                </p>
                                            </div>
                                        </li>
                                        <br>';
                                        $nomensajes=false;

                                }
                                else if($listaMensajes->Emisor == $currentUser && $listaMensajes->Receptor == "ALL"){
                                    echo '<li class="left clearfix"><span class="chat-img pull-right">
                                            <img src="img/mymessage.png" alt="User Avatar" class="img-circle user-icon" /></span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <small class="pull-left text-muted"><span class="glyphicon glyphicon-time"></span>' .$listaMensajes->Fecha. '</small>
                                                    <strong class="pull-right primary-font">' .$listaMensajes->Emisor. '</strong> 
                                                </div>
                                                <br>
                                                <p class="pull-right">
                                                ' 
                                                    .$listaMensajes->Texto. 
                                                '</p>
                                            </div>
                                        </li>
                                         <br>';
                                         $nomensajes=false;
                                }
                            }
                            if($nomensajes){
                                echo "<h2 class='text-center'><small>Este grupo aun no tiene mensajes, sé el primero en mandar uno</small><h2>";
                            }
                            mysqli_close($db);
                        ?>
                    </ul>
                </div>
                <div class="panel-footer clearfix">
                    <form action='chatgeneral.php' method='post'>
                    <textarea class="form-control mytextarea" rows="3"   placeholder="Escribe tu mensaje aqui!" name="mensaje" required="required"></textarea>
                    <span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12 spanmargin">
                        <button class="btn btn-warning btn-lg btn-block" id="btn-chat" type="submit">Send</button>
                    </span>
                    </form>
                </div>
            </div>
        </div>
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