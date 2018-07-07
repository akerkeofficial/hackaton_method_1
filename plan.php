<?php 

 include("session.php");


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "method_hackaton_1";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

if($conn -> connect_error)
  die("Connection failed : " . $conn->connect_error);
//posle logina budet rabotat "user_id" = id kotoryi byl na logine)
$sql2 = mysqli_query($connection,"SELECT money FROM users WHERE user_email = '$login_session'");
$row2 = mysqli_fetch_array($sql2);
$money = $row2['money'];


// echo $row["money"];
//$money = 50000;
$eda = 0.33 * $money;

$trans = 0.07 * $money;
$forsmazh = 0.05 * $money;
$real = 0.55 * $money; # dengi dlya razvlechenia
$formula = $eda + $trans + $forsmazh + $real;
//echo $real;

$cost = "select * FROM rest where type = 'hostel' AND cost < '$real' ORDER BY score DESC, cost ASC";
$res = $conn -> query($cost);

  if ($res->num_rows > 0) {
    echo "Дорогой клиент, в прожетку этого времени вы можете посетить нижеуказанные места:". "<br>" . "<br>";
    // output data of each row
    while($row = $res->fetch_assoc()) {
         echo "ID: " . $row["rest_id"]. " - Name: " . $row["name"]. "<---->" . "Cost" . "   " . $row["cost"]. "   "  ."Score" . "   " . $row["score"] . "<br>";
    }
} else {
    echo "0 results";
}  

$conn->close();
?>