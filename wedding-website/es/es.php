<!DOCTYPE html>
<html>
  <head>
  <link href='https://fonts.googleapis.com/css?family=Josefin+Slab: 600|Dancing+Script:400,700|Amaranth|Great+Vibes' rel='stylesheet' type='text/css'>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../style.css"/>
  </head>
  <title>Bienvenidos</title>
  <body>

    <div class="welcome">
      <div class="header">
          <h1>Joseph y Catalina</h1>
          <h2>Bienvenidos</h2>
      </div>
    </div>
    <div class="menu">
      <div class="container">
        <ul class="nav">
          <li><a href="es.php">Bienvenidos</li>
          <li><a href="matrimonio.html">Matrimonio</a></li>
          <li><a href="programa.php">Programa</a></li>
          <li><a href="hoteles.php">Hoteles</a></li>
          <li><a href="regalos.html">Regalos</a></li>
          <li><a href="../rsvp.php">RSVP</a></li>
        </ul>
      </div>
    </div>

    <div class="box">
      <div class="container">
        <h1>Bienvenidos al website de nuestro matrimonio!</h1>
        <p>Estamos super ansiosos de celebrar este dia tan especial con ustedes! Aca encontraran toda la información relativa al matrimonio y los planes que tenemos para esos días.<b> Esta abierto el RSVP!</b> Dejanos tu nombre y lo que vas a querer comer para la cena de la boda. Tambien pueden ver información de hoteles y el programa para los dias de la boda. Si hay algo que busquen y no encuentran, o tienen preguntas, no duden en hacérmelo saber.</p>
        <p>Sinceramente,</p>
        <p>Joe y Catalina</p>
      </div>
    </div>

    <?php

      $servername = "mysql.joeandcata.com";
      $username = "joeandcata";
      $password = "Lacrimosa7";
      $dbname = "joeandcata_wedding";

      $nameErr = $emailErr = $success = "";
      $name = $email = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
          $nameErr = "*Nombre es requerido.";
        } else {
          $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
          $emailErr = "*Email es requerido.";
        } else {
          $email = test_input($_POST["email"]);
        }

        if ($name != "" and $email != "") {
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
           }
          $sql = "INSERT INTO EmailAddresses (Name, Email) VALUES ('$name', '$email')";
          if (mysqli_query($conn,$sql)) {
           $success = "<br>Su informacion fue enviada exitosamente!";
          } else {  
          $success = "Error:" . $sql . "<br>" . mysqli_error($conn);
          }
          mysqli_close($conn);
        }
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

   ?>
    <div class="box">
      <div class="container">
        <h2>Interesado en recibir notificaciones de actualizaciones en el sitio?</h2>
        <p>Si nos entregas tu informacion a continuación, se les enviara notificaciones de mayores cambios en el programa de la boda.  </p>
        <form id="signup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
             <label for="name">Nombre: </label>
             <input type="text" name="name" class="form-field" id="name"><span class="error"><?php echo $nameErr;?></span><br>
             <label for="email">Email:  </label>
             <input type="text" name="email" class="form-field" sid="email"><span class="error"><?php echo $emailErr;?></span><br>
             <button type="submit" class="btn">Enviar</button>
             <span type="error"><?php echo $success;?></span>
         </form>
      </div>
    </div>


    <div class="footer">
      <div class="container">
        <p>&copy; Catalina Astengo 2015</p>
      </div>
    </div> 

    <?php 

        if ($success != "" or $nameErr != "" or $emailErr != "") {
          ?>
          <script>
             window.location="#signup";
          </script>
          <?php } ?>

  </body>
</html>