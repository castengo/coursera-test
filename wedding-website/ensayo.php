<!DOCTYPE html>
<html>
  <head>
	<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light|Oswald:700' rel='stylesheet' type='text/css'>
	 <link rel="stylesheet" href="rehstyle.css"/>
	 <meta name=viewport content='width=600'>
  </head>
  <title>Cena de Ensayo</title>
  <body>
  	<div class="white">
  		<div class="language">
	  		<a href="dinner.php" class="btn">English</a>
	  		<a href="ensayo.php" class="btn">Espanol</a>
	  	</div>
  	</div>
    <div class="blue">
      <div class="container-text">
        <h2>Ensayo de boda de Joe y Catalina</h2>
        <p>Estas cordialmente invitado a nuestra cena de ensayo de boda el Viernes antes de el matrimonio! Ven a pasarla bien a una exquisita cena italiana con la mejor compania y cocktails. Toda la informacion se encuentra en este website, pero si tienen preguntas no duden en contactarse con Catalina, numero de celular (928) 965-1214.</p>
      </div>
    </div>
  	<div class="white">
	  	<div class="container-picture">
	  		<a href="http://www.marriott.com/hotels/travel/lasjw-jw-marriott-las-vegas-resort-and-spa"/><img src="https://apis.xogrp.com/media-api/images/ecfec57a-293a-4cdb-9526-b9fa7bcfc5d1~rs_2001.480.fit"/></a>
  		</div>
  		<div class="container-text">
  			<h2>Ensayo de Boda</h2>
  			<p>Lugar: JW Marriott Las Vegas Resort & Spa</p>
  			<p>Fecha: Viernes 15 de Abril del 2016 a las 4:00 PM</p>
  			<p>Invitados: Padres de los novios, groomsmen, bridesmaids, flower girl, y ring bearer.</p>
  		</div>
  	</div>
  	<div class="blue">
  		<div class="container-text">
  			<h2>Cena de Ensayo de Boda</h2>
  			<p>Lugar: Brio Tuscan Grille</p>
  			<p>Fecha: Viernes 15 de Abril del 2016 a las 5:00 PM</p>
  			<p>Invitados: Hermanos y hermanas de Marco y Rosemarie, y las abuelitas.</p>
  		</div>
  		<div class="container-picture">
  			<a href="http://www.brioitalian.com/town_square.html"><img src="http://images.taubman.com/www.shopwestfarms.com/asset/get/19061"/></a>
  		</div>
  	</div>
    <?php

      $servername = "mysql.joeandcata.com";
      $username = "joeandcata";
      $password = "Lacrimosa7";
      $dbname = "joeandcata_wedding";

      $nameErr = $attendErr = $foodErr = $success = "";
      $name = $attend = $food = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
          $nameErr = "*El nombre es requerido";
        } else {
          $name = test_input($_POST["name"]);
        }

        if (empty($_POST["attend"])) {
          $attendErr = "*Elija si viene o no";
        } else {
          $attend = test_input($_POST["attend"]);
        }

        if ($_POST["attend"] == "yes" and empty($_POST["food"])) {
          $foodErr = "No se le olvide elegir postre!";
        } else {
          $food = test_input($_POST["food"]);
        }

        if ($nameErr == "" and $attendErr == "" and $foodErr == "") {
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
           }
          $sql = "INSERT INTO Dinner (name, attend, food) VALUES ('$name', '$attend', '$food')";
          if (mysqli_query($conn,$sql)) {
           $success = "<br>Su RSVP fue recibida! Agregue a la siguiente persona de su grupo.";
           $name = $attend = $food = "";
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
    <div class="white">
      <div class="container-text" id="rsvpForm">
        <h2>RSVP</h2>
        <p>Si es que planea asistir a la cena de ensayo, porfavor haga un RSVP por cada miembro de su grupo usando la siguiente forma. Ponga una persona a la vez. No podemos esperar para verlos!</p>
        <div class="rsvp-section">
          <span class="error"><?php echo $success;?></span><span class="error"></span>
        </div>
        <form id="dinnerForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
          <div class="rsvp-section">
            <label for="name"><b>Nombre y Apellido: </b></label><br>
            <input type="text" name="name" class="form-field" id="name" value="<?php echo $name;?>" autocorrect=off><br><span class="error"><?php echo $nameErr;?></span>
          </div>
          <div class="rsvp-section">
            <div class="option-separate">
              <label for="attend"><b>Asistira?</b></label><br>
              <input type="radio" name="attend" id="attend-yes" value="yes">Si<br>
              <input type="radio" name="attend" id="attend-no" value="no">No<br>
            </div>
            <div class="option-separate">
             <span class="error"><?php echo $attendErr;?></span>
            </div>
            <div class="option-separate">
              <label for="food"><b>Que le gustaria de postre?</b></label></br>
              <select name="food">
                 <option value="">Elija una opcion...</option>
                 <option value="cheese">Tarta de Queso Brio</option>
                 <option value="chocolate">Torta de Chocolate</option>
                 <option value="none">No me gusta el postre</option>
              </select><br>
              <span class="error"><?php echo $foodErr;?></span><span class="error"></span>
            </div>
          </div>
          <button type="submit" class="btn">Submit RSVP</button>
        </form>
      </div>
    </div>
    <?php if ($success != "" or $nameErr != "" or $attendErr != "" or $foodErr != "") {
          ?>
          <script>
             window.location="#rsvpForm";
          </script>

    <?php } ?>
  </body>
</html>