<?php 
   include("session.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Priezjie.com</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><form action="home.php">
        <input list="entertainments" name="entertainment">
        <datalist id="entertainments">
          <option value="hotel"/>
          <option value="hostel"/>
          <option value="cafe"/>
          <option value="lounge"/>
          <option value="event"/>
          <option value="club"/>
          <option value="Nature"/>
        </datalist>
        <input type="submit" value="Search">
    </form></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        
      </li>
      <li><a href="#">Page 2</a></li>
    </ul><div class="content">
    <!-- notification message -->



    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['user_email'])) : ?>
    

    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php 
      $user = $_SESSION['user_email'];
      echo  $user; ?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
    <?php endif ?>
    </div>
  </div>
</nav>
<div class="header">
	<h2>Home Page</h2>
</div>

		<div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-5">


<form  method="POST">
    <h2>Input your budget</h2>
    <p><textarea rows="10" cols="45" name="input_text"></textarea></p>
    <p><input type="submit" value="Отправить" name="money_save"></p>
</form>
</div>
  <div class="col-sm-6">

		<?php
		$text = "";
		$user = $_SESSION['user_email'];
$connection = mysqli_connect('localhost', 'root', '','method_hackaton_1');

// $sql2 = mysqli_query($connection,"SELECT money FROM users WHERE user_email = '$login_session'");
// $row2 = mysqli_fetch_array($sql2);
// $nombre = $row2['money'];
// echo $nombre;

if(isset($_POST['money_save']))
{
	  $text = mysqli_real_escape_string($connection, $_POST['input_text']);

     //$asd = "UPDATE users set money=$text where user_email='user_email'";
	  $asd = "UPDATE users set money = '$text' where user_email='$user'";
     mysqli_query($connection,$asd);
     header('location: plan.php');
}
?>

<?php
    if(isset($_GET['entertainment'])) {
    $var = $_GET['entertainment'];
    echo "<h2>$var</h2>";
  
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
        <div class="row">

    <?php

    for($i=0;$i<sizeof($name);$i++){ ?>
      <div class="col-sm-6"> <?php

      echo "<h2>$name[$i]</h2>"."<br/ >";
      echo "Score: ".$score[$i]." ";
      echo "Avg. check: ".$cost[$i]."<br/ >";
      echo "Street: ".$address[$i]."<br/ >";
      echo "Ecological importance: ".$carbon[$i]."<br/ >";
      echo "<img style='max-width: 225px;' src='".$image[$i]."'>".'<br/ ><hr/ >'; ?>
      </div>
    <?php } ?>
    </div>
<?php
    $conn->close();
    };
    ?> 
    </div>

</div>
</body>
</html>

