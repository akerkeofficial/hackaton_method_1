<!DOCTYPE html>
<html>
<head><title>HELLO</title></head>
<body>

	<form action="output.php" method="post">
    <h2>Input your budget</h2>
    <p><textarea rows="10" cols="45" name="text"></textarea></p>
    <p><input type="submit" value="Отправить"></p>
	

	<?php
		$servername = "localhost";
		$username = "username";
		$password = "password";
		$dbname = "myDB";
		
		$conn = new mysqli($servername, $username, $password, $dbname);	
		if ($conn->connect_error) {
   	  die("Connection failed: " . $conn->connect_error);
	}

		

		$mysql = "select * from ";
		$sql = "insert into users (money) VALUE ";

		if ($conn->query($sql) === TRUE) {
 	   echo "New record created successfully";
		} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

		$conn->close();
		

		?>


</body>
</html>