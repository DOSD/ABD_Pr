<?php 
        session_start();

        //Conecction to Data Base
        $db  = mysqli_connect('localhost','root','','abd_practica');


            if(isset($_POST["password"]) && isset($_POST["usuario"])){
                 $usuario = $_POST ["usuario"];
                 $password = $_POST ["password"];

                //Check if  user exists
                $checkUsername = mysqli_query($db, "SELECT Username FROM user WHERE Username = '$usuario'");
                if(mysqli_num_rows($checkUsername) == 1){
                  //Check if pasword isnt wrong
                    $checkPasword = mysqli_query($db, "SELECT Contrasenia FROM user WHERE Username = '$usuario'");
                    $pwd = mysqli_fetch_object($checkPasword);
                    if($pwd->Contrasenia != $password){
                      //Error when pasword is incorrect
                      echo "<script>alert('El nombre de usuario y/o contraseña incorrectos')</script>"; 
                    }
                    else{
                      //Loged in  succesfuly
                      $_SESSION['CurrentUser'] = $usuario;
                      if($usuario != "ADMIN"){
                        header("Location: userview.php");  
                      }
                      else{
                        header("Location: adminview.php");  
                      }
                    }

                  
                }
                else if(mysqli_num_rows($checkUsername) == 0){
                  //Error when username does not exists
                  echo "<script>alert('El nombre de usuario y/o contraseña incorrectos')</script>"; 
                } 
                else{
                  echo "<script>alert('Base de datos corrupta, intantalo mas tarde , perdona las molestias.')</script>"; 
                }
            }
          
         // mysqli_close($db);
        ?>


<!DOCTYPE html>
<html lang="es">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <script src="js/scripts.js" type="text/javascript"></script>

    <title>Formulario de login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">


    

</head>
<body>
  
  <form action="index.php" method="POST">
    <h2>Bienvenido a Melomanía</h2>
      <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input type="text" placeholder="Usuario" name="usuario" id="usuario" required="required">
      </div>

      <br width="50%"> <!-- salto de linea -->

      <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                       <input type="password" placeholder="Contraseña" name="password" id="password" required="required" class="input-psswd">
      </div>

      <br width="50%">

    <input type="submit"  value="Ingresar">

    <br />
    <P ALIGN="center"> ¿Aún no tienes tu cuenta? <a id="register" href="signup.php">Regístrate</a> </p>

  </form>

</body>
</html>