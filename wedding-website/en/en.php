<!DOCTYPE html>
<html>
  <head>
  <link href='https://fonts.googleapis.com/css?family=Josefin+Slab: 600|Dancing+Script:400,700|Amaranth|Great+Vibes' rel='stylesheet' type='text/css'>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../style.css"/>
  </head>
  <title>Welcome</title>
  <body>

    <div class="welcome">
      <div class="header">
          <h1>Joseph and Catalina</h1>
          <h2>Welcome</h2>
      </div>
    </div>
    
    <div class="menu">
      <div class="container">
        <ul class="nav">
          <li><a href="en.php">Welcome</li>
          <li><a href="thewedding.html">Wedding</a></li>
          <li><a href="schedule.html">Schedule</a></li>
          <li><a href="accomodations.html">Accomodations</a></li>
          <li><a href="registry.html">Registry</a></li>
          <li><a href="../rsvp.php">RSVP</a></li>
        </ul>
      </div>
    </div>

    <div class="box">
      <div class="container">
        <h1>Welcome to our wedding website!</h1>
        <p>We are looking forward to celebrating this special day with you! Here you will find all the information concerning our wedding plans.<b> Our RSVP is now open!</b> Let us know if you're coming and what you would like to eat. You can also look at hotel accomodations and schedule information. If you can't find what you're looking for or have any questions, let us know!</p>
        <p>Sincerely,</p>
        <p>Joe and Catalina</p>
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
          $nameErr = "*Name is required";
        } else {
          $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
          $emailErr = "*Email is required.";
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
           $success = "<br>Your information was submitted successfully!";
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
        <h2>Want to receive updates directly to your email?</h2>
        <p>Sign up for updates below! We will let you know of major updates to our wedding schedule or any other relevant information.</p>
        <form id="signup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
             <label for="name">Name: </label>
             <input type="text" autocorrect=off autocapitalize=words name="name" class="form-field" id="name"><span class="error"><?php echo $nameErr;?></span><br>
             <label for="email">Email:</label>
             <input type="email" name="email" class="form-field" sid="email"><span class="error"><?php echo $emailErr;?></span><br>
             <button type="submit" class="btn">Submit</button>
             <span type="error"><?php echo $success;?></span>
         </form>
      </div>
    </div>


    <div class="footer">
      <div class="container">
        <p>&copy; Catalina Astengo 2015</p>
      </div>
    </div> 

    <?php if ($success != "" or $nameErr != "" or $emailErr != "") {
          ?>
          <script>
             window.location="#signup";
          </script>

    <?php } ?>



  </body>
</html>