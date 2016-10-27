<!DOCTYPE html>
<html>
  <head>
	<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light|Oswald:700' rel='stylesheet' type='text/css'>
	 <link rel="stylesheet" href="rehstyle.css"/>
	 <meta name=viewport content='width=600'>
  </head>
  <title>Rehearsal Dinner</title>
  <body>
  	<div class="white">
  		<div class="language">
	  		<a href="dinner.php" class="btn">English</a>
	  		<a href="ensayo.php" class="btn">Espanol</a>
	  	</div>
  	</div>
    <div class="blue">
      <div class="container-text">
        <h2>Joe and Catalina's Wedding Rehearsal and Dinner</h2>
        <p>You are cordially invited to our rehearsal dinner on Friday before the wedding! Join us for some great food, drinks, and company. All the information is listed below. If you have any questions, feel free to contact Betty at (801) 866-2703 or Catalina at (928) 965-1214.</p>
      </div>
    </div>
  	<div class="white">
	  	<div class="container-picture">
	  		<a href="http://www.marriott.com/hotels/travel/lasjw-jw-marriott-las-vegas-resort-and-spa"/><img src="https://apis.xogrp.com/media-api/images/ecfec57a-293a-4cdb-9526-b9fa7bcfc5d1~rs_2001.480.fit"/></a>
  		</div>
  		<div class="container-text">
  			<h2>Wedding Rehearsal</h2>
  			<p>Where: JW Marriott Las Vegas Resort & Spa</p>
  			<p>When: Friday, April 15th 2016 at 4:00 PM</p>
  			<p>Who: Parents, groomsmen, bridesmaids, ring bearer, and flower girl.</p>
  		</div>
  	</div>
  	<div class="blue">
  		<div class="container-text">
  			<h2>Rehearsal Dinner</h2>
  			<p>Where: Brio Tuscan Grille</p>
  			<p>When: Friday, April 15th 2016 at 5:00 PM</p>
  			<p>Who: Bridal party and invited family members.</p>
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
          $nameErr = "*Name is required";
        } else {
          $name = test_input($_POST["name"]);
        }

        if (empty($_POST["attend"])) {
          $attendErr = "*Attendance option is required";
        } else {
          $attend = test_input($_POST["attend"]);
        }

        if ($_POST["attend"] == "yes" and empty($_POST["food"])) {
          $foodErr = "Don't forget to choose a dessert option!";
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
           $success = "<br>Your RSVP was submitted successfully! Continue to add the next guest in your party.";
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
        <p>If you're planning on attending the rehearsal dinner, please RSVP for each guest in your party using the form below. Enter one guest at a time. We look forward to see you!</p>
        <div class="rsvp-section">
          <span class="error"><?php echo $success;?></span><span class="error"></span>
        </div>
        <form id="dinnerForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
          <div class="rsvp-section">
            <label for="name"><b>First and Last Name: </b></label><br>
            <input type="text" name="name" class="form-field" id="name" value="<?php echo $name;?>" autocorrect=off><br><span class="error"><?php echo $nameErr;?></span>
          </div>
          <div class="rsvp-section">
            <div class="option-separate">
              <label for="attend"><b>Will you be attending?</b></label><br>
              <input type="radio" name="attend" id="attend-yes" value="yes">Yes<br>
              <input type="radio" name="attend" id="attend-no" value="no">No<br>
            </div>
            <div class="option-separate">
             <span class="error"><?php echo $attendErr;?></span>
            </div>
            <div class="option-separate">
              <label for="food"><b>What would you like for dessert?</b></label></br>
              <select name="food">
                 <option value="">Choose an option...</option>
                 <option value="cheese">Brio Cheesecake</option>
                 <option value="chocolate">Chocolate Layer Cake</option>
                 <option value="none">I don't like dessert</option>
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