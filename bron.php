<!DOCTYPE html>
<html>
<head>
	<title>brON</title>
</head>
<body>
	<p>Спасибо! Вы успешно забронировали!!!</p>
<!-- 	<form action="no.php">
  	<input type="submit" value="ОК!!!">
	</form>  -->

<?php
 include("session.php");

	$idHotel=$_GET['var'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "method_hackaton_1";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	$sql1="SELECT longitude,latitude FROM rest WHERE rest_id='$idHotel'";
	$result=$conn->query($sql1);

	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
			$long=$row['longitude'];
			$lat=$row['latitude'];
		}
	}

	$sql = "UPDATE users SET longitude='$long', latitude='$lat' WHERE user_email='$user'";

	if ($conn->query($sql) === TRUE) {
    	echo "Record updated successfully";
	} else {
    	echo "Error updating record: " . $conn->error;
	}

	$conn->close();
?>
<br>
<a href="home.php">Личный кабинет</a>
</body>
</html>