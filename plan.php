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



<!Doctype html>
<html>
<head>
<title>asd</title>
</head>
<body>
<div style="height:30px; width:560px; border-left:5px solid black; background-color:silver; padding-left:10px">8:00
</div>
<?php

$cost = "select * FROM rest where type = 'Cafe' AND cost < '$eda' ORDER BY score DESC, cost ASC limit 3";
$res = $connection -> query($cost);

  if ($res->num_rows > 0) {

    echo "Дорогой клиент, вы можете посетить нижеуказанные места:". "<br>" . "<br>";

    // output data of each row
    while($row = $res->fetch_assoc()) {
         
         echo "Кафе: " . $row["name"]. "   " . "Цена" . "   " . $row["cost"]. "   "  ."Рейтинг" . "   " . $row["score"] . "<br>" . "<br>";
    }
} else {
    echo "0 results";
}  
?>

<div style="height:30px; width:560px; border-left:5px solid black; background-color:silver; padding-left:10px">12:00
</div>

<?php

$co = "select * FROM entertainment where cost < '$real' ORDER BY cost ASC limit 3";
$r = $connection -> query($co);

  if ($r->num_rows > 0) {
    
    echo "События". "<br>" . "<br>";

    // output data of each row
    while($row = $r->fetch_assoc()) {
         
         echo "Событие: " . $row["name"]. "   " . "Цена" . "   " . $row["cost"] . "Адрес" . $row["address"] . "<br>" . "<br>" ;
    }
} else {
    echo "0 results";
}  
?>
<br>
<div style="height:30px; width:560px; border-left:5px solid black; background-color:silver; padding-left:10px">16:00
</div>

<?php
$next = "select * from rest where type = 'Lounge' AND cost < '$real' ORDER BY score DESC, cost ASC limit 3";
$otvet = $connection -> query($next);

    if($otvet->num_rows > 0){

            echo "Лаундж бары:" . "<br>" . "<br>";

        while($row = $otvet->fetch_assoc()){

            echo "Название: " . $row["name"]. "   " . "Средний чек" . "   " . $row["cost"]. "   "  ."Рейтинг" . "   " . $row["score"] . "<br>" . "<br>";
        }
    } else {
        echo "0 results";
    }
    ?>


<div style="height:30px; width:560px; border-left:5px solid black; background-color:silver; padding-left:10px">20:00
</div><br>
<?php
$next1 = "select * from rest where type = 'Club' AND cost < '$real' ORDER BY score DESC, cost ASC limit 3";
$otvet1 = $connection -> query($next1);

    if($otvet1->num_rows > 0){

            echo "Ночные клубы:" . "<br>" . "<br>";

        while($row = $otvet1->fetch_assoc()){

            echo "Название: " . $row["name"]. "   " . "Средний чек" . "   " . $row["cost"]. "   "  ."Рейтинг" . "   " . $row["score"] . "<br>" . "<br>";
        }
    } else {
        echo "0 results";
    }
    $connection->close();
?> 

<div style="height:30px; width:560px; border-left:5px solid black; background-color:silver; padding-left:10px">00:00
</div>

</body>
</html>