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
		if(isset($_GET['entertainment'])) {
		$var = $_GET['entertainment'];
		echo $var;
	
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

		$sql2 = "SELECT * FROM rest where type='$var'";
		$result=$conn->query($sql2);
		//$result = mysqli_fetch_array($sql2);
		//$image = $row2['photo'];
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$name[]=$row['name'];
				$score[]=$row['score'];
				$cost[]=$row['cost'];
				$address[]=$row['address'];
				$carbon[]=$row['carbon_footprint'];
				$image[]=$row['photo'];
			}
		}

		?>
		<?php
		for($i=0;$i<sizeof($name);$i++){
			echo $name[$i]."<br/ >";
			echo "Score: ".$score[$i]." ";
			echo "Avg. check: ".$cost[$i]."<br/ >";
			echo "Street: ".$address[$i]."<br/ >";
			echo "Ecological importance: ".$carbon[$i]."<br/ >";
			echo "<img style='max-width: 225px;' src='".$image[$i]."'>".'<br/ ><hr/ >';
		}

		$conn->close();
		};
		?> 



		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!------ Include the above in your HEAD tag ---------->

<body>

</body>
</html>

