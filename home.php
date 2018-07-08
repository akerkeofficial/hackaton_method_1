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

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>
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
</style>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color:#FDD048; font-family: 'Indie Flower', cursive; font-size: 30px;">Priezjie</a>
    </div>
    <ul class="nav navbar-nav">
    <li ><a href="#"></a>
        
      </li>
      <li><a href="#"></a></li>
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


		<div class="row">
    
    <div class="col-sm-5" style="margin-left: 30px;">
<div class="header">
<br>
  <h3>Вы можете вбить вашу сумму и посчитать расходы</h3>
</div>

<form  method="POST">
    <p><input class="form-control"  type="text" placeholder="Ваша сумма. Например 2000"  name="input_text"></p>
    <p><button name="money_save" class="button button1">Отправить</button></p>
</form>
</div>
<div class="col-sm-1">
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
    echo "<h1 style='margin-left:200px; font-size:50px; '>$var</h1>";
  
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
        $image[]=$row['photo'];
        $name[]=$row['name'];
        $score[]=$row['score'];
        $cost[]=$row['cost'];
        $address[]=$row['address'];
        $carbon[]=$row['carbon_footprint'];
        
      }
    }

    ?>
        <div class="row">

    <?php

    for($i=0;$i<sizeof($name);$i++){ ?>
      <div class="col-sm-6"> <?php
      echo "<h2>$name[$i]</h2>"."<br/ >";
      echo "<img style='max-width: 250px; border-radius:15px;' src='".$image[$i]."'>".'<br/ ><hr/ >';
      echo "Рейтинг: ".$score[$i]."<br/ >";
      echo "Средний чекЖ ".$cost[$i]."<br/ >";
      echo "Экологическое значение: "."<h4>$carbon[$i]</h4>"."<hr/ >";
      echo "Адрес: ".$address[$i]."<br/ >";
       ?>
       <br>
      </div>
    <?php } ?>
    </div>
<?php
    $conn->close();
    };
    ?> 
    </div>
<h3 style="border-r"></h3>
</div>
</body>
</html>

