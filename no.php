<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
	<style type="text/css"></style>
	<body>
		<div id="profile">
			<b id="welcome">Welcome : <i><?php echo $user; ?></i></b>
			<b id="logout"><a href="logout.php">Log Out</a></b> 
		</div>
		<?php

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "method_hackaton_1";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql2 = "SELECT rest_id,name,address,photo FROM rest where type='hotel' OR type='hostel'";
		$result=$conn->query($sql2);
		//$result = mysqli_fetch_array($sql2);
		//$image = $row2['photo'];
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$image[]=$row['photo'];
				$id[]=$row['rest_id'];
			}
		}

		?>
		<?php
		for($i=0;$i<sizeof($id);$i++){
			echo $id[$i]."<br>";
			echo "<img style='max-width: 225px;' src='".$image[$i]."'>".'<br/ >';
			echo '<a href="bron.php?var='.$id[$i].'">Забронировать!!!</a>'.'<br/ >';
		}
		$conn->close();
		?> 



		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!------ Include the above in your HEAD tag ---------->

<body>

</body>
</html>