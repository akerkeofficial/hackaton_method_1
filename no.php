<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

<style type="text/css">
 .button1 {
    background-color: #FDD048; /* Green */
    border: none;
    color: black;
    border-radius: 10px;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.button1:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.button2 {
    background-color: #FDD048; /* Green */
    border: none;
    color: black;
    border-radius: 10px;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.button2:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
</style>	<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php" style="color:#FDD048; font-family: 'Indie Flower', cursive; font-size: 30px;">Priezjie</a>
    </div>
    <ul class="nav navbar-nav">
    <li ><a href="#"></a>
        
      </li>
      <li class="active"><form action="home.php">
        <input list="entertainments" name="entertainment"  type="text" placeholder="Поиск" style="margin-top: 10px;">
        <datalist id="entertainments">
          <option value="hotel"/>
          <option value="hostel"/>
          <option value="cafe"/>
          <option value="lounge"/>
          <option value="event"/>
          <option value="club"/>
          <option value="Nature"/>
        </datalist>
        <button type="submit"  class="button button2">Поиск</button>
    </form></li>
      <li><a href="#"></a></li>
      
      
    </ul><div class="content">
    <!-- notification message -->



    
    

    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php 
      $user = $_SESSION['user_email'];
      echo  $user; ?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
    </div>
  </div>
</nav>



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

		$sql2 = "SELECT rest_id,name,address,photo,score,cost FROM rest where type='hotel' OR type='hostel'";
		$result=$conn->query($sql2);
		//$result = mysqli_fetch_array($sql2);
		//$image = $row2['photo'];
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$id[]=$row['rest_id'];
				$image[]=$row['photo'];
				$name[]=$row['name'];
				$score[]=$row['score'];
				$cost[]=$row['cost'];
				$address[]=$row['address'];
			}
		}

		?>
		
        <div class="row">

    <?php
		for($i=0;$i<sizeof($id);$i++){ ?>
      <div class="col-sm-4" style=""> <?php
      		echo "<h2 style='margin-left:50px;'>$name[$i]</h2>"."<br/ >";
			echo "<img style='max-width: 225px;margin-left:20px; border-radius:20px;' src='".$image[$i]."'>".'<br/> <hr>';
			echo "<h5 style='margin-left:50px;'>Рейтинг:  $score[$i]</h5>";
      		echo "<h5 style='margin-left:50px;'>Цена:   $cost[$i]</h5>";
     		echo "<h5 style='margin-left:50px;'>Адрес:  $address[$i]</h5>";
     		// echo '<a href="bron.php?var='.$id[$i].'">      Забронировать!!!</a>'.'<br/ >';
     		echo "<a style='margin-left:50px;' href='bron.php?var=$id[$i]'><button class='button button1'>      Забронировать!!!</button></a>";

			?>
			<br>
			</div>
		<?php } ?>
    </div>		
    <?php $conn->close();
		?> 



		

<body>

</body>
</html>
		