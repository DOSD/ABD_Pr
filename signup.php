 <?php 
        session_start();

        //Conecction to Data Base
        $db  = mysqli_connect('localhost','root','','abd_practica');

            if(isset($_POST["nombre"]) && isset($_POST ["password"]) && isset($_POST ["usuario"]) && isset($_POST ["email"]) && isset($_POST ["edad"]) && isset($_POST ["tipo"])){
                 $nombre = $_POST ["nombre"];
                 $password = $_POST ["password"];
                 $usuario = $_POST ["usuario"];
                 $email = $_POST ["email"];
                 $edad = $_POST ["edad"];
                 $tipo = $_POST ["tipo"];

                 if($usuario != "ALL" && $usuario != "ADMIN" && $usuario != "none"){
                    //Check if  username  alredy exists
                    $checkUsername = mysqli_query($db, "SELECT Username FROM user WHERE Username = '$usuario'");
                    if(mysqli_num_rows($checkUsername) != 0){
                      //Error when username alredy exists
                      echo "<script>alert('El nombre de usuario que has escogido ya existe, pofavor escoge otro')</script>"; 
                      //header("Location: signup.php");
                    }
                    else{
                      //register user into Data Base 
                      $sql="INSERT INTO user VALUES ('$nombre','$usuario','$password','$email','$edad','$tipo')";
                      if(!mysqli_query($db, $sql)){
                        echo "<script>alert('Algo ha fallado al registrarte. Intentalo de nuevo')</script>"; 
                      }
                      else{
                        $_SESSION['CurrentUser'] = $usuario;
                        $_SESSION['CurrentDB'] = $db;
                        echo "<script>alert('Has sido registrado correctamente')</script>"; 
                        header("Location: userview.php");  
                      }
                    } 
                  }
                  else{
                    echo "<script>alert('El nombre de usuario que has escogido es reservado para el sistema, pofavor escoge otro')</script>"; 
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

  <!-- <link rel="stylesheet" type="text/css" href="themes/default/css/style.css"> -->
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <!-- <script src="themes/default/js/scripts.js"></script> -->
  
  <script src="js/scripts.js" type="text/javascript"></script>

    <title>Formulario de registro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

 

</head>
<body>

    

  <form action="signup.php" method="POST">
    <h2>Bienvenido a Melomanía</h2>

    <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-font" data-toggle="tooltip" data-original-title="EL nombre debe ser  ..." ></i></span>
                <input type="text" placeholder="Nombre" name="nombre" id="nombre">
    </div>

    <br width="50%">

    <div class="input-group">

                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="text" placeholder="Email" name="email" id="email">

    </div>

    <br width="50%">

    <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
                <input type="number" min="0" placeholder="Edad" name="edad" id="edad" required="required">
    </div>

    <br width="50%">

    <div class="input-group">

                <span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
             
                <select class="form-control" name="tipo" id="tipo" required>
                  <?php 
                        $db  = mysqli_connect('localhost','root','','abd_practica');

                        $sql = "SELECT * FROM genero";
                        $consulta = mysqli_query($db,$sql);

                        echo "<option value='' hidden>Escoge tu tipo de mmusica preferido</option>";
                        while($listaGeneros =  mysqli_fetch_object($consulta)){
                          echo "<option value='" .$listaGeneros->Nombre. "'>" .$listaGeneros->Nombre. "</option>";
                        }
                         mysqli_close($db);
                    ?>

                </select>
    </div>

    <br width="50%">

    <div class="input-group">

                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" placeholder="Usuario" name="usuario" id="usuario">

    </div>

    <br width="50%">

    <div class="input-group">

                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" placeholder="Contraseña" name="password" id="password">

    </div>

    <br width="50%">

    <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                <input type="password" placeholder="Confirme su contraseña" name="confirmpassword" id="confirmpassword">
    </div>

    <br width="50%">


    <br width="50%">

    <input type="submit" onclick="return validaRegistro(this.form)"  value="Crear cuenta">

    </div>


     <br />
    <P ALIGN="center"> ¿Ya tienes cuenta? <a id="register" href="index.php">Inicia Sesión!</a> </p>

  </form>
         


</body>

<script type="application/javascript">
    document.getElementById('email').addEventListener("change", function () {
        if (!validemail.test(this.value)) {
            document.getElementById('email').style.border = "2px solid red";
            this.focus();
        } else {
            document.getElementById('email').style.border = "2px solid green";;
        }
    }, false);
</script>

</html>
