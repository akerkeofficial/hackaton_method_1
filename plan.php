<?php 

 include("session.php");


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "method_hackaton_1";

$connection = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($connection, "utf8");

if($connection -> connect_error)
  die("Connection failed : " . $connection->connect_error);
//posle logina budet rabotat "user_id" = id kotoryi byl na logine)
$sql2 = mysqli_query($connection,"SELECT money FROM users WHERE user_email = '$user'");
$row2 = mysqli_fetch_array($sql2);
$money = $row2['money'];


// echo $row["money"];
//$money = 50000;
$eda = 0.33 * $money;

$trans = 0.07 * $money;
$forsmazh = 0.05 * $money;
$real = 0.55 * $money; # dengi dlya razvlechenia
$formula = $eda + $trans + $forsmazh + $real;

?>



<!doctype html>
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
<style>
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
  <div class="col-sm-3">
  </div>
    <div class="col-sm-6" style="margin-left: 30px; margin-top: 50px;">
  <article id="mainArticle"> 
  <h3 style=" height: 6px; width:100%;  ">Дорогой клиент, вы можете посетить нижеуказанные места:</h3><br>
<div style=" width:100%; height: 40px; background-color: #FDD048; padding-left:10px; border-radius: 15px;"><h3 style=" height: 6px; width:100%;  padding-left:50%;">8:00</h3>
</div>
<?php

$cost = "select * FROM rest where type = 'Cafe' AND cost < '$eda' ORDER BY carbon_footprint ASC, score DESC, cost ASC limit 3";
$res = $connection -> query($cost);

  if ($res->num_rows > 0) {


    // output data of each row
    while($row = $res->fetch_assoc()) {
         
         echo "Кафе: " . $row["name"]. "   " . "Цена" . "   " . $row["cost"]. "   "  ."Рейтинг" . "   " . $row["score"] ."   " ."Экологическое значение:" .$row["carbon_footprint"] . "<br>" . "<br>" ;
    }
} else {
    echo "0 results";
}  
?>

<div style=" width:100%; height: 40px; background-color: #FDD048; padding-left:10px; border-radius: 15px;"><h3 style=" height: 6px; width:100%;  padding-left:50%;">12:00</h3></div>

<?php

$co = "select * FROM entertainment where cost < '$real' ORDER BY cost ASC limit 3";
$r = $connection -> query($co);

  if ($r->num_rows > 0) {
    
    echo "События". "<br>" . "<br>";

    // output data of each row
    while($row = $r->fetch_assoc()) {
         
         echo "Событие: " . $row["name"]. "   " . "Цена" . "   " . $row["cost"] . "Адрес: " . $row["address"] . "<br>" . "<br>" ;
    }
} else {
    echo "0 results";
}  
?>
<br>
<div style=" width:100%; height: 40px; background-color: #FDD048; padding-left:10px; border-radius: 15px;"><h3 style=" height: 6px; width:100%;  padding-left:50%;">16:00</h3></div>

<?php
$next = "select * from rest where type = 'Lounge' AND cost < '$real' ORDER BY carbon_footprint ASC, score DESC, cost ASC limit 3";
$otvet = $connection -> query($next);

    if($otvet->num_rows > 0){

            echo "Лаундж бары:" . "<br>" . "<br>";

        while($row = $otvet->fetch_assoc()){

            echo "Название: " . $row["name"]. "   " . "Средний чек" . "   " . $row["cost"]. "   "  ."Рейтинг" . "   " . $row["score"]. "   " . $row["carbon_footprint"] . "<br>" . "<br>";
        }
    } else {
        echo "0 results";
    }
    ?>


<div style=" width:100%; height: 40px; background-color: #FDD048; padding-left:10px; border-radius: 15px;"><h3 style=" height: 6px; width:100%;  padding-left:50%;">20:00</h3></div><br>
<?php
$next1 = "select * from rest where type = 'Club' AND cost < '$real' ORDER BY carbon_footprint ASC, score DESC, cost ASC limit 3";
$otvet1 = $connection -> query($next1);

    if($otvet1->num_rows > 0){

            echo "Ночные клубы:" . "<br>" . "<br>";

        while($row = $otvet1->fetch_assoc()){

            echo "Название: " . $row["name"]. "   " . "Средний чек" . "   " . $row["cost"]. "   "  ."Рейтинг" . "   " . $row["score"] . "   " . $row["carbon_footprint"] . "<br>" . "<br>";
        }
    } else {
        echo "0 results";
    }
    $connection->close();
?> 

<div style=" width:100%; height: 40px; background-color: #FDD048; padding-left:10px; border-radius: 15px;"><h3 style=" height: 6px; width:100%;  padding-left:50%;">00:00</h3></div></article>
</div>
</div>
<br>
<br>
<br>
  <nav id="mainNav"></nav>
  <div id="siteAds">
    <?php
            //THERE GOOGLE MAP
    include 'map.html';
?>
  </div>
  <footer align="center" id="pageFooter">Copyright(c)</footer>
</body>


