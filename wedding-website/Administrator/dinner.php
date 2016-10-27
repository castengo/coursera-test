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

					$sql = "SELECT name, attend, food FROM Dinner";
					$result = $conn->query($sql);
					$count = $cheese = $chocolate = 0;

					if ($result->num_rows > 0) {
					    echo "<table><tr><th>Name</th><th>Attendance</th><th>Food</th></tr>";
					    while($row = $result->fetch_assoc()) {
					        echo "<tr><td>".$row["name"]."</td><td>".$row["attend"]."</td><td>" . $row["food"]. "</td></tr>";
					        if ($row["attend"] == yes) {
					        	$count += 1;
					        }
					        if ($row["food"] == "cheese") {
					        	$cheese += 1;
					        }
					        if ($row["food"] == "chocolate") {
					        	$chocolate += 1;
					        }
					    }
					echo "<tr><td colspan='2'>Total RSVP'd:</td><td>".$count."</td></tr><tr><td colspan='2'>Cheesecake:</td><td>".$cheese."</td></tr><tr><td colspan='2'>Chocolate:</td><td>".$chocolate."</td></tr></table>";
					} else {
					    echo "0 results";
					}
					$conn->close();
				?>
		</div>
	</body>
</html>