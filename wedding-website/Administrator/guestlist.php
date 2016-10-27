<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="gsstyle.css"/>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
	<meta name=viewport content='width=600'>
	</head>
	<body>
		<title>Guest List</title>
		<div class="GuestList">
			<h1>Guest List</h1>
				<?php
					  $servername = "mysql.joeandcata.com";
				      $username = "joeandcata";
				      $password = "Lacrimosa7";
				      $dbname = "joeandcata_wedding";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					} 

					$sql = "SELECT name, attend, food FROM RSVP";
					$result = $conn->query($sql);
					$count = $ribs = $salmon = $veggie = $kids = 0;

					if ($result->num_rows > 0) {
					    echo "<table><tr><th>Name</th><th>Attendance</th><th>Food</th></tr>";
					    while($row = $result->fetch_assoc()) {
					        echo "<tr><td>".$row["name"]."</td><td>".$row["attend"]."</td><td>" . $row["food"]. "</td></tr>";
					        if ($row["attend"] == yes) {
					        	$count += 1;
					        }
					        if($row["food"] == "ribs") {
					        	$ribs += 1;
					        }
					        if($row["food"] == "salmon") {
					        	$salmon += 1;
					        }
					        if($row["food"] == "veggie") {
					        	$veggie += 1;
					        }
					        if($row["food"] == "kids") {
					        	$kids += 1;
					        }
					    }
					echo "<tr><td colspan='2'>Total RSVP'd:</td><td>".$count."</td></tr><tr><td colspan='2'>Prime Rib</td><td>".$ribs."</td></tr><tr><td colspan='2'>Salmon:</td><td>".$salmon."</td></tr><tr><td colspan='2'>Veggie:</td><td>".$veggie."</td></tr><tr><td colspan='2'>Kids:</td><td>".$kids."</td></tr></table>";
					} else {
					    echo "0 results";
					}
					$conn->close();
				?>
		</div>
	</body>
</html>